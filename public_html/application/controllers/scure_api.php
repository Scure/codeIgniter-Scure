<?php

	require(APPPATH'./libaries/REST_Controller.php');

	class Scure_api extends REST_Controller{


			function user_get(){

				if(!$this->get('id') || !$this->get('pw')){

					$this->response(NULL,400);

				}

				$user = $this->user_model->get($this->get('id'),$this->get('pw'));

				if($user){

					$this->response($user,200);		//Return the user and success code

				}
				else{

					$this->response(NULL,400);		//Return nothing and error code

				}

			}



			function user_post(){

				if(!$this->get('id') || !$this->get('pw') || !$this->get('firstname') || !$this->get('lastname')){

					$this->response(NULL,400);

				}

				$data = array(

						'email'=>$this->get('id'),
						'pw'   =>$this->get('pw'),
						'firstname'=>$this->get('firstname'),
						'lastname'=>$this->get('lastname')

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

				if(!$this->get('id') || !$this->get('pw') || !$this->get('firstname') || !$this->get('lastname')){

					$this -> response(array('status'=>'user exists',400);

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