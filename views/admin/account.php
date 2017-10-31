<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$account = $_SESSION['accountInfo'];

?>

<div class="container">
	<div class="col s12">
		<a href="<?php echo URL_DIR.'admin/menu';?>">
			<button class="btn waves-effect waves-light right" type="button">Cancel
				<i class="material-icons left">cancel</i>
			</button>
		</a>
	</div>
	<div class="col l12">
		<h4>Account information:</h4>
		<p>To change any of this information, please contact a global admin.</p>
		<h5>Username: <?php echo $account['0']['username']; ?></h5>
		<h5>Firstname: <?php echo $account['0']['name']; ?></h5>
		<h5>Lastname: <?php echo $account['0']['lastname']; ?></h5>
		<h5>Email: <?php echo $account['0']['email']; ?></h5>
		<h5>Phone: <?php echo $account['0']['phone']; ?></h5>
		<h5>Role: <?php echo $account['0']['role']; ?></h5>
		<h5>Region: <?php echo $account['0']['regionName']; ?></h5>
	</div>
</div>

<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
