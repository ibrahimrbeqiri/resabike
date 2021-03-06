<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];


?>


<div class="container">
	<div class="col l12 center card admin-menu">
		<h4><?php echo $lang['ADMIN_MENU_WELCOME']; ?><?php echo ' '.$user->getName().' '.$user->getLastname();?> <a href="<?php echo URL_DIR.'admin/account';?>"><i class="material-icons">info</i></a></h4>
		<?php if ($msg): ?>
			<div class="col l12">
				<?php echo $msg ?>
			</div>
		<?php endif; ?>
		<a href="<?php echo URL_DIR.'admin/busdriverreservations';?>">
		<button class="btn waves-effect waves-light">
			<i class="material-icons prefix">directions_bus</i>
			<span><?php echo $lang['ADMIN_MENU_SEE_RESERVATIONS']; ?></span>
		</button>
		</a>
		<?php if($user->getuserRoleId() != 3) :?>
    		<a href="<?php echo URL_DIR.'admin/reservations';?>">
    		<button class="btn waves-effect waves-light">
    			<i class="material-icons prefix">book</i>
    			<span><?php echo $lang['ADMIN_MENU_MODIFY_RESERVATIONS']; ?></span>
    		</button>
    		</a>
    		<a href="<?php echo URL_DIR.'admin/stations';?>">
    			<button class="btn waves-effect waves-light">
    				<i class="material-icons prefix">place</i>
    				<span><?php echo $lang['ADMIN_MENU_MODIFY_STATIONS']; ?></span>
    			</button>
    		</a>
    		<?php if($user->getuserRoleId() != 2) :?>
    		<a href="<?php echo URL_DIR.'admin/regions';?>">
    			<button class="btn waves-effect waves-light">
    				<i class="material-icons prefix">map</i>
    				<span><?php echo $lang['ADMIN_MENU_MODIFY_REGIONS']; ?></span>
    			</button>
    		</a>
    		<a href="<?php echo URL_DIR.'admin/users';?>">
    			<button class="btn waves-effect waves-light">
    				<i class="material-icons prefix">group</i>
    				<span><?php echo $lang['ADMIN_MENU_SEE_ALL_USERS']; ?></span>
    			</button>
    		</a>
    		<a href="<?php echo URL_DIR.'admin/register';?>">
    			<button class="btn waves-effect waves-light">
    				<i class="material-icons prefix">person_add</i>
    				<span><?php echo $lang['ADMIN_MENU_CREATE_USER']; ?></span>
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
