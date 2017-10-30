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
	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
	function users()
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
	    
	    $allusers = User::getAllUserData();
	    $_SESSION['allusers'] = $allusers;
	    
	    $user_roles = Role::getRoles();
	    $user_regions = Region::getAllRegions();
	    $_SESSION["user_roles"] = $user_roles;
	    $_SESSION["user_regions"] = $user_regions;
	    
	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
	
	function editUsers()
	{
	    
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
		if(!empty($_POST))
		{
    		if (!$name|| !$lastname || !$username || !$email || !$pwd|| !$confirmpwd || !$phone || !$role || !$region) {
    		    $_SESSION['msg'] = '<span class="error">The required field(s) are empty!</span>';
    		    $_SESSION['form_user'] = array($name, $lastname, $username, $email, $pwd, $confirmpwd, $phone, $role, $region);
    		    $this->redirect('admin', 'register');
    		    exit;
    		}
    		if(preg_match('/\s/', $username))
    		{
    		    $_SESSION['msg'] = '<span class="error">Username can not have spaces!</span>';
    		    $_SESSION['form_user'] = array($name, $lastname, $username, $email, $pwd, $confirmpwd, $phone, $role, $region);
    		    $this->redirect('admin', 'register');
    		    exit;
    		}
    		if($pwd !== $confirmpwd)
    		{
    		    $_SESSION['msg'] = '<span class="error">Passwords do not match!</span>';
    		    $_SESSION['form_user'] = array($name, $lastname, $username, $email, $pwd, $confirmpwd, $phone, $role, $region);
    		    $this->redirect('admin', 'register');
    		    exit;
    		}
    		if(User::checkUsername($username) == true)
    		{
    		    $_SESSION['msg'] = '<span class="error">Username already exists!</span>';
    		    $this->redirect('admin', 'register');
    		    exit;
    		}
    		else
    		{
    			//Save new user into the db
    		    $user = new User(null, $name, $lastname, $username, $email, $pwd, $phone, $role, $region);
    			$result = $user->save();
    
    			if($result['status']=='error'){
    				$_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
    				$_SESSION['persistence'] = array($name, $lastname, $username, $email, $pwd, $phone, $role, $region);
    			}
    			else{
    				unset($_SESSION['persistence']);
    
    				$_SESSION['msg'] = '<span class="success">Registration successful!</span>';
    				$this->redirect('admin', 'menu');
    
    			}
    		}
		}
		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
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
	function editRegions()
	{
	    $regionId = $_POST['regionId'];
	    $regionName = $_POST['regionName'];
	    
	    if(isset($_POST['modify']))
	    {
	        if(empty($regionId))
	        {
	            $region = new Region(null, $regionName);
	            
	            $result = $region->addRegion();
	            $_SESSION['msg'] = '<span class="success">Region added sucessfully!</span> </br>';
	            $this->redirect('admin', 'regions');
	            exit;
	        }
	        
	        if($regionId == '1')
	        {
	            $_SESSION['msg'] = '<span class="error">You cannot modify this region!</span> </br>';
	            $this->redirect('admin', 'regions');
	            exit;
	        }
	        $result = Region::modifyRegion($regionName, $regionId);
	        if($result['status']=='error')
	        {

	                $_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
	                echo $_SESSION['msg'];
	        }
	        else
	        {
	            $_SESSION['msg'] = '<span class="success">You have successfully modified this region!</span> </br>';
	            $this->redirect('admin', 'regions');
	            
	        }
	        
	      }
	    
	    else if(isset($_POST['delete']))
	    {
	       
	        
	        if($regionId == '1')
	        {
	            $_SESSION['msg'] = '<span class="error">You cannot delete this region!</span> </br>';
	            $this->redirect('admin', 'regions');
	            exit;
	        }
	        $result = Region::deleteRegion($regionId);
	        
	        if($result['status']=='error')
	        {
	            if($result['result'] == 'sql_query_doublon')
	            {
	                $_SESSION['msg'] = '<span class="error">You have stations belonging to this Region. Remove them first!</span> </br>';
	                $this->redirect('admin', 'regions');
	                exit;
	            }
	            else 
	            {
	                $_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
	                echo $_SESSION['msg'];
	            }
	        }
	        else
	        {
	            $_SESSION['msg'] = '<span class="success">You have successfully deleted this region!</span> </br>';
	            $this->redirect('admin', 'regions');
	            
	        }
	        
	    }
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
	    $id = $_POST['id'];
	    $firstname = $_POST['firstname'];
	    $lastname = $_POST['lastname'];
	    $phone = $_POST['phone'];
	    $email = $_POST['email'];
	    $bikenumber = $_POST['bikenumber'];
	    $reservationdate = $_POST['reservationdate'];
	    $fromstation = $_POST['fromstation'];
	    $tostation = $_POST['tostation'];
	    $departure = $_POST['departure'];
	    $arrival = $_POST['arrival'];
	    $remarks = $_POST['remarks'];
	    

	    if(isset($_POST['modify']))
	    {
	        
	        if(empty($firstname) || empty($lastname) || empty($phone) || empty($email) || empty($bikenumber) || empty($reservationdate) || 
	            empty($fromstation) || empty($tostation) || empty($departure) || empty($arrival) || empty($id))
	        {
	            $_SESSION['msg'] = '<span class="error">'.'Required field(s) were empty!'.'</span>';
	            $this->redirect('admin', 'reservations');
	            exit;
	        }
	        
            $result = Reservation::modifyReservation($firstname, $lastname, $phone, $email, $bikenumber, $reservationdate, $fromstation, $tostation, 
                $departure, $arrival, $remarks, $id);
           
            
            if($result['status']=='error')
            {
                $_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
                echo $_SESSION['msg'];
            }
            else
            {
                $_SESSION['msg'] = '<span class="success">'.'You have successfully modified the reservation!'.'</span>';
                $this->redirect('admin', 'reservations');
                
            }
            
	    }
	    else if(isset($_POST['delete']))
	    {
	        
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
