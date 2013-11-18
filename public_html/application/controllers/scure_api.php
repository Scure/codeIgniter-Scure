<?php
require(APPPATH.'libraries/REST_Controller.php');

	class scure_api extends REST_Controller{


			function index(){


				echo "You do not have access to this page.";


			}


			/** user is the resource and get is the action **/
			function user_get(){

				//How to call: scure.me/index.php/scure_api/id/gling/email/csulb.edu/pw/sha1()/format/json
				

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

				$this->load->model('user_model');

				if(!$this->post('id') || !$this->post('pw') || !$this->post('firstname') || !$this->post('lastname')){

					$this->response(NULL,400);

				}

				$data = array(

						'email'=>$this->post('id'),
						'pw'   =>$this->post('pw'),
						'firstname'=>$this->post('firstname'),
						'lastname'=>$this->post('lastname')

					);

				$result = $this->user_model->post($data);

				if($result){

					$this->response(array('Status'=>'Not Found'),400);
				}
				else{

					$this->response('OK',200);

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