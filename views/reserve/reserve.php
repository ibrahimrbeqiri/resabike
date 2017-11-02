<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$stations = $_SESSION['StationsByRegion'];
var_dump($stations[1]);
?>
<?php $i = 0; ?>
<?php $len = count($stations); ?>
<?php $previousValue = null; ?>
<?php foreach ($stations as $region): ?>

	<?php
	if($region['regionId'] == $previousValue) {
	echo '"'.$region['stationName'].'": null,';

	if ($i == $len - 1) {
		echo "};";
		echo "</script>";
	}

	}else {
		//if not first row
		if ($i != 0) {
        	echo "}";
			echo "</script>";
    	}
		echo "<script type='javascript'>";
		echo " /* Stations of region $region[regionName] */ ";
		echo "data: {";
		echo '"'.$region['stationName'].'": null,';


	}
	$previousValue = $region['regionId'];
	$i++;
	 ?>
<?php endforeach; ?>


<div class="container full-screen">
	<div class="col m12">
		<h1><?php echo $lang['MENU_RESERVE']; ?></h1>
		<div class="row">
			<form action="<?php echo URL_DIR.'reserve/results';?>" method="get">
			<div class="col l12">
				<?php if ($msg): ?>
					<?php echo "<p class='red'>$msg</p>" ?>
				<?php endif; ?>
				<div class="row">
					<div class="input-field col m6">
					  <i class="material-icons prefix">arrow_forward</i>
					  <?php //disable the html autocomplete because of custom autocomplete ?>
					  <input autocomplete="off" id="icon_prefix" type="text" class="form-autocomplete validate" name="from" value="">
					  <label for="icon_prefix"><?php echo $lang['RESERVE_START']; ?></label>
					</div>
					<div class="input-field col m6">
					  <i class="material-icons prefix">location_on</i>
					  <?php //disable the html autocomplete because of custom autocomplete ?>
					  <input autocomplete="off" id="icon_telephone" type="tel" class="form-autocomplete validate" name="to">
					  <label for="icon_telephone"><?php echo $lang['RESERVE_DESTINATION']; ?></label>
					</div>
				</div>
			</div>
			<div class="col l12">
				<div class="row">
					<div class="input-field col m2">
					  <i class="material-icons prefix">date_range</i>
					  <input id="icon_prefix" type="text" class="datepicker" name="date" value="<?php echo date("d.m.Y") ?>">
					  <label for="icon_prefix"><?php echo $lang['RESERVE_DATE']; ?></label>
					</div>
					<div class="input-field col m2">
					  <i class="material-icons prefix">access_time</i>
					  <input id="icon_prefix" type="text" class="timepicker" name="time" value="<?php echo date("H:i") ?>">
					  <label for="icon_prefix"><?php echo $lang['RESERVE_TIME']; ?></label>
					</div>
				</div>
			</div>
				<div class="col m12">
					<button class="btn waves-effect waves-light" type="submit" name="action"><?php echo $lang['RESERVE_SEARCH']; ?>
					  <i class="material-icons right">search</i>
					</button>
				</div>

			</form>
        </div>
	</div>
</div>




<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
