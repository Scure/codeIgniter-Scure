<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Arduino extends CI_Controller {

	function __construct(){

		parent::__construct();
		session_start();

	}

public function checkStatus(){
	
	$current_user = $this->input->get('deviceid',TRUE);

	$_SESSION['deviceid'] = $current_user;

	$this -> load -> model('arduino_model');
	$result = $this -> arduino_model -> get_user_settings($current_user);

	if($result !== false){

		$status = $result -> system_status;
		echo $status."#";


	}
	else{

		echo "704#";

	}
	$this->load->view('arduino_view');

}

public function getEmail(){
	
	$current_user = $this->input->get('deviceid',TRUE);
	$_SESSION['deviceid'] = $current_user;

	$this->load->model('arduino_model');
	$result = $this->arduino_model->verify_user($_SESSION['deviceid']);

	if($result !==  false){

		$email = $result -> email;
		echo $email."#";


	}else{

		echo "700#";
	}

}

public function index(){

	$current_user = $this->input->get('deviceid',TRUE);
	$_SESSION['deviceid'] = $current_user;


	$this->load->model('arduino_model');
	$result = $this->arduino_model->verify_user($_SESSION['deviceid']);


	if($result !== false){
		//echo "\nRegistered to: ".$result -> email;
		echo "805#";				//Device is registered in the system.  

	}
	else{
		echo "700#";			//Device is not registered in the system.
	}

	$this->load->view('arduino_view');

}














}


?>