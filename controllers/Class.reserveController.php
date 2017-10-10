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
		//Get data posted by the form
		$from = $_GET['from'];
		$to = $_GET['to'];
		$day = $_GET['day'];
		$time = $_GET['time'];
		//saveing the search query into an object
		$search_query = array('from' => $from, 'to'=> $to, 'day' => $day, 'time' => $time);
		//saveing that object into session
		$_SESSION["search_query"] = $search_query;

	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
}
 ?>
