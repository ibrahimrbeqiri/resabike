<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];


?>


<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Welcome <?php echo ' '.$user->getName().' '.$user->getLastname();?> <a href="<?php echo URL_DIR.'admin/account';?>"><i class="material-icons">info</i></a></h4>
		<?php if ($msg): ?>
			<div class="col l12">
				<?php echo $msg ?>
			</div>
		<?php endif; ?>
		<a href="<?php echo URL_DIR.'admin/busdriverReservations';?>">
		<button class="btn waves-effect waves-light">
			<i class="material-icons prefix">directions_bus</i>
			<span>See reservations</span>
		</button>
		</a>
		<?php if($user->getuserRoleId() != 3) :?>
    		<a href="<?php echo URL_DIR.'admin/reservations';?>">
    		<button class="btn waves-effect waves-light">
    			<i class="material-icons prefix">book</i>
    			<span>See reservations</span>
    		</button>
    		</a>
    		<a href="<?php echo URL_DIR.'admin/stations';?>">
    			<button class="btn waves-effect waves-light">
    				<i class="material-icons prefix">place</i>
    				<span>Modify stations</span>
    			</button>
    		</a>
    		<?php if($user->getuserRoleId() != 2) :?>
    		<a href="<?php echo URL_DIR.'admin/regions';?>">
    			<button class="btn waves-effect waves-light">
    				<i class="material-icons prefix">map</i>
    				<span>Modify regions</span>
    			</button>
    		</a>
    		<a href="<?php echo URL_DIR.'admin/users';?>">
    			<button class="btn waves-effect waves-light">
    				<i class="material-icons prefix">group</i>
    				<span>See all users</span>
    			</button>
    		</a>
    		<a href="<?php echo URL_DIR.'admin/register';?>">
    			<button class="btn waves-effect waves-light">
    				<i class="material-icons prefix">person_add</i>
    				<span>Create a new user</span>
    			</button>
    		</a>
    		<?php endif;?>
		<?php endif;?>
	</div>

</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
