<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];


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
        'num'  => 8,
    ];
    if ($date && $time) {
        $query['date'] = date('m/d/Y', strtotime($date));
        $query['time'] = date('H:i', strtotime($time));
    }
    $url = 'https://timetable.search.ch/api/route.json?'.http_build_query($query);
    $url = filter_var($url, FILTER_VALIDATE_URL);
    $response = json_decode(file_get_contents($url));
    //var_dump($response);



}
?>

        <div class="container">
		<h5><?php echo "Bus rides from $from to $to at $time on $date:" ?></h5>
		<ul class="collapsible" data-collapsible="accordion">
		<?php  foreach($response->connections as $connection):?>
<?php
   // ransport = "BUS";
   // foreach($connection->legs as $leg):
   // if($leg->{"*G"} == $transport):

	   ?>
           <li>

           					<div class="collapsible-header">
								<div class="connection-info">
										<div class="connection-stop">
											<div>
												<i class="material-icons">trending_flat</i> <?php echo $connection->from; ?>
											</div>
											<div>
											 <?php echo '&emsp;'.date('H:i', strtotime($connection->departure)); ?>
											</div>
										</div>
										<div class="connection-stop">
											<i class="material-icons">hourglass_empty</i><?php echo '&nbsp;'.gmdate("H:i", $connection->duration); ?>
										</div>
										<div class="col l12 connection-stop">
											<div>
												<i class="material-icons">location_on</i> <?php echo $connection->to; ?>
											</div>
											<div>
											<?php echo '&emsp;'.date('H:i', strtotime($connection->arrival)); ?>
											</div>
									</div>

								</div>
							</div>
							<div class="collapsible-body">
								<div class="row">
									<div class="col l6">
										<ul class="collapsible" data-collapsible="accordion">
											<?php
											foreach($connection->legs as $leg):?>
											<li>
												<div class="collapsible-header">
													<div class="col l12">
														<?php if ($leg->arrival): ?>
															<?php echo date('H:i', strtotime($leg->arrival)).'&emsp;'; ?>
														<?php endif; ?>
														
														<?php echo $leg->name; ?>

														<?php if ($leg->stops != null): ?>
															   <i class="material-icons right">add</i>
														<?php endif ?>
													</div>

												</div>

													<?php
													if ($leg->stops != null): ?>
													<div class="collapsible-body">
															<?php
															foreach($leg->stops as $stop):
																echo "<p style='color: red;'> $stop->name </p>";
															endforeach;?>


													</div>
													<?php endif ?>

											</li>
											<?php endforeach; ?>
										</ul>


									</div>
									<div class="col l6">
										<form class="">
										  <div class="row">
											<div class="input-field col l4">
											  <i class="material-icons prefix">person</i>
											  <input id="icon_prefix" type="text" class="validate">
											  <label for="icon_prefix">Nickname</label>
											</div>
											<div class="input-field col l4">
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
											<div class="col l12">
												<button class="btn waves-effect waves-light" type="submit" name="action">
													Reserve
												  <i class="material-icons right">check</i>
												</button>
											</div>
										 </div>
										</form>
									</div>
								</div>




								</div>

						</li>
						<?php endforeach;?>
					</ul>
				</div>





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
