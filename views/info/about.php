<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
?>
<div class="container">
	<div class="col l12">
		<h1>About</h1>
		<p>Resabike bike reserving service by Mikko & Ibrahim</p>
	</div>
</div>
<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
