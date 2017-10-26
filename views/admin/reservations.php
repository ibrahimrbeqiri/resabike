<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$reservations = $_SESSION['reservations'];

?>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Reservations:</h4>
		<p class="<?php echo URL_DIR.'admin/reservations/save';?>">Disclamer: Make sure the reservation IDs are correct!</p>

			<a href="<?php echo URL_DIR.'admin/menu';?>">
				<button class="btn waves-effect waves-light right" type="button">Cancel
					<i class="material-icons left">cancel</i>
				</button>
			</a>
			<div id="bus-driver-reservations">
					<?php foreach ($reservations as $reservation): ?>
						<form action="index.html" method="post">
							<div class="table-row">
								<div class="table-cell"><a class="btn-floating" type="submit"><i class="material-icons">save</i></a></div>
								<div class="table-cell"><?php echo $reservation['id'] ?></div>
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
								<div class="table-cell"><a class="btn-floating" type="submit" value="<?php echo $reservation['id']?>"><i class="material-icons">delete</i></a></div>
							</div>
						</form>
					<?php endforeach; ?>
			</div>
	</div>


</div>







<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
