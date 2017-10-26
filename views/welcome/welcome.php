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



	<?php
	unset($_SESSION['msg']);
	include_once ROOT_DIR.'views/footer.inc';
		?>
