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
  	<div class="row col6">
  	<select class="dateSelection" name="reservationdate">
  			<option selected disabled>Pick a date</option>
  			<option value="<?php echo date("d.m.Y", strtotime("tomorrow")); ?>">Tomorrow: <?php echo date("d.m.Y", strtotime("tomorrow"));?></option>
			<option value="<?php echo date('d.m.Y');?>">Today: <?php echo date('d.m.Y');?></option>
			<option value="<?php echo date("d.m.Y", strtotime("yesterday")); ?>">Yesterday: <?php echo date("d.m.Y", strtotime("yesterday"));?></option>
		</select>
	</div>
		<div class="row">
    		<div class="col l6">
       			<input id="icon_prefix" type="text" class="datepicker" name="customDate" placeholder="Pick another date">
       			<button class="btn waves-effect waves-light" type="submit">
					  Pick date
				</button>
       		</div>
   		</div>
   	
		<?php if(!empty($reservations)):?>
		
		<ul class="collapsible" data-collapsible="accordion">
		<?php foreach ($reservations as $reservation): ?>
    		<li>
    		
      			<div class="collapsible-header">
              		<div>Date: <?php echo $reservation['reservationdate'].'&emsp;';?></div>
                  	<div>From: <?php echo $reservation['stationFrom'].'&emsp;';?></div>
                  	<div>Departure: <?php echo $reservation['departure'].'&emsp;';?></div>
                  	<div>Total bikes: <?php echo $reservation['totalbikes']?></div>
      			</div>
      			<div class="collapsible-body">
      				<div>
                  	To: <?php echo $reservation['stationTo'].'&emsp;';?>
                  	Arrival: <?php echo $reservation['arrival'].'&emsp;';?>
                  	People: <?php echo $reservation['firstname'].' '.$reservation['lastname'].': Bikes('.$reservation['bikenumber'].')'.',&emsp;'?>
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
