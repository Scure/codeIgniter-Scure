<?php


require(APPPATH.'libraries/REST_Controller.php');
require_once(APPPATH.'libraries/response_codes.php');

	class scure_api extends REST_Controller{





			function index(){

				$this->config->set_item('csrf_protection',FALSE); //Temporarily set this to true for testing purposes. 

				echo "You do not have access to this page.";


			}


			/** user is the resource and get is the action **/
			function user_get(){

				//How to call: scure.me/index.php/scure_api/user/id/gling/email/csulb.edu/pw/sha1()/format/json
				$this->load->model('user_model');
				
				if(!$this->get('email') || !$this->get('pw')){

					$this->response('Invalid Parameters',401);

				}
				$username = html_entity_decode($this->get('email'));

				$user = $this->user_model->get($username,$this->get('pw'));

				if($user){
					$this->response($user,200);		//Return the user and success code
				}
				else{
					$this->response('Not Found',401);		//Return nothing and error code not authorized
				}


			}




			function user_post(){

				//Warning: csrf_protection is set to FALSE for testing.  We need to figure what to do with this.  
				//This is just for the purposes of testing because the POST request is not coming from a form.  
				//How to call: scure.me/index.php/scure_api/user/
				//Send post request in body 
				//email_username,email_domain,pw,firstname,lastname

				$this->load->model('user_model');

				$email          = html_entity_decode($this->input->post('email'));
				$pw = $this->input->post('pw');
				$firstname = $this->input->post('firstname');
				$lastname = $this->input->post('lastname');
					
				$error_param = json_encode(array('status'=>'Invalid Parameters'));
				$error_not_found   = json_encode(array('status'=>'User not found'));
				$success_add       = json_encode(array('status'=>'User Added'));

				if(!$email || !$pw  || !$firstname || !$lastname){
					

					$this->response($error_param,400);

				}
				else{


					$data = array(

							'email'=>$email,
							'password'=>sha1($pw),
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
				
				$email = $this->put('email');
				$pw = $this->put('pw');
				$firstname = $this->put('firstname');
				$lastname = $this->put('lastname');

				$this->load->model('user_model');
				if(!$email || !$pw || !$firstname || !$lastname){

					$this -> response(array('status'=>'Invalid parameters'),400);

				}

				$user_data = array(

								'email' => $email,
								'pw'    => $pw,
								'firstname' => $firstname,
								'lastname' => $lastname
								  
								  );


				$user = $this->user_model->put($user_data);

				if($user){

					$this->response(array('Status'=>'OK'),200);
				
				}
				else{


					$this->response(array('Status'=>'Already Exists',400));


				}


			}



			function device_get(){


					//!!!!!! Changing Table setup
					//Retrieve device information and current parameters with html_encoded email string 
					//@TODO: Put data parameters such as temperature/sound level under the /data resource 
					//@TODO: Need to figure out the structure of having multiple devices per user since that's whats going on now. 
					// For now, set this up assuming settings apply to all devices.  
					// Client should pass in (all) or the ID of the device they wish to edit.  
					// Should just change the structure of the device_list to have one row for each device and an owner column
					// Separate table with the device_id as the id that gets checked once the user credentials are verified
				
				$this -> load -> model('device_model');
				$email = html_entity_decode($this->input->get('email'));
				$error_param = json_encode(array('status'=>'Invalid Parameters'));
				$id_not_found   = json_encode(array('status'=>'User not found'));


				if(!$email){

					$this->response($error_param,400);

				}

				$result = $this->device_model->get($email);


				if($result == false){


					$this -> response($id_not_found,400);


				}else{

					$settings = json_encode(array(

						'audio_sensor' => $result->audio_sensor,
						'temp_sensor'  => $result->temp_sensor,
						'motion_sensor'=> $result->motion_sensor,
						'system_status'=> $result->system_status

						));


					$this->response($settings,200);




				}


			}



			function device_put(){

				//Requires: Device_ID & Device Name & Email 
				//Returns: status 
				$this -> load -> model('device_model');
				$email = html_entity_decode($this->put('email'));
				$new_device_id = $this->put('device_id');
				$new_device_name = $this->put('device_name');
				$error_param = json_encode(array('status'=>'Invalid Parameters'));
				if(!$email || !$new_device_id || !$new_device_name){

					$this->response($error_param,400);

				}

				//@TODO: Might need to add authentication for device IDs.  Check a database of existing IDs. And return if this device is valid.

				$result = $this -> device_model -> getDevices($email);

				if($result !== false){

					$existing_device_ids = $result -> device_list; 

				}

				if(strlen($existing_device_ids) !== 0){								// There are existing and registered devices


					$existing_device_names = $result -> device_names;

					$existing_device_ids = $existing_device_ids.",".$new_device_id;
					$existing_device_names = $existing_device_names.",".$new_device_name;
					$this -> device_model -> put($email,$existing_device_ids,$existing_device_names);	
					$this -> response(array('status'=>'new device added'),200);


				}
				else{

																					// There are no pre-existing registered devices
					$new_device_id_list = ",".$new_device_id;
					$new_device_name_list = ",".$new_device_name;
					$this -> device_model -> put($email,$new_device_id_list,$new_device_name_list);
					$this -> response(array('status'=>'device list created'),200);
				}

			}


	}




?>