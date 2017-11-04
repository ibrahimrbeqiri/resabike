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

$stations = $_SESSION['stations'];

?>

<div class="container">
	<div class="row">
		<div class="col l12">
			<h3><?php echo $lang['CONFIRM_HEADING']; ?></h3>
			<p><?php echo $lang['CONFIRM_DATE']; ?> <?php echo $reservationdate ?></p>
			<?php foreach($stations as $station):?>
				<?php if($station['stationId'] == $fromstation):?>
				<p><?php echo $lang['CONFIRM_FROM']; ?> <?php echo $station['stationName']." ".$departure ?></p>
				<?php endif;?>
			<?php endforeach;?>
			<?php foreach($stations as $station):?>
				<?php if($station['stationId'] == $tostation):?>
				<p><?php echo $lang['CONFIRM_TO']; ?> <?php echo $station['stationName']." ".$arrival ?></p>
				<?php endif;?>
			<?php endforeach;?>
			<p><?php echo $lang['CONFIRM_BIKES']; ?><?php echo $bikenumber ?></p>
			<p><?php echo $lang['CONFIRM_FIRSTNAME']; ?><?php echo $firstname ?></p>
			<p><?php echo $lang['CONFIRM_FIRSTNAME']?><?php echo $lastname ?></p>
			<p><?php echo $lang['CONFIRM_EMAIL']?><?php echo $email ?></p>
			<p><?php echo $lang['CONFIRM_PHONE']?><?php echo $phone ?></p>
			<p><?php echo $lang['CONFIRM_REMARKS']?><?php echo $remarks ?></p>



			<a href="<?php echo URL_DIR.'reserve/confirmed';?>">
				<button class="btn waves-effect waves-light" type="button">
					<i class="material-icons prefix">check</i>
					<span><?php echo $lang['CONFIRM_CONFIRM']; ?></span>
				</button>
			</a>
			<a href="<?php echo URL_DIR.'reserve/cancel';?>">
				<button class="btn waves-effect waves-light" type="button">
					<i class="material-icons prefix">cancel</i>
					<span><?php echo $lang['CONFIRM_CANCEL']; ?></span>
				</button>
			</a>
		</div>

	</div>

</div>








<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
