<?php
//multilanguage support
if(isSet($_GET['lang']))
{
$lang = $_GET['lang'];

// register the session and set the cookie
$_SESSION['lang'] = $lang;

setcookie('lang', $lang, time() + (3600 * 24 * 30));
}
else if(isSet($_SESSION['lang']))
{
$lang = $_SESSION['lang'];
}
else if(isSet($_COOKIE['lang']))
{
$lang = $_COOKIE['lang'];
}
else
{
$lang = 'en';
}

switch ($lang) {
  case 'en':
  $lang_file = 'lang.en.php';
  break;

  case 'de':
  $lang_file = 'lang.de.php';
  break;

  case 'fr':
  $lang_file = 'lang.fr.php';
  break;

  default:
  $lang_file = 'lang.en.php';

}

include_once ROOT_DIR.'languages/'.$lang_file;

 ?>

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
    <link href="/<?php echo SITE_NAME; ?>/assets/fonts/icons.css" rel="stylesheet">

	<?php //scripts for jquery ?>
	<script src="/<?php echo SITE_NAME; ?>/assets/js/jquery-3.2.1.min.js"></script>

		<?php //javascripts for materialize framework ?>
	<script src="/<?php echo SITE_NAME; ?>/assets/materialize/js/materialize.js"></script>






	<link rel="apple-touch-icon" sizes="180x180" href="/<?php echo SITE_NAME; ?>/assets/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/<?php echo SITE_NAME; ?>/assets/favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/<?php echo SITE_NAME; ?>/assets/favicons/favicon-16x16.png">
	<link rel="manifest" href="/<?php echo SITE_NAME; ?>/assets/favicons/manifest.json">
	<link rel="mask-icon" href="/<?php echo SITE_NAME; ?>/assets/favicons/safari-pinned-tab.svg" color="#ffcc00">
	<meta name="theme-color" content="#ffcc00">


</head>



<body <?php //echo ($_SERVER['REQUEST_URI'] == '/index.php' or '/')?'class="front-page"':'';?>>


<nav>
  <div class="nav-wrapper main-color">
	  <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
	<a href="/<?php echo SITE_NAME; ?>/" class="brand-logo"><img src="/<?php echo SITE_NAME; ?>/assets/img/logo.png" alt="logo"></a>
	<ul id="nav-mobile" class="right hide-on-med-and-down">
	  <li><a href="<?php echo URL_DIR.'reserve/reserve';?>"><?php echo $lang['MENU_RESERVE']; ?></a></li>
	  <li><a href="<?php echo URL_DIR.'info/about';?>"><?php echo $lang['MENU_CONTACT']; ?></a></li>
	  <?php if (isset($_SESSION['user'])): ?>
		<?php $user = $_SESSION['user']; ?>
		<li><a class="dropdown-button" href="<?php echo URL_DIR.'admin/menu';?>" data-activates="admin-dropdown"><i class="material-icons left">person</i><?php echo $user->getUsername();?><i class="material-icons right">arrow_drop_down</i></a></li>
		<ul id="admin-dropdown" class="dropdown-content">
			<li><a href="<?php echo URL_DIR.'admin/menu';?>"><i class="material-icons left">settings</i><?php echo $lang['MENU_MENU']; ?></a></li>
		  	<li><a href="<?php echo URL_DIR.'login/logout';?>"><i class="material-icons left">power</i><?php echo $lang['MENU_LOG_OUT']; ?></a></li>
		</ul>
	  <?php endif; ?>

	  <li><a class="dropdown-button" href="" data-activates="langugage-dropdown"><?php echo $lang['LANGUAGE']; ?><i class="material-icons right">arrow_drop_down</i></a></li>
	  <ul id="langugage-dropdown" class="dropdown-content">
		  <?php $the_url = strtok($_SERVER["REQUEST_URI"],'?') ?>
		  <li><a href="<?php echo $the_url ?>?lang=en">En</a></li>
		  <li><a href="<?php echo $the_url ?>?lang=de">De</a></li>
		  <li><a href="<?php echo $the_url ?>?lang=fr">Fr</a></li>
	  </ul>
	</ul>


	<ul class="side-nav" id="mobile-demo">
		<li><a href="<?php echo URL_DIR.'reserve/reserve';?>"><?php echo $lang['MENU_RESERVE']; ?></a></li>
  	  	<li><a href="<?php echo URL_DIR.'info/about';?>"><?php echo $lang['MENU_CONTACT']; ?></a></li>
		<?php if (isset($_SESSION['user'])): ?>
  		<li><a class="dropdown-button" href="<?php echo URL_DIR.'admin/menu';?>" data-activates="admin-dropdown-mobile"><i class="material-icons left">person</i><?php echo $user->getUsername();?><i class="material-icons right">arrow_drop_down</i></a></li>
  		<ul id="admin-dropdown-mobile" class="dropdown-content">
  			<li><a href="<?php echo URL_DIR.'admin/menu';?>"><i class="material-icons left">settings</i><?php echo $lang['MENU_MENU']; ?></a></li>
  		  	<li><a href="<?php echo URL_DIR.'login/logout';?>"><i class="material-icons left">power</i><?php echo $lang['MENU_LOG_OUT']; ?></a></li>
  		</ul>
  	  <?php endif; ?>
	</ul>
  </div>
</nav>
<main>
