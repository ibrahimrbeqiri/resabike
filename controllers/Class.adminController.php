<?php
class adminController extends Controller{

	function connection(){
		//Get data posted by the form
		$username = $_POST['username'];
		$pwd = $_POST['password'];

		//Check if data valid
		if(empty($username) or empty($pwd)){
			$_SESSION['msg'] = '<span>A required field is empty!</span>';
			$this->redirect('admin', 'login');
		}
		else{
			//Load user from DB if exists
			$result = User::connect($username, $pwd);

			//Put user in session if exists or return error msg
			if(!$result){
				$_SESSION['msg'] = '<span class="error">Username or password incorrect!</span>';
				$this->redirect('admin', 'login');
			}
			else{
				$_SESSION['msg'] = '<span class="success">Welcome '. $result->getName(). ' '.$result->getLastname().'!</span>';
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
	    $user = $this->getActiveUser();
	    if ($user->getRoleId() != 1 && $user->getRoleId() != 2) {
	        $_SESSION['msg'] = '<span class="error">You are not authorized for this page!</span>';
	        $this->redirect('admin', 'menu');
	        exit;
	    }

		//Use something like this once you have the region for user

		$user = $_SESSION['user'];
		
		$regionstations = RegionStations::getAllRegionStations($user->getuserRegionId());
		$_SESSION['regionstations'] = $regionstations;

		//Get message from connection process
		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
    
	function editStations()
	{
	    if(isset($_POST['modify']))
	    {
	        
	    }
	    else if(isset($_POST['delete']))
	    {
	        
	    }
	}
	function register(){
		//The page cannot be displayed if no user connected
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    $user = $this->getActiveUser();
	    if ($user->getRoleId() != 1) {
	        $_SESSION['msg'] = '<span class="error">You are not authorized for this page!</span>';
	        $this->redirect('admin', 'menu');
	        exit;
	    }

		$user_roles = Role::getRoles();
		$user_regions = Region::getAllRegions();

		//saveing that object into session
		$_SESSION["user_roles"] = $user_roles;
		$_SESSION["user_regions"] = $user_regions;
		//Get data posted by the form
		$name = $_POST['name'];
		$lastname = $_POST['lastname'];
		$username = $_POST['username'];
		$email = $_POST['email'];
		$pwd = $_POST['password'];
		$confirmpwd = $_POST['confirmpassword'];
		$phone = $_POST['phone'];
		$role = $_POST['role'];
		$region = $_POST['region'];

		trim($name);
		trim($lastname);
		trim($username);
		trim($email);
		trim($pwd);
		trim($confirmpassword);
		trim($phone);


		//Check if data valid
		if (!$name|| !$lastname || !$username || !$email || !$pwd|| !$confirmpwd || !$phone || !$role || !$region) {
		    $_SESSION['msg'] = '<span class="error">A required field is empty!</span>';
		    $_SESSION['form_user'] = array($name, $lastname, $username, $email, $pwd, $confirmpwd, $phone, $role, $region);
		}
		if(preg_match('/\s/', $username))
		{
		    $_SESSION['msg'] = '<span class="error">Username can not have spaces!</span>';
		    $_SESSION['form_user'] = array($name, $lastname, $username, $email, $pwd, $confirmpwd, $phone, $role, $region);
		}
		if($pwd !== $confirmpwd)
		{
		    $_SESSION['msg'] = '<span class="error">Passwords do not match!</span>';
		    $_SESSION['form_user'] = array($name, $lastname, $username, $email, $pwd, $confirmpwd, $phone, $role, $region);
		}
		else{
			//Save new user into the db
		    $user = new User(null, $name, $lastname, $username, $email, $pwd, $phone, $role, $region);
			$result = $user->save();

			if($result['status']=='error'){
				$_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
				$_SESSION['persistence'] = array($name, $lastname, $username, $email, $pwd, $phone, $role, $region);
			}
			else{
				$_SESSION['msg'] = '<span class="success">Registration successful!</span>';
				unset($_SESSION['persistence']);
				$this->redirect('admin', 'menu');
			}
		}

	}

	function regions()
	{
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    $user = $this->getActiveUser();
	    if ($user->getRoleId() != 1) {
	        $_SESSION['msg'] = '<span class="error">You are not authorized for this page!</span>';
	        $this->redirect('admin', 'menu');
	        exit;
	    }

	    $regions = Region::getAllRegions();
	    $_SESSION['regions'] = $regions;


	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
	function reservations()
	{
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
		$user = $this->getActiveUser();
		if ($user->getRoleId() != 1 && $user->getRoleId() != 2) {
			$_SESSION['msg'] = '<span class="error">You are not authorized for this page!</span>';
			$this->redirect('admin', 'menu');
			exit;
		}


	    $reservations = Reservation::getAllReservations();
	    $_SESSION['reservations'] = $reservations;


	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}

	function editReservation()
	{
	    if(isset($_POST['modify']))
	    {

	    }
	    else if(isset($_POST['delete']))
	    {
	        $id = $_POST['id'];

	        $result = Reservation::deleteReservation($id);
	        if($result['status']=='error')
	        {
	            $_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
	            echo $_SESSION['msg'];
	        }
	        else
	        {
	            echo "Success!";
	            $this->redirect('admin', 'menu');

	        }
	    }
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
