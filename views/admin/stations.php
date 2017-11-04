<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$regions = $_SESSION['regions'];

$regionstations = $_SESSION['regionstations'];
?>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Stations:</h4>
		<p>Disclamer: Make sure the station IDs are correct!</p>
		<?php if ($msg): ?>
			<?php if(is_array($msg)):?>
    			<?php foreach($msg as $m):?>
    				<?php echo $m ?> </br>
    			<?php endforeach;?>
			<?php else:?>
			<?php echo $msg;?>
			<?php endif;?>
		<?php endif; ?>
		<a href="<?php echo URL_DIR.'admin/menu';?>">
				<button class="btn waves-effect waves-light right" type="button">Cancel
					<i class="material-icons left">cancel</i>
				</button>
		</a>

  		<table>
    		<thead>
    			<th>Region Name</th>
    			<th>Station ID</th>
    			<th>Station Name</th>
    		</thead>
    	</table>
		<?php foreach ($regionstations as $regionstation): ?>
		<form action="<?php echo URL_DIR.'admin/editStations';?>" method="post">
			<div id="div-table">
					<div class="table-row">
    					<div class="table-cell">
    						<button class="btn-floating" type="submit" name="modify">
    								<i class="material-icons">save</i>
    						</button>
    					</div>
						<div class="table-cell">
							<select name="regionId">
									<option selected value="<?php echo $regionstation['regionId'];?>"><?php echo $regionstation['regionName']; ?></option>
									<?php if($user->getuserRoleId() == 1 ):?>
										<?php foreach ($regions as $region): ?>
											<option value="<?php echo $region['regionId']; ?>"><?php echo $region['regionName']; ?></option>
										<?php endforeach;?>
									<?php endif;?>
							</select>
						</div>
						<div class="table-cell"><input type="text" hidden name="stationIdRS" value="<?php echo $regionstation['stationIdRS']?>"></div>	
						<div class="table-cell"><input type="text" name="stationId" value="<?php echo $regionstation['stationId']?>"></div>	
						<div class="table-cell"><input type="text" name="stationName" value="<?php echo $regionstation['stationName']?>"></div>
						<div class="table-cell"><button class="btn-floating" type="submit" name="delete"><i class="material-icons">delete</i></button></div>
					</div>
			</div>
		</form>        
		<?php endforeach; ?>
		<?php if($user->getuserRoleId() == 1):?>
		  <div class="row">
            <form action="<?php echo URL_DIR.'admin/addStations';?>" method="post">
              <div class="row">
                <div class="input-field col s12">
                  <textarea id="addStations" name="addStations" class="materialize-textarea"></textarea>
                  <label for="addStations">Add new stations as follows: Region ID;Station ID;Station Name</label>
                </div>
              </div>
              <button class="btn waves-effect waves-light left" type="submit">Add Stations
					<i class="material-icons left">add</i>
			 </button>
            </form>
  		 </div>
        <?php endif;?>

		<?php if ($user->getuserRoleId() == 1): ?>
			<script type="text/javascript">
    			$('#add-table-row').click(function() {
    				$('#div-table').append('<div class="table-row">\
    				<div class="table-cell">\
    					<button class="btn-floating" type="submit" name="modify">\
    						<i class="material-icons">save</i>\
    					</button>\
    				</div>\
    				<div class="table-cell">\
    					<select name="regionId">\
    						<option disabled selected><?php echo $regionstation['regionName'] ?></option>\
    					   <?php foreach ($regions as $region): ?>\
    							<option value="<?php echo $region['regionId']; ?>"><?php echo $region['regionName']; ?></option>\
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
				<div class="table-cell">\
    				<button class="btn-floating" type="submit" name="modify">\
    					<i class="material-icons">save</i>\
    				</button>\
    			</div>\
				<div class="table-cell">\
					<select name="regionId">\
    					<option disabled selected><?php echo $regionstation['regionName'] ?></option>\
    				</select>\
    			</div>\
				<div class="table-cell"><input type="text" name="stationId" value=""></div>\
				<div class="table-cell"><input type="text" name="stationName" value=""></div>\
				<div class="table-cell"><button class="btn-floating" type="submit" name="delete"><i class="material-icons">delete</i></button></div>\
				</div>')
			});
			</script>
		<?php endif; ?>

	</div>


</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
