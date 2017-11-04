<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$account = $_SESSION['accountInfo'];

?>

<div class="container">
	<div class="col s12">
		<a href="<?php echo URL_DIR.'admin/menu';?>">
			<button class="btn waves-effect waves-light right" type="button">
				<?php echo $lang['ADMIN_REGISTER_CANCEL']; ?>
				<i class="material-icons left">cancel</i>
			</button>
		</a>
	</div>
	<div class="col l12">
		<h4><?php echo $lang['ADMIN_ACCOUNT_HEADING']; ?></h4>
		<p><?php echo $lang['ADMIN_ACCOUNT_TIP']; ?></p>
		<h5><?php echo $lang['ADMIN_USER_USERNAME']; ?>: <?php echo $account['0']['username']; ?></h5>
		<h5><?php echo $lang['ADMIN_USER_FIRSTNAME']; ?>: <?php echo $account['0']['name']; ?></h5>
		<h5><?php echo $lang['ADMIN_USER_LASTNAME']; ?>: <?php echo $account['0']['lastname']; ?></h5>
		<h5><?php echo $lang['ADMIN_USER_EMAIL']; ?>: <?php echo $account['0']['email']; ?></h5>
		<h5><?php echo $lang['ADMIN_USER_PHONE']; ?>: <?php echo $account['0']['phone']; ?></h5>
		<h5><?php echo $lang['ADMIN_USER_ROLE']; ?>: <?php echo $account['0']['role']; ?></h5>
		<h5><?php echo $lang['ADMIN_USER_REGION']; ?>: <?php echo $account['0']['regionName']; ?></h5>
	</div>
</div>

<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
