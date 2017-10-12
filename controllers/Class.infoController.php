<?php
class infoController extends Controller{

	function about(){

		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}

}
 ?>
