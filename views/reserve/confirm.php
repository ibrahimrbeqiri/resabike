<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];

$firstname = $_SESSION['reservationArray']['firstname'];
$lastname = $_SESSION['reservationArray']['lastname'];
$phone = $_SESSION['reservationArray']['phone'];
$email = $_SESSION['reservationArray']['email'];
$bikenumber = $_SESSION['reservationArray']['bikenumber'];
$remarks = $_SESSION['reservationArray']['remarks'];
$fromstation = $_SESSION['reservationArray']['fromstation'];
$tostation = $_SESSION['reservationArray']['tostation'];
$reservationdate = $_SESSION['reservationArray']['reservationdate'];
$departure = $_SESSION['reservationArray']['departure'];
$arrival = $_SESSION['reservationArray']['arrival'];

var_dump($_SESSION['reservationArray']);
?>

<div class="container">
	<div class="row">
		


		<a href="<?php echo URL_DIR.'reserve/confirmed';?>">
			<button class="btn waves-effect waves-light" type="button">
				<i class="material-icons prefix">map</i>
				<span>Confirm</span>
			</button>
		</a>
		<a href="<?php echo URL_DIR.'reserve/cancel';?>">
			<button class="btn waves-effect waves-light" type="button">
				<i class="material-icons prefix">map</i>
				<span>Cancel</span>
			</button>
		</a>
	</div>

</div>








<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
