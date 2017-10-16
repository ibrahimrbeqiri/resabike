<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

?>


<div class="container">
	<div class="col l12 center">
		<h4>Welcome <?php echo ' '.$user->getFirstname().' '.$user->getLastname();?></h4>
	</div>
	<div class="col l12 center">
		<a href="<?php echo URL_DIR.'admin/logout';?>">Log out</a>
		<button class="btn waves-effect waves-light">See reservations</button>
		<button class="btn waves-effect waves-light">Modify stations</button>
		<button class="btn waves-effect waves-light">some stuff</button>
	</div>


</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
	?>
