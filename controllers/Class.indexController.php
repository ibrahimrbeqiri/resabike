<?php
class indexController extends Controller{
/**
 * Method that controls the page 'login.php'
 */
	function welcome(){
		//if a user is active he cannot re-login
			$this->redirect('welcome', 'index');


		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
}
 ?>
