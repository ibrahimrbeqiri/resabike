<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];

var_dump($_SESSION["search_query"]);

$from = isset($_GET['from']) ? $_GET['from'] : false;
$to = isset($_GET['to']) ? $_GET['to'] : false;
$via = isset($_GET['via']) ? $_GET['via'] : false;
$datetime = isset($_GET['datetime']) ? $_GET['datetime'] : '';
$page = isset($_GET['page']) ? ((int) $_GET['page']) - 1 : 0;
$c = isset($_GET['c']) ? (int) $_GET['c'] : false;
$stationsFrom = [];
$stationsTo = [];

$from = $_SESSION["search_query"]["from"];
$to =	$_SESSION["search_query"]["to"];
$date = $_SESSION["search_query"]["date"];
$time = $_SESSION["search_query"]["time"];

$search = $from && $to;
if ($search) {
    $query = [
        'from'  => $from,
        'to'    => $to,
        'page'  => $page,
        'limit' => 6,
    ];
    if ($date && $time) {
        $query['date'] = date('d.m.Y', strtotime($date));
        $query['time'] = date('H:i', strtotime($time));
    }
    if ($via) {
        $query['via'] = $via;
    }
    $url = 'http://transport.opendata.ch/v1/connections?'.http_build_query($query);
    $url = filter_var($url, FILTER_VALIDATE_URL);
    $response = json_decode(file_get_contents($url));
    if ($response->from) {
        $from = $response->from->name;
    }
    if ($response->to) {
        $to = $response->to->name;
    }
    if (isset($response->stations->from[0])) {
        if ($response->stations->from[0]->score < 101) {
            foreach (array_slice($response->stations->from, 1, 3) as $station) {
                if ($station->score > 97) {
                    $stationsFrom[] = $station->name;
                }
            }
        }
    }
    if (isset($response->stations->to[0])) {
        if ($response->stations->to[0]->score < 101) {
            foreach (array_slice($response->stations->to, 1, 3) as $station) {
                if ($station->score > 97) {
                    $stationsTo[] = $station->name;
                }
            }
        }
    }
}
?>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script> -->


    <div class="row">
        <!-- <div class="col-sm-5">

            <form method="get" action="">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="from" value="<?php echo htmlentities($from, ENT_QUOTES, 'UTF-8'); ?>" placeholder="From"  />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input type="text" name="to" class="form-control" value="<?php echo htmlentities($to, ENT_QUOTES, 'UTF-8'); ?>" placeholder="To" autofocus />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input type="datetime-local" class="form-control" name="datetime" value="<?php echo htmlentities($datetime, ENT_QUOTES, 'UTF-8'); ?>" placeholder="Date and time (optional)" step="300" />
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" value="Search" />
                            <a class="btn btn-link" href="connections.php">Clear</a>
                        </div>
                    </div>
                </div>
            </form>

        </div> -->
        <div class="col-sm-7">

            <?php if ($search && $response->connections): ?>

					<ul class="collapsible" data-collapsible="accordion">


                    <?php $j = 0; ?>
                    <?php foreach ($response->connections as $connection): ?>
                        <?php $j++; ?>

                        <li>
							<div class="collapsible-header">
                            <tr class="connection"<?php if ($j == $c): ?> style="display: none;"<?php endif; ?> data-c="<?php echo $j; ?>">
                                <td>
                                    <?php echo date('H:i', strtotime($connection->from->departure)); ?>
                                    <?php if ($connection->from->delay): ?>
                                        <span style="color: #a20d0d;"><?php echo '+'.$connection->from->delay; ?></span>
                                    <?php endif; ?>
                                    <br/>
                                    <?php echo date('H:i', strtotime($connection->to->arrival)); ?>
                                    <?php if ($connection->to->delay): ?>
                                        <span style="color: #a20d0d;"><?php echo '+'.$connection->to->delay; ?></span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo (substr($connection->duration, 0, 2) > 0) ? htmlentities(trim(substr($connection->duration, 0, 2), '0')).'d ' : ''; ?>
                                    <?php echo htmlentities(trim(substr($connection->duration, 3, 1), '0').substr($connection->duration, 4, 4)); ?>′<br/>
                                    <span class="muted">
                                    <?php echo htmlentities(implode(', ', $connection->products)); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($connection->from->prognosis->platform): ?>
                                        <span style="color: #a20d0d;"><?php echo htmlentities($connection->from->prognosis->platform, ENT_QUOTES, 'UTF-8'); ?></span>
                                    <?php else: ?>
                                        <?php echo htmlentities($connection->from->platform, ENT_QUOTES, 'UTF-8'); ?>
                                    <?php endif; ?>
                                    <br/>
                                    <?php if ($connection->capacity2nd > 0): ?>
                                        <small title="Expected occupancy 2nd class">
                                            <?php for ($i = 0; $i < 3; $i++): ?>
                                                <?php if ($i < $connection->capacity2nd): ?>
                                                    <span class="glyphicon glyphicon-user text-muted"></span>
                                                <?php else: ?>
                                                    <span class="glyphicon glyphicon-user text-disabled"></span>
                                                <?php endif; ?>
                                            <?php endfor; ?>
                                        </small>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php $i = 0; foreach ($connection->sections as $section): ?>
                                <tr class="section"<?php if ($j != $c): ?> style="display: none;"<?php endif; ?>>
                                    <td rowspan="2">
                                        <?php echo date('H:i', strtotime($section->departure->departure)); ?>
                                        <?php if ($section->departure->delay): ?>
                                            <span style="color: #a20d0d;"><?php echo '+'.$section->departure->delay; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo htmlentities($section->departure->station->name, ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td>
                                        <?php if ($section->departure->prognosis->platform): ?>
                                            <span style="color: #a20d0d;"><?php echo htmlentities($section->departure->prognosis->platform, ENT_QUOTES, 'UTF-8'); ?></span>
                                        <?php else: ?>
                                            <?php echo htmlentities($section->departure->platform, ENT_QUOTES, 'UTF-8'); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <tr class="section"<?php if ($j != $c): ?> style="display: none;"<?php endif; ?>>
                                    <td style="border-top: 0; padding: 4px 8px;">
                                        <span class="muted">
                                        <?php if ($section->journey): ?>
                                            <?php echo htmlentities($section->journey->name, ENT_QUOTES, 'UTF-8'); ?>
                                        <?php else: ?>
                                            Walk
                                        <?php endif; ?>
                                        </span>
                                    </td>
                                    <td style="border-top: 0; padding: 4px 8px;">
                                        <small title="Expected occupancy 2nd class">
                                            <?php if ($section->journey && $section->journey->capacity2nd > 0): ?>
                                                <?php for ($i = 0; $i < 3; $i++): ?>
                                                    <?php if ($i < $section->journey->capacity2nd): ?>
                                                        <span class="glyphicon glyphicon-user text-muted"></span>
                                                    <?php else: ?>
                                                        <span class="glyphicon glyphicon-user text-disabled"></span>
                                                    <?php endif; ?>
                                                <?php endfor; ?>
                                            <?php endif; ?>
                                        </small>
                                    </td>
                                </tr>
                                <tr class="section"<?php if ($j != $c): ?> style="display: none;"<?php endif; ?>>
                                    <td style="border-top: 0;">
                                        <?php echo date('H:i', strtotime($section->arrival->arrival)); ?>
                                        <?php if ($section->arrival->delay): ?>
                                            <span style="color: #a20d0d;"><?php echo '+'.$section->arrival->delay; ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td style="border-top: 0;">
                                        <?php echo htmlentities($section->arrival->station->name, ENT_QUOTES, 'UTF-8'); ?>
                                    </td>
                                    <td style="border-top: 0;">
                                        <?php if ($section->arrival->prognosis->platform): ?>
                                            <span style="color: #a20d0d;"><?php echo htmlentities($section->arrival->prognosis->platform, ENT_QUOTES, 'UTF-8'); ?></span>
                                        <?php else: ?>
                                            <?php echo htmlentities($section->arrival->platform, ENT_QUOTES, 'UTF-8'); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
							</div>
							<div class="collapsible-body">

									<form class="">
									  <div class="row">
										<div class="input-field col s12 m2">
										  <i class="material-icons prefix">person</i>
										  <input id="icon_prefix" type="text" class="validate">
										  <label for="icon_prefix">Nickname</label>
										</div>
										<div class="input-field col s2">
										  <i class="material-icons prefix">directions_bike</i>
										  <select class="form-bikes">
											<option value="" disabled selected>Bikes</option>
											<option value="1">1</option>
											<option value="2">2</option>
											<option value="3">3</option>
											<option value="4">4</option>
											<option value="5">5</option>
											<option value="6">6</option>
											<option value="7">7</option>
											<option value="8">8</option>
											<option value="9">9</option>
											<option value="10+">10+</option>
										  </select>
										</div>
										<div class="col s2">
											<button class="btn waves-effect waves-light" type="submit" name="action">
												Reserve
											  <i class="material-icons right">check</i>
											</button>
										</div>
									  </div>
									</form>

							</div>
                        </li>
                    <?php endforeach; ?>
					</ul>


			<?php endif; ?>
	</div>
</div>
<!--  <script>

    $(function () {
        var station = '8501120';
        function refresh() {
            if (station) {
                $.get('http://transport-beta.opendata.ch/v1/stationboard', {id: station, limit: 15}, function(data) {
                    $('#stationboard tbody').empty();
                    $(data.stationboard).each(function () {
                        var prognosis, departure, delay, line = '<tr><td>';
                        departure = moment(this.stop.departure);
                        if (this.stop.prognosis.departure) {
                            prognosis = moment(this.stop.prognosis.departure);
                            delay = (prognosis.valueOf() - departure.valueOf()) / 60000;
                            line += departure.format('HH:mm') + ' <strong>+' + delay + ' min</strong>';
                        } else {
                            line += departure.format('HH:mm');
                        }
                        line += '</td><td>' + this.name + '</td><td>' + this.to + '</td></tr>';
                        $('#stationboard tbody').append(line);
                    });
                }, 'json');
            }
        }
        $('#station').autocomplete({
            source: function (request, response) {
                $.get('http://transport-beta.opendata.ch/v1/locations', {query: request.term, type: 'station'}, function(data) {
                    response($.map(data.stations, function(station) {
                        return {
                            label: station.name,
                            station: station
                        }
                    }));
                }, 'json');
            },
            select: function (event, ui) {
                station = ui.item.station.id;
                refresh();
            }
        });
        setInterval(refresh, 30000);
        refresh();
    });

</script>
	<div class="col m12">
	<h3>Choose station</h3>
		<div class="row">
			<div class="ui-widget station">
            	<input class="form-control" id="station"  placeholder="Station" />
        	</div>
			<table id="stationboard">
				<colgroup>
                	<col width="120">
                	<col width="140">
                	<col width="230">
            	</colgroup>
        		<thead>
          			<tr>
              			<th align="left">Time</th>
              			<th>&nbsp;</th>
              			<th align="left">To</th>
          			</tr>
        		</thead>

        		<tbody>

        		</tbody>
      		</table>
      </div>
	</div>
</div>-->




<div id="bike-modal" class="modal modal-fixed-footer">
  <div class="modal-content">
	<h4>Attention!</h4>
	<p>If you are planning on reserving more than 10 bikes, please contact us at <a href="tel:1-562-867-5309">1-562-867-5309</a> to make sure we have room for all your bikes.</p>
  </div>
  <div class="modal-footer">
	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
  </div>
</div>

<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
