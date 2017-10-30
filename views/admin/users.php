<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];

$allusers = $_SESSION['allusers'];

?>


<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>users:</h4>
		<p>Disclamer: Make sure the user IDs are correct!</p>
		<?php if ($msg): ?>
			<?php echo $msg ?>
		<?php endif; ?>
			<a href="<?php echo URL_DIR.'admin/menu';?>">
				<button class="btn waves-effect waves-light right" type="button">Cancel
					<i class="material-icons left">cancel</i>
				</button>
			</a>
			<table>
				<thead>
    				<th> </th>
    				<th>ID</th>
    				<th>Firstname</th>
    				<th>Lastname</th>
    				<th>Username</th>
    				<th>Email</th>
    				<th>Password</th>
    				<th>Phone</th>
    				<th>Role</th>
    				<th>Region</th>
				</thead>
			</table>
			<div id="div-table" class="col l12">
			</div>
			<div id="div-table" class="col l12">
					<?php foreach ($allusers as $user): ?>
						<form action="<?php echo URL_DIR.'admin/editUsers';?>" method="post">
							<div class="table-row">
								<div class="table-cell">
									<button class="btn-floating" type="submit" name="modify">
										<i class="material-icons">save</i>
									</button>
								</div>

								<div class="table-cell"><p><?php echo $user['id'] ?></p><input type="text" name="id" hidden value="<?php echo $user['id'] ?>"></div>
								<div class="table-cell"><input type="text" name="name" value="<?php echo $user['name'] ?>"></div>
								<div class="table-cell"><input type="text" name="lastname" value="<?php echo $user['lastname'] ?>"></div>
								<div class="table-cell"><input type="text" name="username" value="<?php echo $user['username'] ?>"></div>
								<div class="table-cell"><input type="text" name="email" value="<?php echo $user['email'] ?>"></div>
								<div class="table-cell"><input type="text" name="password" value="<?php echo $user['password'] ?>"></div>
								<div class="table-cell"><input type="text" name="phone" value="<?php echo $user['phone'] ?>"></div>
								<div class="table-cell"><input type="text" name="roleId" value="<?php echo $user['roleId'] ?>"></div>
								<div class="table-cell"><input type="text" name="userRegionId" value="<?php echo $user['userRegionId'] ?>"></div>

								<div class="table-cell">
									<button class="btn-floating" type="submit" name="delete">
										<i class="material-icons">delete</i>
									</button>
								</div>
								
							</div>
						</form>
					<?php endforeach; ?>
			</div>
	</div>


</div>





<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
