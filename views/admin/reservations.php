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
		<form action="index.html" method="post">
			<button class="btn waves-effect waves-light left" type="submit">Save reservations
				<i class="material-icons right">save</i>
			</button>

			<a href="<?php echo URL_DIR.'admin/menu';?>">
				<button class="btn waves-effect waves-light right" type="button">Cancel
					<i class="material-icons left">cancel</i>
				</button>
			</a>

			<table id="reservations-list">
				<thead>
					<th>ID</th>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Phone</th>
					<th>Email</th>
					<th>Bike Number</th>
					<th>Date</th>
					<th>From</th>
					<th>To</th>
					<th>Departure</th>
					<th>Arrival</th>
					<th>Remarks</th>
				</thead>
				<tbody>
					<?php foreach ($reservations as $reservation): ?>
					<tr>
							<td><?php echo $reservation['id'] ?></td>
							<td><input type="text" name="firstname" value="<?php echo $reservation['firstname'] ?>"></td>
							<td><input type="text" name="lastname" value="<?php echo $reservation['lastname'] ?>"></td>
							<td><input type="text" name="phone" value="<?php echo $reservation['phone'] ?>"></td>
							<td><input type="text" name="email" value="<?php echo $reservation['email'] ?>"></td>
							<td><input type="text" name="bikenumber" value="<?php echo $reservation['bikenumber'] ?>"></td>
							<td><input type="text" name="reservationdate" value="<?php echo $reservation['reservationdate'] ?>"></td>
							<td><input type="text" name="fromstation" value="<?php echo $reservation['fromstation'] ?>"></td>
							<td><input type="text" name="tostation" value="<?php echo $reservation['tostation'] ?>"></td>
							<td><input type="text" name="departure" value="<?php echo $reservation['departure'] ?>"></td>
							<td><input type="text" name="arrival" value="<?php echo $reservation['arrival'] ?>"></td>
							<td><input type="text" name="remarks" value="<?php echo $reservation['remarks'] ?>"></td>
							<td><a class="btn-floating delete-row"><i class="material-icons">delete</i></a></td>
					</tr>
					<?php endforeach; ?>
				</tbody>

			</table>
		</form>

		<button id="add-table-row" class="btn waves-effect waves-light left" type="button" name="action">Add reservation
	  		<i class="material-icons right">add</i>
		</button>
	</div>


</div>







<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>