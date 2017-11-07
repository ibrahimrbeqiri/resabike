<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$reservations = $_SESSION['reservations'];

?>

<script type="text/javascript">
	<?php //this needs to be printed before you show the table ?>
	$(document).on('click', '.delete-row', function() {
		if(confirm("<?php echo $lang['ADMIN_COMMON_CONFIRMATION']; ?>")){
		$(this).child().click();
	}
	else{
		return false;
	}
});
</script>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Reservations:</h4>
		<p>Disclamer: Make sure the reservation IDs are correct!</p>
		<?php if ($msg): ?>
			<?php echo $msg ?>
		<?php endif; ?>
			<a href="<?php echo URL_DIR.'admin/menu';?>">
				<button class="btn waves-effect waves-light right" type="button">Cancel
					<i class="material-icons left">cancel</i>
				</button>
			</a>
			<form action="<?php echo URL_DIR.'admin/reservations';?>" method="post">
    			<div class="row">
        			<div class="col l4">
        				<input id="icon_prefix" type="text" class="datepicker" name="customReservationDate" placeholder="Pick another date">
        			</div>
        			<div class="col l2">
        				<button class="btn waves-effect waves-light" type="submit" name="reservationDateSubmit">
        					  Pick date
        				</button>
        			</div>
    			</div>
			</form>
			<table>

			</table>
		<?php if(!empty($reservations)):?>
			<div id="div-table" class="col l12">

				<div class="table-row">
					<form>
						<div class="table-cell">
							<button disabled class="btn-floating"></button>
						</div>
						<div class="table-cell">
							<input type="text" disabled value="ID">
						</div>
						<div class="table-cell">
							<input type="text" disabled value="First name">
						</div>
						<div class="table-cell">
							<input type="text" disabled value="Last name">
						</div>

						<div class="table-cell">
							<input type="text" disabled value="Phone">
						</div>

						<div class="table-cell">
							<input type="text" disabled value="E-mail">
						</div>

						<div class="table-cell">
							<input type="text" disabled value="Bikes">
						</div>

						<div class="table-cell">
							<input type="text" disabled value="Date">
						</div>

						<div class="table-cell">
							<input type="text" disabled value="From">
						</div>

						<div class="table-cell">
							<input type="text" disabled value="To">
						</div>

						<div class="table-cell">
							<input type="text" disabled value="Departure">
						</div>

						<div class="table-cell">
							<input type="text" disabled value="Arrival">
						</div>

						<div class="table-cell">
							<input type="text" disabled value="Remarks">
						</div>

						<div class="table-cell">
							<button  disabled class="btn-floating"></button>
						</div>
					</form>
				</div>
				

					<?php foreach ($reservations as $reservation): ?>

							<div class="table-row">
								<form action="<?php echo URL_DIR.'admin/editReservation';?>" method="post">
								<div class="table-cell">
									<button class="btn-floating" type="submit" name="modify">
										<i class="material-icons">save</i>
									</button>
								</div>

								<div class="table-cell"><input type="text" disabled value="<?php echo $reservation['id'] ?>"><input type="text" name="id" hidden value="<?php echo $reservation['id'] ?>"></div>
								<div class="table-cell"><input type="text" name="firstname" value="<?php echo $reservation['firstname'] ?>"></div>
								<div class="table-cell"><input type="text" name="lastname" value="<?php echo $reservation['lastname'] ?>"></div>
								<div class="table-cell"><input type="text" name="phone" value="<?php echo $reservation['phone'] ?>"></div>
								<div class="table-cell"><input type="text" name="email" value="<?php echo $reservation['email'] ?>"></div>
								<div class="table-cell"><input type="text" name="bikenumber" value="<?php echo $reservation['bikenumber'] ?>"></div>
								<div class="table-cell"><input type="text" name="reservationdate" value="<?php echo $reservation['reservationdate'] ?>"></div>
								<div class="table-cell"><input type="text" name="fromstation" value="<?php echo $reservation['fromstation'] ?>"></div>
								<div class="table-cell"><input type="text" name="tostation" value="<?php echo $reservation['tostation'] ?>"></div>
								<div class="table-cell"><input type="text" name="departure" value="<?php echo $reservation['departure'] ?>"></div>
								<div class="table-cell"><input type="text" name="arrival" value="<?php echo $reservation['arrival'] ?>"></div>
								<div class="table-cell"><input type="text" name="remarks" value="<?php echo $reservation['remarks'] ?>"></div>

								<div class="table-cell">
									<div class="delete-row">
										<button class="btn-floating" type="submit" name="delete">
											<i class="material-icons">delete</i>
										</button>
									</div>
								</div>

								</form>
							</div>

					<?php endforeach; ?>
			</div>
			<?php endif;?>
	</div>


</div>








<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
