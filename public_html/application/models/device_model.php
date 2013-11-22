<?php 

	class Device_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}

			/*
			*	(API)
			*
			*	GET function for user model. 
			*   
			*   Requires: Email(ID)    Eventually will need device id/all
			* 
			*	Returns user's device settings 
			*/ 
			function get($email){

					//Note that we can "overload" our Get function depending on what inputs we get.  (manually) 
					//The system_status column should only be set by the hardware and therefore should only be altered by the hardware/web api.  

				$result = $this->verify_user($email);

				if($result == false){

					return false;

				}

				$user_settings = $this->getSettings($email);


				if($user_settings == false){

					return false;				//Shouldn't need this check.  Just for good measure/practice.
				}

				return $user_settings;	

			}

		   /*
			*	(API)
			*
			*	PUT function for user model. 
			*   
			*   Requires: Email(ID), Device ID, Device Name
			* 
			*	Adds the device id and name to the user's device list.   
			*/ 

			function put($email,$device_id_list,$device_name_list){

					$this -> db -> where('email',$email);
					$this -> db -> set('device_list',$device_id_list);
					$this -> db -> set('device_names',$device_name_list);
					$this -> db -> update('user_devices');



			}


			/*
			 *	Verifies the given email exists in the database of 'user_devices'
			 */

		    public function verify_user($email){
				

				$q = $this -> db -> where('email',$email)-> limit(1) -> get('user_devices');
				//$this->output->enable_profiler(TRUE);
				
				 if( $q -> num_rows() > 0){
				 	return $q -> row();
				 }
				 return false;
			
			}


			public function newSettings($data,$email){
						//updates settings with new ones
						$this -> db -> where('email',$email);
						$this -> db -> update('user_settings',$data);
						

			}

			public function getDevices($email){

				$q = $this -> db -> where('email',$email) -> limit(1) -> get('user_devices');
				
				if($q -> num_rows() > 0){
					
					return $q -> row();
				
				}

				return false;

			}


			public function getSettings($email){				

				$q = $this -> db -> where('email',$email) -> limit(1) -> get('user_settings');

				if($q -> num_rows() > 0){

						return $q->row();
				}

				return false;


			}





	}
?>