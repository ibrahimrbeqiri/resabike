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
	<a href="/<?php echo SITE_NAME; ?>/" class="brand-logo"><img src="/<?php echo SITE_NAME; ?>/assets/img/logo.png" alt="logo"></a>
	<ul id="nav-mobile" class="right hide-on-med-and-down">
	  <li><a href="<?php echo URL_DIR.'reserve/reserve';?>">Reserve</a></li>
	  <li><a href="#">Contact</a></li>
	</ul>
  </div>
</nav>
