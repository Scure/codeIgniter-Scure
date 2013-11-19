<?php 

	class User_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}


		/*
		*	(API)
		*
		*	GET function for user model. 
		*   
		*   Requires: Email(ID) and Password(pw)  
		* 
		*	Returns user if there is an ID
		*/ 
		public function get($id,$pw){

				$q = $this -> db -> where('email',$id)->where('password',sha1($pw))->limit(1)->get('users');

				if($q->num_rows()>0){

					return $q->row();
				
				}

				return false;

		}

		/*
		*	(API)
		*
		*	PUT function for user model. 
		*   
		*   Requires: Email(ID) and Password(pw) , First-name, Last-name
		* 
		*	Returns user if there is an ID
		*/ 

		public function put($data){

				$exists = $this->check_for_existing($data['email']);

				if($exists){

						return false;
				}

							//Initialize the Settings table for the user	
							$data_settings = array(

								'email' => $data['email'],
								'first_name' => $data['first_name'],
								'last_name'  => $data['last_name'],
								'audio_sensor' => 0,
								'temp_sensor'  => 0,
								'motion_sensor' =>0

							);

							//Initialize the Device List Table for the user
							$data_devices = array(

								'email' => $data['email'],
								'device_list'=>"",
								'device_names' =>""
							);


							$data_logs = array(


								'email' => $data['email'],
								'log_body' => "",
								'time_stamp' => ""

							);

							$this-> db -> insert('users',$data);
							$this-> db -> insert('user_settings',$data_settings);
							$this-> db -> insert('user_devices',$data_devices);
							$this-> db -> insert('daily_logs', $data_logs);

							return true;

		}


		/*
		*	(API)
		*
		*	POST function for user model. 
		*   
		*   Requires: Email(ID),Password(PW),First_name, Last_name
		* 
		*	Returns user if there is an ID.  Sends all the information and updates the entire row.
		*/ 

		public function post($username,$data){

				$exists = $this->check_for_existing($username);

				if($exists == false){

						return false;
				}



				$this -> db -> where('email',$username);
				$this -> db -> update('users',$data);
				return true;

		}


		public function update($email,$data){



			return TRUE;





		}

		/*
		*   CHECK FOR EXISTING	
		*  
		*	Takes in the Email(ID) and returns true if the user exists
		*   
		*   Requires: Email(ID)
		* 
		*	Returns user if ID exists
		*/ 

		public function check_for_existing($email){

			$q = $this -> db -> where('email',$email) -> limit(1) -> get('users');
			
	
			if($q->num_rows() > 0){

				return true;	//User exists

			}

			return false;       //User does not exist
		}

	}
?>