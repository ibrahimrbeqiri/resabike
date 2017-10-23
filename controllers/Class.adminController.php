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


		//Use something like this once you have the region for user
		//$stations = Station::getStations($userRegionhere);

		$stations = Station::getStations();

		//saveing that object into session
		$_SESSION["regional_stations"] = $stations;
		//Get message from connection process
		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}

	function register(){
		//The page cannot be displayed if no user connected
		if(!$this->getActiveUser()){
			$this->redirect('welcome', 'welcome');
			exit;
		}

		$user_roles = Role::getRoles();

		//saveing that object into session
		$_SESSION["user_roles"] = $user_roles;

		//Get data posted by the form
		$fname = $_POST['firstname'];
		$lname = $_POST['lastname'];
		$uname = $_POST['username'];
		$pwd = $_POST['password'];

		//Check if data valid
		if(empty($fname) or empty($lname) or empty($uname) or empty($pwd)){
			$_SESSION['msg'] = '<span class="error">A required field is empty!</span>';
			$_SESSION['persistence'] = array($fname, $lname, $uname, $pwd);
		}
		else{
			//Save new user into the db
			$user = new User(null, $fname, $lname, $uname, $pwd);
			$result = $user->save();
			if($result['status']=='error'){
				$_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
				$_SESSION['persistence'] = array($fname, $lname, $uname, $pwd);
			}
			else{
				$_SESSION['msg'] = '<span class="success">Registration successful!</span>';
				unset($_SESSION['persistence']);
			}
		}

	}
	
	function reservations()
	{
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    
	    $reservations = Reservation::getAllReservations();
	    
	    $_SESSION['reservations'] = $reservations;
	    
	   
	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
	
	function busdriverReservations()
	{
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    
	    $reservations = Reservation::getAllReservations();
	    
	    $_SESSION['reservations'] = $reservations;
	    
	    
	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
	

}
 ?>
