<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct(){
			
		session_start();
		date_default_timezone_set('America/Los_Angeles');
		parent::__construct();



	}

	public function index()
	{		

		if(!isset($_SESSION['username'])){
			redirect('admin');
		}
		
		//Get current system armed/disarmed status 
		$email = $_SESSION['username'];
		$this->load->model('welcome_model');

		$system_result = $this->getSystemStatus();								//getRequest from hub
		$this -> getTemperature();
		$system_status = "";

		if($system_result == 0){

			$system_status = "Arm System";				//System is disarmed
			$_SESSION['sys_stat'] = 0;

		}
		else if($system_result == 1){

			$system_status = "Disarm System";			//Passes to the view
			$_SESSION['sys_stat'] = 1;

		}

		else{

			$system_status = "Connect";
			$_SESSION['sys_stat'] = 2;

		}


		//Get daily logs and explode strings into array
		$result = $this->welcome_model->getDailyLog($email);
		if($result !== false){


			$daily_log_string = $result -> log_body;
			$daily_log_array  = explode(",",$daily_log_string);
			$_SESSION['daily_log_array'] = $daily_log_array;

		//Get time stamp keys and send them to session 

			$daily_log_time_string = $result -> time_stamp;
			$daily_log_time_array  = explode(",",$daily_log_time_string);
			$_SESSION['daily_log_time_array'] = $daily_log_time_array;


		}//end check result. 


		$_SESSION['system_status'] = $system_status;
		


		// Retrieve Device

		$result = $this->getDevices($email);
		
		if($result !== false){
			
			$device_list = explode(",",$result->device_list);
			$device_count = sizeof($device_list);
		
		}


		
		$this->load->view('profile_view');
	}







	public function settings(){

		$this->load->view('settings_view');
	}


	public function changeAlarmStatus(){
		//Make diagram documentation


		$email = $_SESSION['username'];
		$this->load->model('welcome_model');
		$result = $this -> welcome_model -> getSystemStatus($email); 

		if($result -> system_status == 0){
			
			$data = 1;
			$this-> welcome_model -> setSystemStatus($email,$data);
			$this -> addActivity($email,0);

		}
		else{
			
			$data = 0;
			$this -> welcome_model -> setSystemStatus($email,$data);
			$this -> addActivity($email,1);

		}

		redirect('welcome');


	}

	public function liveUpdateActivity(){
		$email = $_SESSION['username'];


		$this->load->model('welcome_model');
		//$result = $this -> welcome_model -> getSystemStatus($email);

		$result = $this -> toggleSystemStatus();

		if($result == 1 ){
			//$data = 1; 
			//$this -> welcome_model -> setSystemStatus($email,$data);
			$this -> addActivity($email,0);
			$system_status = "Arm System";				//Passes to the view
			$_SESSION['system_status'] = $system_status;
			$_SESSION['sys_stat'] = 1;
			echo "<li>"."- System armed at "."<span style=\"color:red;\">".date("g: ia")."</span>"."</li><br>";
		}
		else if($result == 0){

			//$data = 0;
			//$this -> welcome_model -> setSystemStatus($email,$data);
			$this -> addActivity($email,1);
			$system_status = "Disarm System";				//Passes to the view
			$_SESSION['system_status'] = $system_status;
						$_SESSION['sys_stat'] = 0;

			echo "<li>"."- System disarmed at "."<span style=\"color:red;\">".date("g: ia")."</span>"."</li><br>";
		}
		else{

			$this -> addActivity($email,1);
			$system_status = "No Response";				//Passes to the view
			$_SESSION['system_status'] = $system_status;
			$_SESSION['sys_stat'] = 2;
			echo "<li>"."- System did not respond "."<span style=\"color:red;\">".date("g: ia")."</span>"."</li><br>";


		}


	}






	private function addActivity($email,$action){
		$this->load->model('welcome_model');

		if($action == 0){
					//Update log
			$result = $this->welcome_model->getDailyLog($email);

			if($result !== false){
				$system_status_string = ",- System armed at ";

				$oldData = $result->log_body;
				$oldData = $oldData.$system_status_string;

				$oldTime = $result->time_stamp;
				$oldTime = $oldTime.",".date("g:ia");// 12-hour format with no seconds, no leading zeros, with AM/PM
				$this -> welcome_model -> addSystemStatusLog($email,$oldData,$oldTime);

			}

	}//end if

		else if($action == 1){

	$result = $this->welcome_model->getDailyLog($email);

			if($result !== false){
				$system_status_string = ",- System disarmed at ";

				$oldData = $result->log_body;
				$oldData = $oldData.$system_status_string;

				$oldTime = $result->time_stamp;
				$oldTime = $oldTime.",".date("g:ia");// 12-hour format with no seconds, no leading zeros, with AM/PM
				$this -> welcome_model -> addSystemStatusLog($email,$oldData,$oldTime);

			}
		}//end elseif

	}//end addActivity




	private function sendcURL($url){

			$curl = curl_init();   			//Initiate an instance of cURL
			curl_setopt($curl,CURLOPT_URL, $url);
			curl_setopt($curl,CURLOPT_TIMEOUT_MS,1000);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);			//inform cURL that were returning the result to a variable.  
			$result = curl_exec($curl);
			
			//if($result == false){
			//	echo curl_error($curl);
			//}
			

			curl_close($curl);
			return $result;

		/*
			curl_setopt($curl, array(

					CURLOPT_RETURNTRANSFER=>1,
					CURLOPT_URL => 'http://96.39.242.74:80/mobileRequest?requestCode=304',
    				CURLOPT_USERAGENT => 'Scure Web app'

			));*/

	}


	private function toggleSystemStatus(){
			
			$url = 'http://96.39.242.74:80/mobileRequest?requestCode=305';
			$result = $this->sendcURL($url);
   			$new_result = preg_replace("/[^0-9,.]/", "", $result);		//parse out leading char


   			if(strcmp($new_result,"604")==0){
				
						//System went from unarmed to armed

					return 1;


			}
			else if(strcmp($new_result,"504")==0){

					return 0;	// System went from armed to unarmed
			}

			else{
				return -1;
			}


	}



	private function getSystemStatus(){

			$url = 'http://96.39.242.74:80/mobileRequest?requestCode=304';
			$result = $this->sendcURL($url);
   			$new_result = preg_replace("/[^0-9,.]/", "", $result);		//parse out leading char

			if(strcmp($new_result,"604")==0){
				
						//System is Armed
					return 1; 


			}
			else if(strcmp($new_result,"504")==0){

					return 0;	//System is disarmed

			}

			return -1;


			$this->load->view('welcome_message');

	}


