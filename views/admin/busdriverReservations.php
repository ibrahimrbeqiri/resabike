<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$reservations = $_SESSION['busdriverReservations'];

?>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Reservations:</h4>
		<?php if ($msg): ?>
			<?php echo $msg ?>
		<?php endif; ?>
  <form name="busDriverForm" action="<?php echo URL_DIR.'admin/busdriverReservations';?>" method="post">

  <div class="col l12">Please select on the date you want to see the reservations for!</div>
		<div class="row">
			<div class="col l5">
			<select class="dateSelection" name="reservationdate">
					<option selected disabled>Pick a date</option>
					<option value="<?php echo date("d.m.Y", strtotime("tomorrow")); ?>">Tomorrow: <?php echo date("d.m.Y", strtotime("tomorrow"));?></option>
					<option value="<?php echo date('d.m.Y');?>">Today: <?php echo date('d.m.Y');?></option>
					<option value="<?php echo date("d.m.Y", strtotime("yesterday")); ?>">Yesterday: <?php echo date("d.m.Y", strtotime("yesterday"));?></option>
			</select>
			</div>
			<div class="col l5">
				<input id="icon_prefix" type="text" class="datepicker" name="customDate" placeholder="Pick another date">
			</div>
			<div class="col l2">
				<button class="btn waves-effect waves-light" type="submit" name="formsubmit" id="busdriver-submit">
					  Pick date
				</button>
			</div>
   		</div>

		<?php $groupedReservations = array();
		      $output = array();
		      $sfrom = null;
		      $departure = null;
		      foreach($reservations AS $reservation)
		      {
		          $sfrom = $reservation['stationFrom'];
		          $dep = $reservation['departure'];
		          $groupedReservations[$sfrom][$dep][] = array(
		              'reservation' => $reservation);
		          //$groupedReservations[$reservation['stationFrom']] = $reservation;
                
		      }
		      var_dump($groupedReservations);
		      
		?>
		<?php if(!empty($reservations)):?>
		<?php $groupedStations = array();?>
		<ul class="collapsible" data-collapsible="accordion">
		<?php foreach ($groupedReservations AS $groupedReservation): ?>
    		<li>
      			<div class="collapsible-header">
      			
              		<div>Date: <?php echo $groupedReservation['343'].'&emsp;';?></div>
                  	<div>From: <?php echo $groupedReservation[$reservation['stationFrom']].'&emsp;';?></div>
                  	<div>Departure: <?php echo $groupedReservation['departure'].'&emsp;';?></div>

      			</div>
      			
      			<div class="collapsible-body">
      				<div>
      				<?php foreach($groupedReservation AS $singleReservation):?>
                  	To: <?php echo $singleReservation['stationTo'].'&emsp;';?>
                  	Arrival: <?php echo $singleReservation['arrival'].'&emsp;';?>
                  	People: <?php echo $singleReservation['firstname'].' '.$singleReservation['lastname'].'&emsp;'.'Bikes('.$singleReservation['bikenumber'].')';?>
      				<?php endforeach;?>
      				</div>
      			</div>
      			
      		</li>
      	<?php endforeach;?>
 		</ul>
 		<?php endif;?>
 	</form>
		</div>
	</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
