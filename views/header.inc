<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Resabike</title>
  <meta name="description" content="Bike reservation system for busses">
  <meta name="author" content="Mikko and Ibrahim">

	<?php //stylesheet for materialize framework ?>
  <link rel="stylesheet" href="/<?php echo SITE_NAME; ?>/assets/materialize/css/materialize.css">
  <?php //stylesheet for custom styles ?>
  <link rel="stylesheet" href="/<?php echo SITE_NAME; ?>/assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<?php //scripts for jquery ?>
	<script src="/<?php echo SITE_NAME; ?>/assets/js/jquery-3.2.1.min.js"></script>

		<?php //javascripts for materialize framework ?>
	<script src="/<?php echo SITE_NAME; ?>/assets/materialize/js/materialize.js"></script>
</head>



<body <?php //echo ($_SERVER['REQUEST_URI'] == '/index.php' or '/')?'class="front-page"':'';?>>


<nav>
  <div class="nav-wrapper main-color">
	  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	<a href="/<?php echo SITE_NAME; ?>/" class="brand-logo"><img src="/<?php echo SITE_NAME; ?>/assets/img/logo.png" alt="logo"></a>
	<ul id="nav-mobile" class="right hide-on-med-and-down">
	  <li><a href="<?php echo URL_DIR.'reserve/reserve';?>">Reserve</a></li>
	  <li><a href="<?php echo URL_DIR.'info/about';?>">Contact</a></li>
	  <?php if ($_SESSION['user']): ?>
		<?php $user = $_SESSION['user']; ?>
		<li><a class="dropdown-button" href="<?php echo URL_DIR.'admin/menu';?>" data-activates="admin-dropdown"><i class="material-icons left">person</i><?php echo $user->getUsername();?><i class="material-icons right">arrow_drop_down</i></a></li>
		<ul id="admin-dropdown" class="dropdown-content">
			<li><a href="<?php echo URL_DIR.'admin/menu';?>"><i class="material-icons left">settings</i>Menu</a></li>
		  	<li><a href="<?php echo URL_DIR.'admin/logout';?>"><i class="material-icons left">power</i>Log out</a></li>
		</ul>
	  <?php endif; ?>
	</ul>
	<ul class="side-nav" id="mobile-demo">
		<li><a href="<?php echo URL_DIR.'reserve/reserve';?>">Reserve</a></li>
  	  	<li><a href="<?php echo URL_DIR.'info/about';?>">Contact</a></li>
		<?php if ($_SESSION['user']): ?>
  		<li><a class="dropdown-button" href="<?php echo URL_DIR.'admin/menu';?>" data-activates="admin-dropdown-mobile"><i class="material-icons left">person</i><?php echo $user->getUsername();?><i class="material-icons right">arrow_drop_down</i></a></li>
  		<ul id="admin-dropdown-mobile" class="dropdown-content">
  			<li><a href="<?php echo URL_DIR.'admin/menu';?>"><i class="material-icons left">settings</i>Menu</a></li>
  		  	<li><a href="<?php echo URL_DIR.'admin/logout';?>"><i class="material-icons left">power</i>Log out</a></li>
  		</ul>
  	  <?php endif; ?>
	</ul>
  </div>
</nav>
