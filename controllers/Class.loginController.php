<?php
class loginController extends Controller{
	
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
    
    function admin(){
        
        $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
    }
    
    function logout(){
        session_destroy();
        $this->redirect('login', 'admin');
    }
	
}