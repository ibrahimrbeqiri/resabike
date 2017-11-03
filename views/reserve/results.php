<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];


$sum = $_SESSION['sum'];
//var_dump($sum);


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




}
?>

        <div class="container">
		<h5><?php echo "Bus rides from $from to $to at $time on $date:" ?></h5>
		<ul class="collapsible" data-collapsible="accordion">
		<?php $allowedTypes = array ("post", "bus", "walk"); ?>
		<?php foreach($response->connections as $connection): ?>

		<?php
			$onlyBus = true;
		    foreach($connection->legs as $leg):

		    if($leg->type && !in_array($leg->type, $allowedTypes) ):
				$onlyBus = false;
			endif;

			endforeach;

			// check that all the lines in the bus route are bus routes or walking, else dont show them.
			if ($onlyBus == true): ?>
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
														 <?php
														 if ($leg->arrival){
															 echo date('H:i', strtotime($leg->arrival)).'&emsp;';
														 }
														 //special case for first station.
														 elseif ($leg->name == $connection->from) {
															 echo date('H:i', strtotime($connection->departure)).'&emsp;';
														 }
														 ?>

														 <?php echo $leg->name; ?>

														 <?php if ($leg->line): ?>
															 <?php echo '&nbsp;'."($leg->line)"; ?>
														 <?php endif; ?>

														 <?php if ($leg->type == "walk"): ?>
															 &nbsp; <i class="material-icons right expand-bus-line">directions_walk</i>
														 <?php endif; ?>

														 <?php if ($leg->stops != null): ?>
																<i class="material-icons right expand-bus-line">add</i>
														 <?php endif ?>
													 </div>

												 </div>

													 <?php
													 if ($leg->stops != null): ?>
													 <div class="collapsible-body">
															 <?php
															 foreach($leg->stops as $stop):

																 echo  date('H:i', strtotime($stop->arrival)).'&emsp;'.$stop->name."<br />";
															 endforeach;?>


													 </div>
													 <?php endif ?>

											 </li>
											 <?php endforeach; ?>
										 </ul>
									 </div>
									 <div class="col l6">
										 <form class="reservation-form" action="<?php echo URL_DIR.'reserve/confirm';?>" method="POST">
										 <input name="reservationdate" type="hidden" hidden value="<?php echo date("d.m.Y", strtotime($connection->departure));?>">
										 <input name="fromstation" type="hidden" hidden value="<?php echo current($connection->legs)->stopid?>">
										 <input name="tostation" type="hidden" hidden value="<?php echo end($connection->legs)->stopid?>">
										 <input name="departure" type="hidden" hidden value="<?php echo date('H:i', strtotime($connection->departure));?>">
										 <input name="arrival" type="hidden" hidden value="<?php echo date('H:i', strtotime($connection->arrival));?>">


										   <div class="row">
											   <div class="input-field col l6">
												 <i class="material-icons prefix">person</i>
												 <input id="first_name" name="firstname" type="text" class="validate">
												 <label for="first_name">First Name</label>
											   </div>
											   <div class="input-field col l6">
												 <input id="last_name" name="lastname" type="text" class="validate">
												 <label for="last_name">Last Name</label>
											   </div>

											 <div class="input-field col l6">
											   <i class="material-icons prefix">email</i>
											   <input id="icon_prefix" name="email" type="text" class="validate">
											   <label for="icon_prefix">E-mail</label>
											 </div>
											 <div class="input-field col l6">
											   <i class="material-icons prefix">phone</i>
											   <input id="icon_prefix" name="phone" type="text" class="validate">
											   <label for="icon_prefix">Phone number</label>
											 </div>

											 <div class="input-field col l12">
											   <i class="material-icons prefix">directions_bike</i>
											   <select class="form-bikes" name="bikenumber">
												 <option value="" disabled selected>Bikes</option>
												 <option value="1">1</option>
												 <option value="2">2</option>
												 <option value="3">3</option>
												 <option value="4">4</option>
												 <option value="5">5</option>
												 <option value="6+">6</option>
												 <option value="7">7</option>
												 <option value="8">8</option>
												 <option value="9">9</option>
												 <option value="10+">10+</option>
											   </select>
											 </div>



											 <div class="input-field col l12 additional-info">
											   <i class="material-icons prefix">edit</i>
											   <textarea id="textarea1" name="remarks" class="materialize-textarea"></textarea>
											   <label for="textarea1">Remarks</label>
											 </div>

											 <div class="col l6">
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
					 	<?php endif; ?>
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
