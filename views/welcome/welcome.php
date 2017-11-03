<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
?>

	<div class="row front-page">
		<div class="col m12">
			<div class="fullscreen-bg">
		    <video loop muted autoplay poster="img/videoframe.jpg" class="fullscreen-bg__video">
		        <source src="/<?php echo SITE_NAME; ?>/assets/video/Resabike-LowQ.mp4" type="video/mp4">
		    </video>
				<div class="col s12 l3 card right">
					<div class="row">
						<div class="col l12">
							<a href="<?php echo URL_DIR.'reserve/reserve';?>">
							<button class="btn waves-effect waves-light btn-large">
								<i class="material-icons prefix">directions_bike</i>
								<span><?php echo $lang['WELCOME_RESERVE_BIKE']; ?></span>
							</button>
							</a>
						</div>
						<div class="col l12">
							<a href="<?php echo URL_DIR.'info/about';?>">
							<button class="btn waves-effect waves-light btn-large">
								<i class="material-icons prefix">info</i>
								<span><?php echo $lang['WELCOME_MORE_INFO']; ?></span>
							</button>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>

	<div class="row">

		<div class="col l 12" style="padding: 5%;">
			<div class="col l12 center">
				<h3>How it works:</h3>
			</div>
			<div class="col s12 m4">
			  <div class="center promo">
				<i class="material-icons">search</i>
				<p class="promo-caption"> 1. Search for bus routes</p>
				<p class="light center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			  </div>
			</div>

			<div class="col s12 m4">
			  <div class="center promo">
				<i class="material-icons">directions_bike</i>
				<p class="promo-caption">2. Reserve bikes for bus route</p>
				<p class="light center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			  </div>
			</div>

			<div class="col s12 m4">
			  <div class="center promo">
				<i class="material-icons">mood</i>
				<p class="promo-caption">3. Enjoy</p>
				<p class="light center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
			  </div>
			</div>
		</div>



	</div>



	<?php
	unset($_SESSION['msg']);
	include_once ROOT_DIR.'views/footer.inc';
		?>
