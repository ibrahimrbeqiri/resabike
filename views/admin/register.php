<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];

$roles = $_SESSION['user_roles'];
$zones = $_SESSION['user_zones'];

?>


<div class="container">
	<div class="row">
		<div class="col l12">
			<h3 class="left">Register new user</h3>
		</div>
		<form class="col s12" method="post" action="<?php echo URL_DIR.'admin/register';?>">
			<div class="col l12">
				<div class="input-field col s6 l6">
					<i class="material-icons prefix">person_outline</i>
				  <input type="text" name="username" class="validate">
				  <label for="first_name">Userame</label>
				</div>

			</div>
			<div class="col l12">
				<div class="input-field col s6 l6">
					<i class="material-icons prefix">person</i>
				  <input type="text" name="name" class="validate">
				  <label for="first_name">First Name</label>
				</div>
				<div class="input-field col s6 l6">
				  <input type="text" name="lastname" class="validate">
				  <label for="last_name">Last Name</label>
				</div>
			</div>

			<div class="col l12">
				<div class="input-field col s6 l6">
					<i class="material-icons prefix">vpn_key</i>
				  <input type="password" name="password" class="validate">
				  <label for="password">Password</label>
				</div>
				<div class="input-field col s6 l6">
				  <input type="password" name="confirmpassword" class="validate">
				  <label for="password">confirm password</label>
				</div>
			</div>

			<div class="col l12">
				<div class="input-field col s6 l6">
					<i class="material-icons prefix">mail</i>
				  <input type="email" name="email" class="validate">
				  <label for="email">Email</label>
				</div>

				<div class="input-field col s6 l6">
				  <select name="role">
					  <option disabled selected>User role</option>
					  <?php foreach ($roles as $role): ?>
						  <option value="<?php echo $role[id]; ?>"><?php echo $role[role]; ?></option>
					  <?php endforeach; ?>
				  </select>
				</div>
			</div>

			<div class="col l12">
				<div class="input-field col s12 l6">
					<i class="material-icons prefix">phone</i>
				  <input type="tel" name="phone" class="validate">
				  <label for="email">Phone number</label>
				</div>
				<div class="input-field col s6 l6">
				  <select name="region">
					  <option disabled selected>User Region</option>
					  <?php foreach ($zones as $zone): ?>
						  <option value="<?php echo $zone['id']; ?>"><?php echo $zone['name']; ?></option>
					  <?php endforeach; ?>
				  </select>
				</div>
			</div>


			<div class="col s12">
				<div class="row">
					<div class="col s6">
						<button class="btn waves-effect waves-light" type="submit" name="action">Register
						</button>
					</div>
					<div class="col s6">
						<a href="<?php echo URL_DIR.'admin/menu';?>">
							<button class="btn waves-effect waves-light right" type="button">Cancel
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
