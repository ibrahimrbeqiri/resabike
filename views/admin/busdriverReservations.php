<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$reservations = $_SESSION['busdriverReservations'];
 // foreach ($reservations as $asd) {
 // 	echo $asd['stationFrom']." ".$asd['departure']." ".$asd['stationTo']."<br />";
 // }
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


		<ul id="Bus-driver-reservations" class="collapsible" data-collapsible="accordion">

		<?php foreach($reservations as $reservation => $single):?>
			<?php $prev = $reservations[$reservation-1];?>


			<?php if ($prev['fromstation'] == $single['fromstation'] && $prev['departure'] == $single['departure'] && $prev['reservationdate'] == $single['reservationdate']): ?>
				<div class="table-row">
					<div class="table-cell"><p><?php echo $single['firstname'] ?></p></div>
					<div class="table-cell"><p><?php echo $single['lastname'] ?></p></div>
					<div class="table-cell"><p><?php echo $single['phone'] ?></p></div>
					<div class="table-cell"><p><?php echo $single['email'] ?></p></div>
					<div class="table-cell"><p><?php echo $single['stationTo'] ?></p></div>
					<div class="table-cell right"><p class="singlebike"><?php echo $single['bikenumber'] ?></p></div>

				</div>
			<?php else:

				//special case for the first all rows except the first one
				if ($reservation != 0): ?>
						</div>
					</div>
				</li>
				<?php endif; ?>


				<li>
					<div class="collapsible-header">
						<div style="width:100%; text-align:left;">
							<b>Date: <?php echo $single['reservationdate'].'&emsp;';?></b>
							<b>From: <?php echo $single['stationFrom'].'&emsp;';?></b>
							<b>Departure: <?php echo $single['departure'].'&emsp;';?></b>
							<b class="right"><span class="totalbikes"></span><i class="material-icons prefix">directions_bike</i></b>
						</div>

					</div>
					<div class="collapsible-body">
						<div id="div-table" style="width:100%;">
							<div class="table-row">
								<div class="table-cell"><p><?php echo $single['firstname'] ?></p></div>
								<div class="table-cell"><p><?php echo $single['lastname'] ?></p></div>
								<div class="table-cell"><p><?php echo $single['phone'] ?></p></div>
								<div class="table-cell"><p><?php echo $single['email'] ?></p></div>
								<div class="table-cell"><p><?php echo $single['stationTo'] ?></p></div>
								<div class="table-cell right"><p class="singlebike"><?php echo $single['bikenumber'] ?></p></div>
							</div>
					<?php //special case for the last row ?>
					<?php if ($reservation == count($reservations)-1): ?>
							</div>
						</div>
					</li>
					<?php endif; ?>

			<?php endif; ?>
      	<?php endforeach;?>
 		</ul>
 	</form>
		</div>
	</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
