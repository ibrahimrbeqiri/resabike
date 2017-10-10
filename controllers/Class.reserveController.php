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
		$date = $_GET['date'];
		$time = $_GET['time'];
		//saveing the search query into an object
		$search_query = array('from' => $from, 'to'=> $to, 'date' => $date, 'time' => $time);
		//saveing that object into session
		$_SESSION["search_query"] = $search_query;

	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
}
 ?>
