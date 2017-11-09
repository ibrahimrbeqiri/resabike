<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$regions = $_SESSION['regions'];

?>
<script type="text/javascript">
	<?php //this needs to be printed before you show the table ?>
	$(document).on('click', '.delete-row', function() {
		if(confirm("<?php echo $lang['ADMIN_COMMON_CONFIRMATION']; ?>")){
		$(this).child().click();
	}
	else{
		return false;
	}
});
</script>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4><?php echo $lang['ADMIN_REGIONS_TITLE']; ?></h4>
		<p><?php echo $lang['ADMIN_REGIONS_INFO']; ?></p>
		<?php if ($msg): ?>
			<?php echo $msg ?>
		<?php endif; ?>

		<div class="col l12 right-align">
			<a href="<?php echo URL_DIR.'admin/menu';?>">
					<button class="btn waves-effect waves-light" type="button">
						<?php echo $lang['ADMIN_REGISTER_CANCEL']; ?>
						<i class="material-icons left">cancel</i>
					</button>
			</a>
		</div>

			<div class="table" id="div-table">
				<div class="table-row">
					<form>
						<div class="table-cell">
							<button disabled class="btn-floating"></button>
						</div>
						<div class="table-cell">
							<input type="text" disabled value="<?php echo $lang['ADMIN_REGIONS_ID'] ?>">
						</div>
						<div class="table-cell">
							<input type="text" disabled value="<?php echo $lang['ADMIN_REGIONS_NAME'] ?>">
						</div>

						<div class="table-cell">
							<button  disabled class="btn-floating"></button>
						</div>
					</form>
				</div>

					<?php foreach ($regions as $region): ?>
						<div class="table-row">
							<form action="<?php echo URL_DIR.'admin/editRegions';?>" method="post">
							<div class="table-cell"><button class="btn-floating" type="submit" name="modify"><i class="material-icons">save</i></button></div>
							<div class="table-cell"><input type="text" disabled value="<?php echo $region['regionId'] ?>"> <input type="text" name="regionId" hidden value="<?php echo $region['regionId'] ?>"></div>
							<div class="table-cell"><input type="text" name="regionName" value="<?php echo $region['regionName'] ?>"></div>

							<div class="table-cell">
								<div class="delete-row">
									<button class="btn-floating" type="submit" name="delete">
										<i class="material-icons">delete</i>
									</button>
								</div>
							</div>

							</form>
						</div>
					<?php endforeach; ?>

			</div>


		<button id="add-table-row-region" class="btn waves-effect waves-light left" type="button" name="action">
			<?php echo $lang['ADMIN_REGIONS_ADD'] ?>
	  		<i class="material-icons right">add</i>
		</button>
		<script type="text/javascript">
		$('#add-table-row-region').click(function() {
			$('#div-table').append('<form action="<?php echo URL_DIR.'admin/editRegions';?>" method="post">\
				<div class="table-row">\
				<div class="table-cell"><button class="btn-floating" type="submit" name="modify"><i class="material-icons">save</i></button></div>\
				<div class="table-cell"><input type="text" disabled value="xx"></div>\
				<div class="table-cell"><input type="text" name="regionName" value=""></div>\
				<div class="table-cell">\
					<div class="delete-row">\
						<button class="btn-floating" type="submit" name="delete">\
							<i class="material-icons">delete</i>\
						</button>\
					</div>\
				</div>\
				</div>\
				</form>\
				');
		});
		</script>
	</div>


</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
