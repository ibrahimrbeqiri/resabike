<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$reservations = $_SESSION['busdriverReservations'];

$sums = $_SESSION['sums'];
var_dump($sums);
?>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Reservations:</h4>
		<?php if ($msg): ?>
			<?php echo $msg ?>
		<?php endif; ?>
  <form id="busDriverForm" action="<?php echo URL_DIR.'admin/busdriverReservations';?>" method="post">  
  		<select class="dateSelection" name="reservationdate">
 
			<option selected value="<?php echo date('d.m.Y');?>">Today: <?php echo date('d.m.Y');?></option>

		</select>
		<button class="btn-floating" type="submit" name="save">
			<i class="material-icons">save</i>
		</button>
		
		<ul class="collapsible" data-collapsible="accordion">
		
		<?php foreach ($reservations as $reservation): ?>
    		<li>
    		
      			<div class="collapsible-header">
              		<div>Date: <?php echo $reservation['reservationdate'].'&emsp;';?></div>
                  	<div>From: <?php echo $reservation['fromstation'].'&emsp;';?></div>
                  	<div>Departure: <?php echo $reservation['departure'].'&emsp;';?></div>
      			</div>
							<?php foreach($stations as $station):?>
									<?php if($station['stationId'] == $reservation['fromstation']):?>
									<?php endif;?>
									<?php if($station['stationId'] == $reservation['tostation']):?>

									<?php endif;?>
								<?php endforeach;?>	
      			<div class="collapsible-body">
      				<div>Firstname: <?php echo $reservation['firstname'].'&emsp;';?>
      					 Lastname: <?php echo $reservation['lastname'].'&emsp;';?>
      					 NR. of Bikes: <?php echo $reservation['bikenumber'].'&emsp;';?>
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
