<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];

?>

<div class="container">
	<div class="row">
		<div class="col l12 center">
			<h1>:(</h1>
			<h3>Oops, something went wrong!</h3>
			<h5>Sorry about that.</h5>
			<?php if ($msg): ?>
				<div class="col l12 card grey lighten-2">
					<h5><?php echo $msg; ?></h5>
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
	?>
