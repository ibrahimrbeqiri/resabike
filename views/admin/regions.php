<?php
include_once ROOT_DIR.'views/header.inc';

//Collect data from controller
$msg = $this->vars['msg'];
$user = $_SESSION['user'];

$regions = $_SESSION['regions'];

?>

<div class="container">
	<div class="col l12 center card admin-menu">
		<h4>Regions:</h4>
		<p class="<?php echo URL_DIR.'admin/regions/save';?>">Disclamer: Make sure the zone IDs are correct!</p>


			<a href="<?php echo URL_DIR.'admin/menu';?>">
				<button class="btn waves-effect waves-light right" type="button">Cancel
					<i class="material-icons left">cancel</i>
				</button>
			</a>
			<thead>
				<th></th>
				<th>Region ID</th>
				<th>Region Name</th>
			</thead>
			<div class="table" id="div-table">


					<?php foreach ($regions as $region): ?>
						<form action="<?php echo URL_DIR.'admin/editRegions';?>" method="post">

						<div class="table-row">
							<div class="table-cell"><button class="btn-floating" type="submit" name="modify"><i class="material-icons">save</i></button></div>
							<div class="table-cell"><p><?php echo $region['regionId'] ?></p> <input type="text" name="id" hidden value="<?php echo $region['regionId'] ?>"></div>
							<div class="table-cell"><input type="text" name="name" value="<?php echo $region['regionName'] ?>"></div>
							<div class="table-cell"><button class="btn-floating" type="submit" name="delete"><i class="material-icons">delete</i></button></div>
						</div>


					</form>
					<?php endforeach; ?>

			</div>


		<button id="add-table-row" class="btn waves-effect waves-light left" type="button" name="action">Add region
	  		<i class="material-icons right">add</i>
		</button>
	</div>


</div>


<?php
unset($_SESSION['msg']);
include_once ROOT_DIR.'views/footer.inc';
?>
