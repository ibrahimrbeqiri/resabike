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
							<td><?php echo $reservation['firstname'] ?></td>
							<td><?php echo $reservation['lastname'] ?></td>
							<td><?php echo $reservation['phone'] ?></td>
							<td><?php echo $reservation['email'] ?></td>
							<td><?php echo $reservation['bikenumber'] ?></td>
							<td><?php echo $reservation['reservationdate'] ?></td>
							<td><?php echo $reservation['fromstation'] ?></td>
							<td><?php echo $reservation['tostation'] ?></td>
							<td><?php echo $reservation['departure'] ?></td>
							<td><?php echo $reservation['arrival'] ?></td>
							<td><?php echo $reservation['remarks'] ?></td>
					</tr>
					<?php endforeach; ?>
				</tbody>

			</table>

	</div>


</div>







<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>