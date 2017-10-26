<?php
class reserveController extends Controller{

	function reserve(){
		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';

	}

	function results(){

		//Get data posted by the form
		$from = $_GET['from'];
		$to = $_GET['to'];
		$date = $_GET['date'];
		$time = $_GET['time'];

		//validation
		if (!$from || !$to || !$date || !$time) {

			//pass the error message here somehow
			$this->redirect('reserve', 'reserve');

		}

		
		//saveing the search query into an object
		$search_query = array('from' => $from, 'to'=> $to, 'date' => $date, 'time' => $time);

		//saveing that object into session
		$_SESSION["search_query"] = $search_query;

	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}

	function confirm()
	{

	    $firstname = $_POST['firstname'];
	    $lastname = $_POST['lastname'];
	    $phone = $_POST['phone'];
	    $email = $_POST['email'];
	    $bikenumber = $_POST['bikenumber'];
	    $remarks = $_POST['remarks'];
	    $fromstation = $_POST['fromstation'];
	    $tostation = $_POST['tostation'];
	    $reservationdate = $_POST['reservationdate'];
	    $departure = $_POST['departure'];
	    $arrival = $_POST['arrival'];


	    $reservationArray = array('firstname' => $firstname, 'lastname'=> $lastname, 'phone' => $phone, 'email' => $email,
	        'bikenumber' => $bikenumber, 'remarks' => $remarks, 'fromstation' => $fromstation, 'tostation' => $tostation,
	        'reservationdate' => $reservationdate, 'departure' => $departure, 'arrival' => $arrival);

	    $_SESSION['reservationArray'] = $reservationArray;

	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';

	}

	function confirmed()
	{
	    $firstname = $_SESSION['reservationArray']['firstname'];
	    $lastname = $_SESSION['reservationArray']['lastname'];
	    $phone = $_SESSION['reservationArray']['phone'];
	    $email = $_SESSION['reservationArray']['email'];
	    $bikenumber = $_SESSION['reservationArray']['bikenumber'];
	    $remarks = $_SESSION['reservationArray']['remarks'];
	    $fromstation = $_SESSION['reservationArray']['fromstation'];
	    $tostation = $_SESSION['reservationArray']['tostation'];
	    $reservationdate = $_SESSION['reservationArray']['reservationdate'];
	    $departure = $_SESSION['reservationArray']['departure'];
	    $arrival = $_SESSION['reservationArray']['arrival'];

	    $reservation = new Reservation(null, $firstname, $lastname, $phone, $email, $bikenumber, $reservationdate,
	        $fromstation, $tostation, $departure, $arrival, $remarks);

	    $result = $reservation->addReservation();


	    if($result['status']=='error')
	    {
	        $_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
	        echo $_SESSION['msg'];
	    }
	    else
	    {
	        echo "Success!";
	        $this->redirect('reserve', 'success');

	    }
	}

	function cancel()
	{
	    unset($_SESSION['reservationArray']);
	    $this->redirect('reserve', 'reserve');
	}

	function success()
	{
	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';
	}
}
 ?>
