<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
?>


<div class="row front-page">
	<div class="col m12 fp-img">
		<div class="col s12 m3 card right loginform">
			<form action="<?php echo URL_DIR.'login/connection';?>" method="post">
				<div class="row">

					<?php if ($msg): ?>
						<div class="col l12 error-messages">
							<?php echo $msg;?>
						</div>
					<?php endif; ?>

					<div class="input-field col s12 m12">
					  <i class="material-icons prefix">account_circle</i>
					  <input id="icon_prefix" type="text" class="validate" name="username">
					  <label for="icon_prefix"><?php echo $lang['LOGIN_USERNAME'] ?></label>
					</div>
					<div class="input-field col s12 m12">
					  <i class="material-icons prefix">vpn_key</i>
					  <input id="icon_prefix" type="password" class="validate" name="password">
					  <label for="icon_prefix"><?php echo $lang['LOGIN_PASSWORD'] ?></label>
					</div>
					<div class="col m12">
						<button class="btn waves-effect waves-light" type="submit" name="action">
							<?php echo $lang['LOGIN_LOGIN']; ?>
						</button>
					</div>
				</div>
			</form>
		</div>

	</div>
</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
	?>
