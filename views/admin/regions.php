<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$zones = $_SESSION['zones'];

?>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Regions:</h4>
		<p class="<?php echo URL_DIR.'admin/regions/save';?>">Disclamer: Make sure the zone IDs are correct!</p>
		<form action="index.html" method="post">

			<a href="<?php echo URL_DIR.'admin/menu';?>">
				<button class="btn waves-effect waves-light right" type="button">Cancel
					<i class="material-icons left">cancel</i>
				</button>
			</a>

			<table id="regional-stations-list">
				<thead>
					<th></th>
					<th>Region ID</th>
					<th>Region Name</th>
				</thead>
				<tbody>
					<?php foreach ($zones as $zone): ?>
					<tr>
							<td><a class="btn-floating" type="submit"><i class="material-icons">save</i></a></td>
							<td><input type="text" name="id" value="<?php echo $zone['id'] ?>"></td>
							<td><input type="text" name="name" value="<?php echo $zone['name'] ?>"></td>
							<td><a class="btn-floating delete-row"><i class="material-icons">delete</i></a></td>
							
					</tr>
					<?php endforeach; ?>
				</tbody>

			</table>
		</form>

		<button id="add-table-row" class="btn waves-effect waves-light left" type="button" name="action">Add region
	  		<i class="material-icons right">add</i>
		</button>
	</div>


</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
