<?php
class welcomeController extends Controller{
/**
 * Method that controls the page 'login.php'
 */
	function welcome(){
		//$this->redirect('welcome', 'welcome');
		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
}
 ?>