public function getTemperature(){



			$url = 'http://96.39.242.74:80/mobileRequest?requestCode=306';
			$result = $this->sendcURL($url);
   			$new_result = preg_replace("/[^0-9,.]/", "", $result);		//parse out leading char
   			$_SESSION['sys_temp'] = $new_result;

}




public function addNewDevice(){

	//Add a new device to the list based on user input of device key 
	//Retrieve any existing data, append. 
	//NEED LIVE FORM VALIDATION FOR THE MODAL
	$this->load->library('form_validation');   //Load form validation library

	$this->form_validation->set_rules('device_identifier', 'Device ID', 'required|min_length[20]');
	$this->form_validation->set_rules('device_name', 'device_name', 'required');

	if($this -> form_validation->run() !== false){

			$device_string = $this -> input -> post('device_identifier');
			$device_name   = $this -> input -> post('device_name');
			$email = $_SESSION['username'];

			$result = $this -> getDevices($email);
			$this -> load -> model('welcome_model');
			//User has existing devices
		
		$oldData = "";
		
		if($result!==false){
			

			$oldData = $result -> device_list;
		
		}//end 



			if(strlen($oldData) !== 0){

				//explode to string by commas
				$old_strings = $result -> device_list;
				$old_names   = $result -> device_names;

				$old_strings = $old_strings.",".$device_string;
				$old_names   = $old_names.",".$device_name;

				$this->welcome_model->addNewDevice($email,$old_strings,$old_names);


			}
			else{

				$device_string = ",".$device_string;
				$device_name = ",".$device_name;
				$this->welcome_model->addNewDevice($email,$device_string,$device_name);


			}
			redirect('welcome');
	}






}





private function getDevices($email){
	
	//Check the dB for any devices registered.  Return # of devices.  
	//If there is existing devices, return the result
	//Otherwise, there are no devices, return false
	$this -> load -> model('welcome_model');
	$result = $this -> welcome_model -> getDevices($email);
	
	$length = strlen($result->device_list);
	if($length!==0){

		$device_list = $result->device_list;
		$device_name_list = $result->device_names;
		$device_list_array=explode(",",$device_list);
		$device_name_array = explode(",",$device_name_list);

		$_SESSION['device_name_array'] = $device_name_array;
		$_SESSION['device_array'] = $device_list_array;
		$_SESSION['devices_registered'] = sizeof($device_list_array)-1;
		return $result;


	}
			$_SESSION['devices_registered'] = 0;

	return false;
}











}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */