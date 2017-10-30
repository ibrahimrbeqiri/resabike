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
			<thead>
				<th>Region Name</th>
				<th>Station ID</th>
				<th>Station Name</th>
			</thead>
			<table id="div-table">

					<?php foreach ($regionstations as $regionstation): ?>

					<div class="table-row">
						<?php if ($user->getRoleId() == 1 || $user->getRoleId() == 2): ?>
							<select name="regionName">
								<option disabled selected><?php echo $regionstation['regionName'] ?></option>
								<?php foreach ($regions as $region): ?>
									<option value="<?php echo $region[regionId]; ?>"><?php echo $region[regionName]; ?></option>
								<?php endforeach; ?>
							</select>
							<div class="table-cell"><input type="text" name="regionName" value="<?php echo $regionstation['regionName'] ?>"></div>
						<?php else: ?>
							<div class="table-cell"><p><?php echo $regionstation['regionName'] ?></p></div>
						<?php endif; ?>
							<div class="table-cell"><input type="text" name="regionName" value="<?php echo $regionstation['regionName'] ?>"></div>
							<div class="table-cell"><input type="text" name="stationId" value="<?php echo $regionstation['stationId'] ?>"></div>
							<div class="table-cell"><input type="text" name="stationName" value="<?php echo $regionstation['stationName'] ?>"></div>
							<div class="table-cell"><button class="btn-floating" type="submit" name="delete"><i class="material-icons">delete</i></button></div>

					</div>
					<?php endforeach; ?>

			</table>
		</form>


		<button id="add-table-row" class="btn waves-effect waves-light left" type="button" name="action">Add station
	  		<i class="material-icons right">add</i>
		</button>

		<script type="text/javascript">
		$('#add-table-row').click(function() {
			$('#regional-stations-list tbody').append('<tr>\
				<td><input type="text" name="regionName" value=""></td>\
				<td><input type="text" name="stationId" value=""></td>\
				<td><input type="text" name="stationName" value=""></td>\
				<td><button class="btn-floating" type="submit" name="delete"><i class="material-icons">delete</i></button></td>\
				</tr>\
				');
		});

		</script>
	</div>


</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
