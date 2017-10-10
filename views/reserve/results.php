<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];

 $from = isset($_GET['from']) ? $_GET['from'] : false;
$to = isset($_GET['to']) ? $_GET['to'] : false;
$via = isset($_GET['via']) ? $_GET['via'] : false;
$datetime = isset($_GET['datetime']) ? $_GET['datetime'] : '';
$page = isset($_GET['page']) ? ((int) $_GET['page']) - 1 : 0;
$c = isset($_GET['c']) ? (int) $_GET['c'] : false;
$stationsFrom = [];
$stationsTo = [];
$search = $from && $to;
if ($search) {
    $query = [
        'from'  => $from,
        'to'    => $to,
        'page'  => $page,
        'limit' => 6,
    ];
    if ($datetime) {
        $query['date'] = date('Y-m-d', strtotime($datetime));
        $query['time'] = date('H:i', strtotime($datetime));
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>


    <div class="row">
        <div class="col-sm-5">

            <form method="get" action="">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input type="text" class="form-control" name="from" value="<?php echo htmlentities($from, ENT_QUOTES, 'UTF-8'); ?>" placeholder="From"  />
                            <?php $i = count($stationsFrom); if ($i > 0): ?>
                                <p>
                                    Did you mean:
                                    <?php foreach ($stationsFrom as $station): ?>
                                        <a href="connections.php?<?php echo htmlentities(http_build_query(['from' => $station, 'to' => $to, 'datetime' => $datetime]), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlentities($station, ENT_QUOTES, 'UTF-8'); ?></a><?php if ($i-- > 1): ?>, <?php endif; ?>
                                    <?php endforeach ?>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="form-group">
                            <input type="text" name="to" class="form-control" value="<?php echo htmlentities($to, ENT_QUOTES, 'UTF-8'); ?>" placeholder="To" autofocus />
                            <?php $i = count($stationsFrom); if ($i > 0): ?>
                                <p>
                                    Did you mean:
                                    <?php foreach ($stationsTo as $station): ?>
                                        <a href="connections.php?<?php echo htmlentities(http_build_query(['from' => $from, 'to' => $station, 'datetime' => $datetime]), ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlentities($station, ENT_QUOTES, 'UTF-8'); ?></a><?php if ($i-- > 1): ?>, <?php endif; ?>
                                    <?php endforeach ?>
                                </p>
                            <?php endif; ?>
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

        </div>
        <div class="col-sm-7">

            <?php if ($search && $response->connections): ?>
                <table class="table connections">
                    <colgroup>
                        <col width="20%">
                        <col width="57%">
                        <col width="23%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Journey</th>
                            <th>
                                <span class="visible-xs-inline">Pl.</span>
                                <span class="hidden-xs">Platform</span>
                            </th>
                        </tr>
                    </thead>
                    <?php $j = 0; ?>
                    <?php foreach ($response->connections as $connection): ?>
                        <?php $j++; ?>
                        <tbody>
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
                        </tbody>
                    <?php endforeach; ?>
                </table>
</div>
</div>
<?php endif; ?>
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


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>