<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	function __construct(){

		parent::__construct();
		session_start();

	}

	public function index()
	{
		$this->load->library('form_validation');   //Load form validation library
		$this->form_validation->set_rules('new_email_Address', 'Email Address', 'required|valid_email');
		$this->form_validation->set_rules('new_password', 'Password', 'required|min_length[4]');
		$this->form_validation->set_rules('first_name', 'First Name', 'required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'required');

				if($this -> form_validation->run() !== false){

						$this-> load-> model('user_model');

							$data = array(
					
							'first_name' 	=> $this->input->post('first_name') ,
							'last_name'  	=> $this->input->post('last_name') ,
							'password'   	=> sha1($this->input->post('new_password')),
							'email' 	 	=> $this->input->post('new_email_Address'),
							'date_created'  => date("m/d/y")
							
							);	


						$result = $this  -> user_model  -> put($data);
							

						if($result == false){
								
							echo "<br><br><br><br><br>";
							echo "<p>NAME ALREADY EXISTS</p>";		//Name already exists.  Do something. 
						
						}
						else{
					
						
							$_SESSION['username'] = $this->input->post('new_email_Address');
							//echo "<br><br><br><br><br>";
							//echo $this->input->post('first_name'); echo ", you have succesfully registered!";
							redirect('welcome');
						}//end else

				}//end if(form_validation)

		$this->load->view('register_view');
	}





}

