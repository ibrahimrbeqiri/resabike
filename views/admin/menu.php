<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];


var_dump($user);
?>


<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Welcome <?php echo ' '.$user->getName().' '.$user->getLastname();?></h4>
		<a href="<?php echo URL_DIR.'admin/busdriverReservations';?>">
		<button class="btn waves-effect waves-light">
			<i class="material-icons prefix">book</i>
			<span>See reservations</span>
		</button>
		</a>
		<a href="<?php echo URL_DIR.'admin/reservations';?>">
		<button class="btn waves-effect waves-light">
			<i class="material-icons prefix">book</i>
			<span>See reservations</span>
		</button>
		</a>
		<a href="<?php echo URL_DIR.'admin/regions';?>">
			<button class="btn waves-effect waves-light">
				<i class="material-icons prefix">place</i>
				<span>Modify regions</span>
			</button>
		</a>
		<a href="<?php echo URL_DIR.'admin/stations';?>">
			<button class="btn waves-effect waves-light">
				<i class="material-icons prefix">map</i>
				<span>Modify stations</span>
			</button>
		</a>
		<a href="<?php echo URL_DIR.'admin/register';?>">
			<button class="btn waves-effect waves-light">
				<i class="material-icons prefix">person_add</i>
				<span>Create a new user</span>
			</button>
		</a>
		
	</div>

</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
