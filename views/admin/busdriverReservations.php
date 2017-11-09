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
		<h4><?php echo $lang['ADMIN_BUSDRIVER_RESERVATIONS_TITLE']; ?></h4>
		<?php if ($msg): ?>
			<?php echo $msg ?>
		<?php endif; ?>
  <form name="busDriverForm" action="<?php echo URL_DIR.'admin/busdriverReservations';?>" method="post">

  <div class="col l12"><?php echo $lang['ADMIN_BUSDRIVER_RESERVATIONS_INFO']; ?></div>
		<div class="row">
			<div class="col l5">
			<select class="dateSelection" name="reservationdate">
					<option selected disabled><?php echo $lang['ADMIN_RESERVATIONS_PICK_DATE']; ?></option>
					<option value="<?php echo date("d.m.Y", strtotime("tomorrow")); ?>"><?php echo $lang['ADMIN_BUSDRIVER_RESERVATIONS_TOMORROW']; ?> <?php echo date("d.m.Y", strtotime("tomorrow"));?></option>
					<option value="<?php echo date('d.m.Y');?>"><?php echo $lang['ADMIN_BUSDRIVER_RESERVATIONS_TODAY']; ?> <?php echo date('d.m.Y');?></option>
					<option value="<?php echo date("d.m.Y", strtotime("yesterday")); ?>"><?php echo $lang['ADMIN_BUSDRIVER_RESERVATIONS_YESTERDAY']; ?> <?php echo date("d.m.Y", strtotime("yesterday"));?></option>
			</select>
			</div>
			<div class="col l4">
				<input id="icon_prefix" type="text" class="datepicker" name="customDate" placeholder="<?php echo $lang['ADMIN_RESERVATIONS_PICK_DATE_INFO']; ?>">
			</div>
			<div class="col l3">
				<button class="btn waves-effect waves-light" type="submit" name="formsubmit" id="busdriver-submit">
					  <?php echo $lang['ADMIN_RESERVATIONS_PICK_DATE']; ?>
				</button>
			</div>
   		</div>
</form>

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
					<div class="table-cell"><p><?php echo $single['arrival'] ?></p></div>
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
							<b><?php echo $lang['RESERVE_DATE']; ?>: <?php echo $single['reservationdate'].'&emsp;';?></b>
							<b><?php echo $lang['RESERVE_START']; ?>: <?php echo $single['stationFrom'].'&emsp;';?></b>
							<b><?php echo $lang['ADMIN_RESERVATIONS_DEPARTURE']; ?>: <?php echo $single['departure'].'&emsp;';?></b>
							<b class="right"><span class="totalbikes"></span><i class="material-icons prefix">directions_bike</i></b>
						</div>

					</div>
					<div class="collapsible-body">
						<div id="div-table" style="width:100%;">
							<div class="table-row">
								<div class="table-cell"><b><?php echo $lang['RESULTS_FORM_FIRSTNAME']; ?></b></div>
								<div class="table-cell"><b><?php echo $lang['RESULTS_FORM_LASTNAME']; ?></b></div>
								<div class="table-cell"><b><?php echo $lang['RESULTS_FORM_PHONE']; ?></b></div>
								<div class="table-cell"><b><?php echo $lang['RESULTS_FORM_EMAIL']; ?></b></div>
								<div class="table-cell"><b><?php echo $lang['RESERVE_DESTINATION']; ?></b></div>
								<div class="table-cell"><b><?php echo $lang['ADMIN_RESERVATIONS_ARRIVAL']; ?></b></div>
								<div class="table-cell right"><i class="material-icons prefix">directions_bike</i></div>
								<!-- needed for js calculation -->
								<div class="table-cell" hidden><p hidden class="singlebike">0</p></div>

							</div>
							<div class="table-row">
								<div class="table-cell"><p><?php echo $single['firstname'] ?></p></div>
								<div class="table-cell"><p><?php echo $single['lastname'] ?></p></div>
								<div class="table-cell"><p><?php echo $single['phone'] ?></p></div>
								<div class="table-cell"><p><?php echo $single['email'] ?></p></div>
								<div class="table-cell"><p><?php echo $single['stationTo'] ?></p></div>
								<div class="table-cell"><p><?php echo $single['arrival'] ?></p></div>
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
		</div>
	</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
