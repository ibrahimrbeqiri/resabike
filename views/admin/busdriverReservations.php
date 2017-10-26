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

  <ul class="collapsible" data-collapsible="accordion">
    <li>
      <div class="collapsible-header">
  TEST
	</div>
      <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
  </ul>

		<div class="div-table">
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



	</div>


</div>







<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
