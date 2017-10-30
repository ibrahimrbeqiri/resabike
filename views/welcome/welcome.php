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
				<i class="material-icons">flash_on</i>
				<p class="promo-caption">Speeds up development</p>
				<p class="light center">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
			  </div>
			</div>

			<div class="col s12 m4">
			  <div class="center promo">
				<i class="material-icons">group</i>
				<p class="promo-caption">User Experience Focused</p>
				<p class="light center">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
			  </div>
			</div>

			<div class="col s12 m4">
			  <div class="center promo">
				<i class="material-icons">settings</i>
				<p class="promo-caption">Easy to work with</p>
				<p class="light center">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
			  </div>
			</div>
		</div>



	</div>



	<?php
	unset($_SESSION['msg']);
	include_once ROOT_DIR.'views/footer.inc';
		?>
