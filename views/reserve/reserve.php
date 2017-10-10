<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];

?>

<div class="container full-screen">
	<div class="col m12">
		<h1>Reserve</h1>
		<div class="row">
			<form action="<?php echo URL_DIR.'reserve/results';?>" method="get">
				<div class="input-field col m6">
				  <i class="material-icons prefix">arrow_forward</i>
				  <input id="icon_prefix" type="text" class="form-autocomplete validate" name="from" value="">
				  <label for="icon_prefix">Start</label>
				</div>
				<div class="input-field col m6">
				  <i class="material-icons prefix">location_on</i>
				  <input id="icon_telephone" type="tel" class="form-autocomplete validate" name="to">
				  <label for="icon_telephone">Destination</label>
				</div>
				<div class="input-field col s2">
				  <i class="material-icons prefix">date_range</i>
				  <input id="icon_prefix" type="text" class="datepicker" name="day" value="<?php echo date("d.m.Y") ?>">
				  <label for="icon_prefix">Date</label>
				</div>
				<div class="input-field col s2">
				  <i class="material-icons prefix">access_time</i>
				  <input id="icon_prefix" type="text" class="timepicker" name="time" value="<?php echo date("H:i") ?>">
				  <label for="icon_prefix">Time</label>
				</div>
				<div class="input-field col s2">
				  <i class="material-icons prefix">directions_bike</i>
				  <select class="form-bikes">
					<option value="" disabled selected>Bikes</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10+">10+</option>
				  </select>
				</div>
				<div class="col s12">
					<button class="btn waves-effect waves-light" type="submit" name="action">Search
					  <i class="material-icons right">search</i>
					</button>
				</div>

			</form>
        </div>
	</div>
</div>


<div id="bike-modal" class="modal modal-fixed-footer">
  <div class="modal-content">
	<h4>Attention!</h4>
	<p>If you are planning on reserving more than 10 bikes, please contact us at <a href="tel:1-562-867-5309">1-562-867-5309</a> to make sure we have room for all your bikes.</p>
  </div>
  <div class="modal-footer">
	<a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Close</a>
  </div>
</div>

<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
	?>
