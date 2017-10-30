<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$regions = $_SESSION['regions'];

?>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Regions:</h4>
		<p class="<?php echo URL_DIR.'admin/regions/save';?>">Disclamer: Make sure the zone IDs are correct!</p>
		<form action="<?php echo URL_DIR.'admin/editRegions';?>" method="post">

			<a href="<?php echo URL_DIR.'admin/menu';?>">
				<button class="btn waves-effect waves-light right" type="button">Cancel
					<i class="material-icons left">cancel</i>
				</button>
			</a>

			<table id="regions-list">
				<thead>
					<th></th>
					<th>Region ID</th>
					<th>Region Name</th>
				</thead>
				<tbody>
					<?php foreach ($regions as $region): ?>
					<tr>
							<td><button class="btn-floating" type="submit" name="modify"><i class="material-icons">save</i></button></td>
							<td><input type="text" name="id" value="<?php echo $region['regionId'] ?>"></td>
							<td><input type="text" name="name" value="<?php echo $region['regionName'] ?>"></td>
							<td><button class="btn-floating" type="submit" name="delete"><i class="material-icons">delete</i></button></td>
							
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
