<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$regionstations = $_SESSION['regionstations'];

?>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Stations:</h4>
		<p class="<?php echo URL_DIR.'admin/reservations/save';?>">Disclamer: Make sure the station IDs are correct!</p>
		<form action="<?php echo URL_DIR.'admin/editStations';?>" method="post">
			<button class="btn waves-effect waves-light left" type="submit">Save stations
				<i class="material-icons right">save</i>
			</button>

			<a href="<?php echo URL_DIR.'admin/menu';?>">
				<button class="btn waves-effect waves-light right" type="button">Cancel
					<i class="material-icons left">cancel</i>
				</button>
			</a>

			<table id="regional-stations-list">
				<thead>
					<th>Region Name</th>
					<th>Station ID</th>
					<th>Station Name</th>
				</thead>
				<tbody>
					<?php foreach ($regionstations as $regionstation): ?>
					
					<tr>
							<td><input type="text" name="regionName" value="<?php echo $regionstation['regionName'] ?>"></td>
							<td><input type="text" name="stationId" value="<?php echo $regionstation['stationId'] ?>"></td>
							<td><input type="text" name="stationName" value="<?php echo $regionstation['stationName'] ?>"></td>
							<td><button class="btn-floating" type="submit" name="delete"><i class="material-icons">delete</i></button></td>
							
					</tr>
					<?php endforeach; ?>
				</tbody>

			</table>
		</form>


		<button id="add-table-row" class="btn waves-effect waves-light left" type="button" name="action">Add station
	  		<i class="material-icons right">add</i>
		</button>
	</div>


</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
