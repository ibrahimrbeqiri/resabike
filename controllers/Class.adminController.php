<?php
class adminController extends Controller{

	function connection(){
		//Get data posted by the form
		$uname = $_POST['username'];
		$pwd = $_POST['password'];

		//Check if data valid
		if(empty($uname) or empty($pwd)){
			$_SESSION['msg'] = '<span>A required field is empty!</span>';
			$this->redirect('admin', 'login');
		}
		else{
			//Load user from DB if exists
			$result = User::connect($uname, $pwd);

			//Put user in session if exists or return error msg
			if(!$result){
				$_SESSION['msg'] = '<span class="error">Username or password incorrect!</span>';
				$this->redirect('admin', 'login');
			}
			else{
				$_SESSION['msg'] = '<span class="success">Welcome '. $result->getFirstname(). ' '.$result->getLastname().'!</span>';
				$_SESSION['user'] = $result;
				$this->redirect('admin', 'menu');
			}
		}

	}



	function login(){

		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}

	function logout(){
		session_destroy();
		$this->redirect('admin', 'login');
	}


	function menu(){
		//The page cannot be displayed if no user connected
		if(!$this->getActiveUser()){
			$this->redirect('welcome', 'welcome');
			exit;
		}

		//Get message from connection process
		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';

	}

	function stations(){
		//The page cannot be displayed if no user connected
		if(!$this->getActiveUser()){
			$this->redirect('welcome', 'welcome');
			exit;
		}
		$stations = User::connect($uname, $pwd);

		//saveing that object into session
		$_SESSION["regional_stations"] = $stations;
		//Get message from connection process
		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}

}
 ?>
