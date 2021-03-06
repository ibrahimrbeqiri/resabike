<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

class reserveController extends Controller{

	function reserve(){

		$stations = RegionStations::getStationsByRegion();
		$_SESSION['StationsByRegion'] = $stations;
		$this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';

		if (!empty($_GET)) {
			$from = $_GET['from'];
			$to = $_GET['to'];

			$sum = Reservation::checkRegions($from, $to);
		}
	}

	function results(){

		//Get data posted by the form
		$from = $_GET['from'];
		$to = $_GET['to'];
		$date = $_GET['date'];
		$time = $_GET['time'];

		//validation
		if (empty($from) || empty($to) || empty($date) || empty($time)) {

			$_SESSION['msg'] = '<span class="error">Required values are empty!</span>';
			$this->redirect('reserve', 'reserve');
			exit;

		}

		$stationsExist = Reservation::checkStations($from, $to);

		if ($stationsExist === false) {
			$_SESSION['msg'] = '<span class="error">Stations not found!</span>';
			$this->redirect('reserve', 'reserve');
			exit;
		}
		if ($stationsExist === "one not found") {
			$_SESSION['msg'] = '<span class="error">One of the stations was incorrect!</span>';
			$this->redirect('reserve', 'reserve');
			exit;
		}

		$sameRegion = Reservation::checkRegions($from, $to);

		if ($sameRegion === false) {
			$_SESSION['msg'] = '<span class="error">Cross-region travel is not allowed</span>';
			$this->redirect('reserve', 'reserve');
			exit;
		}

		if ($sameRegion[0]['Region1'] == $sameRegion[0]['Region2']) {

		$reservationdate = $date;
		//$sum = Reservation::getAllBikes($reservationdate);
		$_SESSION['sum'] = $sum;
		//saveing the search query into an object
		$search_query = array('from' => $from, 'to'=> $to, 'date' => $date, 'time' => $time);

		//saveing that object into session
		$_SESSION["search_query"] = $search_query;

	    $this->vars['msg'] = isset($_SESSION['msg']) ? $_SESSION['msg'] : '';

		}
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

	    if(empty($firstname) || empty($lastname) || empty($phone) || empty($email) || empty($bikenumber) || empty($reservationdate) || empty($fromstation)
	        || empty($tostation) || empty($departure) || empty($arrival))
	    {
	        $_SESSION['msg'] = '<span class="error">The required field(s) were empty! Please search again!</span>';
	        $this->redirect('reserve', 'reserve');
	        exit;
	    }

	    $reservationArray = array('firstname' => $firstname, 'lastname'=> $lastname, 'phone' => $phone, 'email' => $email,
	        'bikenumber' => $bikenumber, 'remarks' => $remarks, 'fromstation' => $fromstation, 'tostation' => $tostation,
	        'reservationdate' => $reservationdate, 'departure' => $departure, 'arrival' => $arrival);

	    $_SESSION['reservationArray'] = $reservationArray;

	    $stations = Station::getAllStations();
	     $_SESSION['stations'] = $stations;


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
	        $fromstation, $tostation, $departure, $arrival, $remarks, $creationDate);

	    $result = $reservation->addReservation();
	    $id = $result['id'];

	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $secret_key = 'catchmeifyoucan';
	    $secret_iv = 'resabikeiscrazy';
	    $key = hash('sha256', $secret_key);

	    $iv = substr(hash('sha256', $secret_iv), 0, 16);
	    $output = openssl_encrypt($id, $encrypt_method, $key, 0, $iv);
	    $output = base64_encode($output);

	    $stations = Station::getAllStations();
	    $_SESSION['stations'] = $stations;
	    foreach($stations as $station)
	    {
	        if($station['stationId'] == $fromstation)
	        {
	            $from = $station['stationName'];
	        }
	        if($station['stationId'] == $tostation)
	        {
	            $to = $station['stationName'];
	        }
	    }


