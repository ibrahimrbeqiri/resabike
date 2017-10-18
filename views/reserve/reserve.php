<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];

?>

   <form action="<?php echo URL_DIR.'reserve/test';?>" method="POST">
		<input type="text" name="fromStation" >
		<input type="text" name="toStation" >
		<input type="text" name="nickname" >
		<input type="number" name="nrBikes" >
		<button class="btn waves-effect waves-light" type="submit" name="action">Submit</button>
	</form>

<div class="container full-screen">
	<div class="col m12">
		<h1>Reserve</h1>
		<div class="row">
			<form action="<?php echo URL_DIR.'reserve/results';?>" method="get">
				<div class="input-field col m6">
				  <i class="material-icons prefix">arrow_forward</i>
				  <?php //disable the html autocomplete because of custom autocomplete ?>
				  <input autocomplete="off" id="icon_prefix" type="text" class="form-autocomplete validate" name="from" value="">
				  <label for="icon_prefix">Start</label>
				</div>
				<div class="input-field col m6">
				  <i class="material-icons prefix">location_on</i>
				  <?php //disable the html autocomplete because of custom autocomplete ?>
				  <input autocomplete="off" id="icon_telephone" type="tel" class="form-autocomplete validate" name="to">
				  <label for="icon_telephone">Destination</label>
				</div>
				<div class="input-field col m2">
				  <i class="material-icons prefix">date_range</i>
				  <input id="icon_prefix" type="text" class="datepicker" name="date" value="<?php echo date("d.m.Y") ?>">
				  <label for="icon_prefix">Date</label>
				</div>
				<div class="input-field col m2">
				  <i class="material-icons prefix">access_time</i>
				  <input id="icon_prefix" type="text" class="timepicker" name="time" value="<?php echo date("H:i") ?>">
				  <label for="icon_prefix">Time</label>
				</div>
				<div class="col m12">
					<button class="btn waves-effect waves-light" type="submit" name="action">Search
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
