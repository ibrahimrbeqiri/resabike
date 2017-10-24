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

		<div id="bus-driver-reservations">
			<?php foreach ($reservations as $reservation): ?>
			<div class="table-row">
				<div class="table-cell">
					<?php echo $reservation['firstname'] ?>
				</div>
				<div class="table-cell">
					<?php echo $reservation['lastname'] ?>
				</div>
				<div class="table-cell">
					<?php echo $reservation['bikenumber'] ?>
				</div>
				<div class="table-cell">
					<?php echo $reservation['reservationdate'] ?>
				</div>
				<div class="table-cell">
					<?php echo $reservation['fromstation'] ?>
				</div>
				<div class="table-cell">
					<?php echo $reservation['tostation'] ?>
				</div>
				<div class="table-cell">
					<?php echo $reservation['departure'] ?>
				</div>
				<div class="table-cell">
					<?php echo $reservation['arrival'] ?>
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
