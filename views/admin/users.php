<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];

$roles = $_SESSION['user_roles'];
$regions = $_SESSION['user_regions'];

$allusers = $_SESSION['allusers'];

var_dump($msg);

?>

<script type="text/javascript">
	<?php //this needs to be printed before you show the table ?>
	$(document).on('click', '.delete-row', function() {
		if(confirm("<?php echo $lang['ADMIN_COMMON_CONFIRMATION']; ?>")){
		$(this).child().click();
	}
	else{
		return false;
	}
});
</script>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Users:</h4>
		<?php if ($msg): ?>
			<?php echo $msg ?>
		<?php endif; ?>
		<div class="col l12 right-align">
			<a href="<?php echo URL_DIR.'admin/menu';?>">
					<button class="btn waves-effect waves-light" type="button">Cancel
						<i class="material-icons left">cancel</i>
					</button>
			</a>
		</div>


			<div id="div-table" class="col l12">
				<div class="table-row">
					<form>
						<div class="table-cell">
							<button disabled class="btn-floating"></button>
						</div>
						<div class="table-cell">
							<input type="text" disabled value="ID">
						</div>
						<div class="table-cell">
							<input type="text" disabled value="First name">
						</div>
						<div class="table-cell">
							<input type="text" disabled value="Last name">
						</div>
						<div class="table-cell">
							<input type="text" disabled value="E-mail">
						</div>
						<div class="table-cell">
							<input type="text" disabled value="Password">
						</div>
						<div class="table-cell">
							<input type="text" disabled value="Phone">
						</div>
						<div class="table-cell">
							<input type="text" disabled value="Role">
						</div>
						<div class="table-cell">
							<input type="text" disabled value="Region">
						</div>


						<div class="table-cell">
							<button  disabled class="btn-floating"></button>
						</div>
					</form>
				</div>

					<?php foreach ($allusers as $user): ?>
							<div class="table-row">
								<form action="<?php echo URL_DIR.'admin/editUsers';?>" method="post">
								<div class="table-cell">
									<button class="btn-floating" type="submit" name="modify">
										<i class="material-icons">save</i>
									</button>
								</div>

								<div class="table-cell"><input type="text" disabled value="<?php echo $user['id'] ?>"><input type="text" name="id" hidden value="<?php echo $user['id'] ?>"></div>
								<div class="table-cell"><input type="text" name="name" value="<?php echo $user['name'] ?>"></div>
								<div class="table-cell"><input type="text" name="lastname" value="<?php echo $user['lastname'] ?>"></div>
								<div class="table-cell"><input type="text" name="username" value="<?php echo $user['username'] ?>"></div>
								<div class="table-cell"><input type="text" name="originalusername" hidden value="<?php echo $user['username'] ?>"></div>
								<div class="table-cell"><input type="text" name="email" value="<?php echo $user['email'] ?>"></div>
								<div class="table-cell"><input type="text" name="password" hidden value="<?php echo $user['password'] ?>"></div>
								<div class="table-cell"><input type="text" name="phone" value="<?php echo $user['phone'] ?>"></div>
								<div class="table-cell">
    								<select name="userRoleId">
                					  <option selected value="<?php echo $user['roleId']?>"><?php echo $user['role'] ?></option>
                        					  <?php foreach ($roles as $role): ?>
                        						  <option value="<?php echo $role['roleId']; ?>"><?php echo $role['role']; ?></option>
                        					  <?php endforeach; ?>
                				  	</select>
								</div>

								<div class="table-cell">
    								<select name="userRegionId">
                    					  <option selected value="<?php echo $user['regionId']?>"><?php echo $user['regionName'] ?></option>
                            					  <?php foreach ($regions as $region): ?>
                            						  <option value="<?php echo $region['regionId']; ?>"><?php echo $region['regionName']; ?></option>
                            					  <?php endforeach; ?>
                    				</select>
								</div>

								<div class="table-cell">
									<div class="delete-row">
										<button class="btn-floating" type="submit" name="delete">
											<i class="material-icons">delete</i>
										</button>
									</div>
								</div>
								</form>
							</div>
					<?php endforeach; ?>
			</div>
	</div>


</div>





<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
