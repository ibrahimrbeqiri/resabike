<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];

$roles = $_SESSION['user_roles'];
$regions = $_SESSION['user_regions'];

?>


<div class="container">
	<div class="row">
		<div class="col l12">
			<h3 class="left"><?php echo $lang['ADMIN_REGISTER_HEADING']; ?></h3>
			<?php if ($msg): ?>
				<?php echo $msg ?>
			<?php endif; ?>
		</div>
		<form class="col s12" method="post" action="<?php echo URL_DIR.'admin/register';?>">
			<div class="col l12">
				<div class="input-field col s6 l6">
					<i class="material-icons prefix">person_outline</i>
				  <input type="text" name="username" class="validate">
				  <label for="username"><?php echo $lang['ADMIN_USER_USERNAME']; ?></label>
				</div>

			</div>
			<div class="col l12">
				<div class="input-field col s6 l6">
					<i class="material-icons prefix">person</i>
				  <input type="text" name="name" class="validate">
				  <label for="firstname"><?php echo $lang['ADMIN_USER_FIRSTNAME']; ?></label>
				</div>
				<div class="input-field col s6 l6">
				  <input type="text" name="lastname" class="validate">
				  <label for="lastname"><?php echo $lang['ADMIN_USER_LASTNAME']; ?></label>
				</div>
			</div>

			<div class="col l12">
				<div class="input-field col s6 l6">
					<i class="material-icons prefix">vpn_key</i>
				  <input type="password" name="password" class="validate">
				  <label for="password"><?php echo $lang['ADMIN_USER_PASSWORD']; ?></label>
				</div>
				<div class="input-field col s6 l6">
				  <input type="password" name="confirmpassword" class="validate">
				  <label for="confirmpassword"><?php echo $lang['ADMIN_USER_CONFIRM_PASSWORD']; ?></label>
				</div>
			</div>

			<div class="col l12">
				<div class="input-field col s6 l6">
					<i class="material-icons prefix">mail</i>
				  <input type="email" name="email" class="validate">
				  <label for="email"><?php echo $lang['ADMIN_USER_EMAIL']; ?></label>
				</div>

				<div class="input-field col s6 l6">
				  <select name="role">
					  <option disabled selected><?php echo $lang['ADMIN_USER_ROLE']; ?></option>
					  <?php foreach ($roles as $role): ?>
						  <option value="<?php echo $role['roleId']; ?>"><?php echo $role['role']; ?></option>
					  <?php endforeach; ?>
				  </select>
				</div>
			</div>

			<div class="col l12">
				<div class="input-field col s12 l6">
					<i class="material-icons prefix">phone</i>
				  <input type="tel" name="phone" class="validate">
				  <label for="phone"><?php echo $lang['ADMIN_USER_PHONE']; ?></label>
				</div>
				<div class="input-field col s6 l6">
				  <select name="region">
					  <option disabled selected><?php echo $lang['ADMIN_USER_REGION']; ?></option>
					  <?php foreach ($regions as $region): ?>
						  <option value="<?php echo $region['regionId']; ?>"><?php echo $region['regionName']; ?></option>
					  <?php endforeach; ?>
				  </select>
				</div>
			</div>


			<div class="col s12">
				<div class="row">
					<div class="col s6">
						<button class="btn waves-effect waves-light" type="submit" name="action">
							<?php echo $lang['ADMIN_REGISTER_REGISTER']; ?>
						</button>
					</div>
					<div class="col s6">
						<a href="<?php echo URL_DIR.'admin/menu';?>">
							<button class="btn waves-effect waves-light right" type="button">
								<?php echo $lang['ADMIN_REGISTER_CANCEL']; ?>
								<i class="material-icons left">cancel</i>
							</button>
						</a>
					</div>
				</div>
			</div>


		</form>
	</div>
</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
