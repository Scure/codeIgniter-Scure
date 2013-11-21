<?php


require(APPPATH.'libraries/REST_Controller.php');

	class scure_api extends REST_Controller{





			function index(){

				$this->config->set_item('csrf_protection',FALSE); //Temporarily set this to true for testing purposes. 

				echo "You do not have access to this page.";


			}

			/** user is the resource and get is the action **/
			function user_get(){

				//How to call: scure.me/index.php/scure_api/user/id/gling/email/csulb.edu/pw/sha1()/format/json
				$this->load->model('user_model');
				
				if(!$this->get('id') || !$this->get('email') || !$this->get('pw')){

					$this->response('Invalid Parameters',400);

				}
				$username = $this->get('id')."@".$this->get('email');
				$user = $this->user_model->get($username,$this->get('pw'));

				if($user){
					$this->response($user,200);		//Return the user and success code
				}
				else{
					$this->response('Not Found',400);		//Return nothing and error code
				}


			}




			function user_post(){

				//Warning: csrf_protection is set to FALSE for testing.  We need to figure what to do with this.  
				//This is just for the purposes of testing because the POST request is not coming from a form.  
				//How to call: scure.me/index.php/scure_api/user/
				//Send post request in body 
				//email_username,email_domain,pw,firstname,lastname

				$this->load->model('user_model');

				$email_username = $this->input->post('email_username');
				$email_domain   = $this->input->post('email_domain');
				$pw = $this->input->post('pw');
				$firstname = $this->input->post('firstname');
				$lastname = $this->input->post('lastname');
					
				$error_param = json_encode(array('status'=>'Invalid Parameters'));
				$error_not_found   = json_encode(array('status'=>'User not found'));
				$success_add       = json_encode(array('status'=>'User Added'));

				if(!$email_username || !$email_domain || !$pw  || !$firstname || !$lastname){
					

					$this->response($error_param,400);

				}
				else{

					$email = $email_username."@".$email_domain;

					$data = array(

							'email'=>$email,
							'password'=>$pw,
							'first_name'=>$firstname,
							'last_name'=>$lastname

					);

					$result = $this->user_model->post($email,$data);

					if(!$result){

						$this->response($error_not_found,400);


					}
					else{

						$this->response($success_add,200);

					}



				}

			}


			function user_put(){
				


				$this->load->model('user_model');

				if(!$this->get('id') || !$this->get('pw') || !$this->get('firstname') || !$this->get('lastname')){

					$this -> response(array('status'=>'user exists',400));

				}

				$user_data = array(

								'email' => $this->get('id'),
								'pw'    => $this->get('pw'),
								'firstname' => $this->get('firstname'),
								'lastname' => $this->get('lastname')
								  
								  );


				$user = $this->user_model->put($user_data);

				if($user){

					$this->response(array('Status'=>'OK'),200);
				
				}
				else{


					$this->response(array('Status'=>'Already Exists',400));


				}


			}

	}




?>