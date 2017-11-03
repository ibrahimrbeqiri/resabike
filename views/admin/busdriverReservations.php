<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$reservations = $_SESSION['busdriverReservations'];
$stations = $_SESSION['stations'];

$sums = $_SESSION['sums'];
?>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Reservations:</h4>
		<?php if ($msg): ?>
			<?php echo $msg ?>
		<?php endif; ?>
  <form id="busDriverForm" action="<?php echo URL_DIR.'admin/busdriverReservations';?>" method="post">  
  
  		<select class="dateSelection" name="reservationdate">
			<option selected value="<?php echo date('d.m.Y', strtotime('today'));?>">Today: <?php echo date('d.m.Y', strtotime('today'));?></option>
			<option value="<?php echo date("d.m.Y", strtotime("last week monday")); ?>">Last week: <?php echo date("d.m.Y", strtotime("last week monday"));?></option>
		</select>
		
		
		<button class="btn-floating" type="submit" name="save">
			<i class="material-icons">save</i>
		</button>
		
		<ul class="collapsible" data-collapsible="accordion">
		
		<?php foreach ($reservations as $reservation): ?>
    		<li>
    		
      			<div class="collapsible-header">
              		<div>Date: <?php echo $reservation['reservationdate'].'&emsp;';?></div>
              		<?php foreach($stations as $station):?>
              			<?php if($station['stationId'] == $reservation['fromstation']):?>
                  			<div>From: <?php echo $station['stationName'].'&emsp;';?></div>
                  		<?php endif;?>
                  	<?php endforeach;?>
                  	<div>Departure: <?php echo $reservation['departure'].'&emsp;';?></div>
      			</div>
      			<div class="collapsible-body">
      				<div>
					<?php foreach($stations as $station):?>
              			<?php if($station['stationId'] == $reservation['tostation']):?>
                  			To: <?php echo $station['stationName'].'&emsp;';?>
                  		<?php endif;?>
                  	<?php endforeach;?>
                  	Arrival: <?php echo $reservation['arrival'].'&emsp;';?>
      			    NR. of Bikes: <?php echo $reservation['bikenumber'].'&emsp;';?>
      			    Person: <?php echo $reservation['firstname'].' '.$reservation['lastname'];?>
      			    
      				</div>		
      			
      			</div>
      		</li>
      	<?php endforeach;?>
 		</ul>
		<div id="div-table" class="col l12">
			<?php foreach ($reservations as $reservation): ?>
			<div class="table-row">
				<div class="table-cell">
					<p><?php echo $reservation['firstname'] ?></p>
				</div>
				<div class="table-cell">
					<p><?php echo $reservation['lastname'] ?></p>
				</div>
				<div class="table-cell">
					<p><?php echo $reservation['bikenumber'] ?></p>
				</div>
				<div class="table-cell">
					<p><?php echo $reservation['reservationdate'] ?></p>
				</div>
				<div class="table-cell">
					<p><?php echo $reservation['fromstation'] ?></p>
				</div>
				<div class="table-cell">
					<p><?php echo $reservation['tostation'] ?></p>
				</div>
				<div class="table-cell">
					<p><?php echo $reservation['departure'] ?></p>
				</div>
				<div class="table-cell">
					<p><?php echo $reservation['arrival'] ?></p>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
  </form>
		



	</div>


</div>







<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
