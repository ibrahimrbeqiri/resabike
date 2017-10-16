<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
?>

	<div class="row front-page">
		<div class="col m12 fp-img">
			<div class="col s12 m3 card right">
				<div class="row">
					<div class="col l12">
						<a href="<?php echo URL_DIR.'reserve/reserve';?>">
						<button class="waves-effect waves-light btn-large">
							<i class="material-icons prefix">directions_bike</i>
							<span>Reserve bike</span>
						</button>
						</a>
					</div>
					<div class="col l12">
						<a href="<?php echo URL_DIR.'info/about';?>">
						<button class="waves-effect waves-light btn-large">
							<i class="material-icons prefix">info</i>
							<span>More info</span>
						</button>
						</a>
					</div>
				</div>
		</div>

		</div>
	</div>



	<?php
	unset($_SESSION['msg']);
	include_once ROOT_DIR.'views/footer.inc';
		?>
