<?php
class reserveController extends Controller{
/**
 * Method that controls the page 'login.php'
 */
	function reserve(){
		//$this->redirect('welcome', 'welcome');
		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
	function results(){
	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
}
 ?>
