<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

?>


<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Welcome <?php echo ' '.$user->getFirstname().' '.$user->getLastname();?></h4>

		<button class="btn waves-effect waves-light">
			<i class="material-icons prefix">book</i>
			<span>See reservations</span>
		</button>
		<a href="<?php echo URL_DIR.'admin/stations';?>">
			<button class="btn waves-effect waves-light">
				<i class="material-icons prefix">map</i>
				<span>Modify stations</span>
			</button>
		</a>
		<button class="btn waves-effect waves-light">
			<i class="material-icons prefix">person_add</i>
			<span>Create a new user</span>
		</button>
	</div>


</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