	    if($result['status']=='error')
	    {
	        $_SESSION['msg'] = '<span class="error">'.$result['result'].'</span>';
	        echo $_SESSION['msg'];
	    }
	    else
	    {
			$lang = $_SESSION['lang'];
			switch ($lang) {
			  case 'en':
			  $lang_file = 'lang.en.php';
			  break;

			  case 'de':
			  $lang_file = 'lang.de.php';
			  break;

			  case 'fr':
			  $lang_file = 'lang.fr.php';
			  break;

			  default:
			  $lang_file = 'lang.en.php';

			}

			include_once ROOT_DIR.'languages/'.$lang_file;

	        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	        try {

	            //Server settings
	            $mail->isSMTP();                                      // Set mailer to use SMTP
	            $mail->Host ='smtp.gmail.com';                     // Specify main and backup SMTP servers
	            $mail->Username = 'resabikech@gmail.com';                 // SMTP username
	            $mail->Password = 'Resabike123';                           // SMTP password
	            $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	            $mail->Port = 587;                                    // TCP port to connect to
	            $mail->SMTPAuth = true;
				$mail->CharSet = 'UTF-8';
	            $mail->smtpConnect(
	                array(
	                    "ssl" => array(
	                        "verify_peer" => false,
	                        "verify_peer_name" => false,
	                        "allow_self_signed" => true
	                    )
	                )
	                );

	            //Recipients
	            $mail->setFrom('resabikech@gmail.com');
	            $mail->addAddress($email);                             // Name is optional
				$baseurl = URL_DIR;
	            //Content
	            $mail->isHTML(true);                                  // Set email format to HTML
	            $mail->Subject = $lang['CONFIRMATION_EMAIL_SUBJECT'];
	            $mail->Body    =  '<p>'.$lang['CONFIRMATION_EMAIL_INTRO'].'</p>'.
								  '<ul>'.
								  '<li>'.$lang['CONFIRMATION_EMAIL_FROM'].$from.$lang['CONFIRMATION_EMAIL_TIME'].$departure.'</li>'.
								  '<li>'.$lang['CONFIRMATION_EMAIL_TO'].$to.$lang['CONFIRMATION_EMAIL_TIME'].$arrival.'</li>'.
								  '<li>'.$lang['CONFIRMATION_EMAIL_DATE'].$reservationdate.'</li>'.
								  '<li>'.$lang['CONFIRMATION_EMAIL_FIRSTNAME'].$firstname.'</li>'.
								  '<li>'.$lang['CONFIRMATION_EMAIL_LASTNAME'].$lastname.'</li>'.
								  '<li>'.$lang['CONFIRMATION_EMAIL_EMAIL'].$email.'</li>'.
								  '<li>'.$lang['CONFIRMATION_EMAIL_PHONE'].$phone.'</li>'.
								  '<li>'.$lang['CONFIRMATION_EMAIL_BIKES'].$bikenumber.'</li>'.
								  '<li>'.$lang['CONFIRMATION_EMAIL_REMARKS'].$remarks.'</li>'.
								  '</ul>'.
								  '<p>'.$lang['CONFIRMATION_EMAIL_OUTRO'].'</p>'.
								  '<p>'.$lang['CONFIRMATION_EMAIL_DELETEMESSAGE'].'</p>'.
								  $baseurl.'reserve/cancelreservation?delete='.$output;

	            $mail->send();

	        } catch (Exception $e) {

	        }

	        $this->redirect('reserve', 'success');


	    }
	}
	function cancelreservation()
	{
	        $delete = $_GET['delete'];
	        $output = false;
	        $encrypt_method = "AES-256-CBC";
	        $secret_key = 'catchmeifyoucan';
	        $secret_iv = 'resabikeiscrazy';
	        $key = hash('sha256', $secret_key);
	        $iv = substr(hash('sha256', $secret_iv), 0, 16);
	        $output = openssl_decrypt(base64_decode($delete), $encrypt_method, $key, 0, $iv);
	        $deletion = Reservation::deleteReservation($output);

	        if($deletion['status'] == 'error')
	        {
	            echo "Something went wrong! Try again!";
	        }
	        else
	        {
	            echo "<h3>Your reservation has sucessfully been deleted</h3>";
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
