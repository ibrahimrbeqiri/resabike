<?php
class adminController extends Controller{


	function menu(){
		//The page cannot be displayed if no user connected
		if(!$this->getActiveUser()){
			$this->redirect('welcome', 'welcome');
			exit;
		}

		//Get message from connection process
		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';

	}

	function account(){
		//The page cannot be displayed if no user connected
		if(!$this->getActiveUser()){
			$this->redirect('welcome', 'welcome');
			exit;
		}
		$userId = $this->getActiveUser()->getId();
		$accountinfo = User::getAccountInfo($userId);
		$_SESSION['accountInfo'] = $accountinfo;

		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}

	function users()
	{
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    $user = $this->getActiveUser();
	    if ($user->getuserRoleId() != 1) {
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
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    $user = $this->getActiveUser();
	    if ($user->getuserRoleId() != 1) {
	        $_SESSION['msg'] = '<span class="error">You are not authorized for this page!</span>';
	        $this->redirect('admin', 'menu');
	        exit;
	    }


	    $id = $_POST['id'];
	    $name = $_POST['name'];
	    $lastname = $_POST['lastname'];
	    $username = $_POST['username'];
	    $email = $_POST['email'];
	    $password = $_POST['password'];
	    $phone = $_POST['phone'];
	    $userRoleId = $_POST['userRoleId'];
	    $userRegionId = $_POST['userRegionId'];
	    $originalusername = $_POST['originalusername'];

	    $array = array($name, $lastname, $username, $email, $password, $phone, $userRoleId, $userRegionId, $id);

	    if(isset($_POST['modify']))
	    {
	        if(empty($name) || empty($lastname) || empty($username) || empty($email) || empty($password) || empty($phone) ||
	            empty($userRoleId) || empty($userRegionId) || empty($originalusername) || empty($id))
	        {
	            $_SESSION['msg'] = $array;
	            $this->redirect('admin', 'users');
	            exit;
	        }

	        if($originalusername != $username)
	        {
	            if(User::checkUsername($username) == true)
	            {
	                $_SESSION['msg'] = '<span class="error">Username already exists!</span>';
	                $this->redirect('admin', 'users');
	                exit;
	            }
	        }

	        $result = User::modifyUser($name, $lastname, $username, $email, $password, $phone, $userRoleId, $userRegionId, $id);

	        if(!$result)
	        {
	            $_SESSION['msg'] = '<span class="error">User could not be modified!</span>';
	            echo $_SESSION['msg'];
	        }
	        else
	        {
	            $_SESSION['msg'] = '<span class="success">'.'You have successfully modified the user!'.'</span>';
	            $this->redirect('admin', 'users');

	        }

	    }
	    else if(isset($_POST['delete']))
	    {
	        $result = User::deleteUser($id);

	        if(!$result){
	            $_SESSION['msg'] = '<span class="error">Failed to delete user!</span>';
	            $this->redirect('admin', 'users');
	            exit;
	        }
	        else{
	            $_SESSION['msg'] = '<span class="success">User deleted successfully!</span>';
	            $this->redirect('admin', 'users');
	            exit;
	        }

	    }
	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}

	function register(){
		//The page cannot be displayed if no user connected
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    $user = $this->getActiveUser();
	    if ($user->getuserRoleId() != 1) {
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
	    if ($user->getuserRoleId() != 1) {
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
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    $user = $this->getActiveUser();
	    if ($user->getuserRoleId() != 1) {
	        $_SESSION['msg'] = '<span class="error">You are not authorized for this page!</span>';
	        $this->redirect('admin', 'menu');
	        exit;
	    }


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
	function stations(){
	    //The page cannot be displayed if no user connected
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    $user = $this->getActiveUser();
	    if ($user->getuserRoleId() != 1 && $user->getuserRoleId() != 2) {
	        $_SESSION['msg'] = '<span class="error">You are not authorized for this page!</span>';
	        $this->redirect('admin', 'menu');
	        exit;
	    }

	    $regions = Region::getAllRegions();
	    $_SESSION["regions"] = $regions;
	    //Use something like this once you have the region for user

	    $regionstations = RegionStations::getAllRegionStations($user->getuserRegionId());
	    $_SESSION['regionstations'] = $regionstations;

	    //Get message from connection process
	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}

	function editStations()
	{
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    $user = $this->getActiveUser();
	    if ($user->getuserRoleId() != 1 && $user->getuserRoleId() != 2) {
	        $_SESSION['msg'] = '<span class="error">You are not authorized for this page!</span>';
	        $this->redirect('admin', 'menu');
	        exit;
	    }
	    
	    $regionIdRS = $_POST['regionId'];
	    $stationId = $_POST['stationId'];
	    $stationIdRS = $_POST['stationIdRS'];
	    $stationName = $_POST['stationName'];
	    
	    if(isset($_POST['modify']))
	    {
	        if(empty($stationId) || empty($stationName))
	        {
	            $_SESSION['msg'] = '<span class="error">'.'Required field(s) were empty!'.'</span>';
	            $this->redirect('admin', 'stations');
	            exit;
	        }
	        
	        $result = RegionStations::modifyStationsForRegion($regionIdRS, $stationIdRS, $stationId, $stationName);
	        
	        if($result['status']=='error')
	        {
	            var_dump($regionIdRS, $stationId, $stationIdRS, $stationName);
	            $_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
	            echo $_SESSION['msg'];
	        }
	        else
	        {
	            $_SESSION['msg'] = '<span class="success">'.'You have successfully modified the station!'.'</span>';
	            $this->redirect('admin', 'stations');
	            
	        }
	    }
	    else if(isset($_POST['delete']))
	    {
	        $result = RegionStations::deleteStationFromRegion($regionIdRS, $stationIdRS);
	        
	        if($result['status']=='error')
	        {
	            $_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
	            echo $_SESSION['msg'];
	        }
	        else
	        {
	            $_SESSION['msg'] = '<span class="error">You have successfully deleted the station!</span>';
	            $this->redirect('admin', 'stations');
	            
	        }
	    }
	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
	function addStations()
	{
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    $user = $this->getActiveUser();
	    if ($user->getuserRoleId() != 1) {
	        $_SESSION['msg'] = '<span class="error">You are not authorized for this page!</span>';
	        $this->redirect('admin', 'menu');
	        exit;
	    }
	    
	    $text = trim($_POST['addStations']);
	    $newstations = preg_split('/(\n)/', $text);
        $message = array();
        
	    foreach($newstations as $newstation)
	    {
	       $newstation = explode(';', $newstation);
	       $result = RegionStations::addStationsForRegion($newstation[0], $newstation[1], $newstation[2]);
	       
	       if($result['status']=='error')
	       {
	           array_push($message, '<span class="error">'.$result['result'].'</span>');
	       }
	       else
	       {
	           array_push($message, '<span class="success">'.'You have successfully added a new station!'.'</span>');
	           
	       }
	    }
	    $_SESSION['msg'] = $message;
	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	    $this->redirect('admin', 'stations');
	}
	
	function reservations()
	{
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
		$user = $this->getActiveUser();
		if ($user->getuserRoleId() != 1 && $user->getuserRoleId() != 2) {
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
	    if(!$this->getActiveUser()){
	        $this->redirect('welcome', 'welcome');
	        exit;
	    }
	    $user = $this->getActiveUser();
	    if ($user->getuserRoleId() != 1 && $user->getuserRoleId() != 2) {
	        $_SESSION['msg'] = '<span class="error">You are not authorized for this page!</span>';
	        $this->redirect('admin', 'menu');
	        exit;
	    }

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
	            $_SESSION['msg'] = '<span class="error">You have succesfully deleted the reservation!</span>';
	            $this->redirect('admin', 'reservations');

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
        $reservationdate = null;
        
	    if(isset($_POST['busDriverForm']))
	    {
	        if(isset($_POST['reservationdate']))
	        {
	            $reservationdate = $_POST['reservationdate'];
	        }
	        else
	        {
	            $reservationdate = $_POST['customDate'];
	        }
	        var_dump($reservationdate);
	        
	        $result = Reservation::getAllBusDriverReservations($reservationdate);
	        $_SESSION['busdriverReservations'] = $result;
	        
    	    
    	    if($result['status']=='error')
    	    {
    	        $_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
    	        echo $_SESSION['msg'];
    	    }
        	if(empty($result))
        	{
                $_SESSION['msg'] = '<span class="error">There are no reservations made for this day!</span>';
        	    $this->redirect('admin', 'busDriverReservations');
        	    exit;
        	}
    
	    }

	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	    
	}


}
?>
