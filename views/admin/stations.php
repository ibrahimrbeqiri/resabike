<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$regions = $_SESSION['regions'];

$regionstations = $_SESSION['regionstations'];

var_dump($regionstations);
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
			<div id="div-table">

					<?php foreach ($regionstations as $regionstation): ?>
					<div class="table-row">
						<div class="table-cell">
							<select name="regionId">
									<option disabled selected><?php echo $regionstation['regionName']; ?></option>
									<option value="<?php echo $region[regionId]; ?>"><?php echo $region[regionName]; ?></option>
							</select>
						</div>
						<div class="table-cell"><input type="text" name="stationId" value="<?php echo $regionstation['stationId'];?>"></div>	
						<div class="table-cell"><input type="text" name="stationName" value="<?php echo $regionstation['stationName'];?>"></div>
						<div class="table-cell"><button class="btn-floating" type="submit" name="delete"><i class="material-icons">delete</i></button></div>
					</div>
					<?php endforeach; ?>
			</div>
		</form>


		<button id="add-table-row" class="btn waves-effect waves-light left" type="button" name="action">Add station
	  		<i class="material-icons right">add</i>
		</button>

		<?php if ($user->getuserRoleId() == 1 || $user->getuserRoleId() == 2): ?>
			<script type="text/javascript">
    			$('#add-table-row').click(function() {
    				$('#div-table').append('<div class="table-row">\
    				<div class="table-cell">\
    				<select name="regionName">\
    					<option disabled selected><?php echo $regionstation['regionName'] ?></option>\
    					<?php foreach ($regions as $region): ?>\
    						<option value="<?php echo $region[regionId]; ?>"><?php echo $region[regionName]; ?></option>\
    					<?php endforeach; ?>\
    				</select>\
    				</div>\
    				<div class="table-cell"><input type="text" name="stationId" value=""></div>\
    				<div class="table-cell"><input type="text" name="stationName" value=""></div>\
    				<div class="table-cell"><button class="btn-floating" type="submit" name="delete"><i class="material-icons">delete</i></button></div>\
    				</div>');
    			});
			</script>


		<?php else: ?>
			<script type="text/javascript">
			$('#add-table-row').click(function() {
				$('#div-table').append('<div class="table-row">\
				<div class="table-cell"><div class="table-cell"><p><?php echo $regionstation['regionName'] ?><input type="text" hidden name="regionName" value="<?php echo $regionstation['stationId'] ?>"></p></div></div>\
				<div class="table-cell"><input type="text" name="stationId" value=""></div>\
				<div class="table-cell"><input type="text" name="stationName" value=""></div>\
				<div class="table-cell"><button class="btn-floating" type="submit" name="delete"><i class="material-icons">delete</i></button></div>\
				</div>');
			});
			</script>
		<?php endif; ?>

	</div>


</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
