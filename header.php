<!doctype html>

<html lang="en">
<head>
  <meta charset="utf-8">

  <title>Resabike</title>
  <meta name="description" content="Bike reservation system for busses">
  <meta name="author" content="Mikko and Ibrahim">

	<?php //stylesheet for materialize framework ?>
  <link rel="stylesheet" href="assets/materialize/css/materialize.css">
  <?php //stylesheet for custom styles ?>
  <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<body <?php //echo ($_SERVER['REQUEST_URI'] == '/index.php' or '/')?'class="front-page"':'';?>>


<nav>
  <div class="nav-wrapper yellow darken-1">
	<a href="<?php echo "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" class="brand-logo">Resabike</a>
	<ul id="nav-mobile" class="right hide-on-med-and-down">
	  <li><a href="sass.html">Reserve</a></li>
	  <li><a href="badges.html">Contact</a></li>
	</ul>
  </div>
</nav>
