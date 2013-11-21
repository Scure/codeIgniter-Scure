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
			 *	Verifies the given email exists in the database of 'user_devices'
			 */

		    private function verify_user($email){
				

				$q = $this -> db -> where('email',$email)-> limit(1) -> get('user_devices');
				//$this->output->enable_profiler(TRUE);
				
				 if( $q -> num_rows() > 0){
				 	return $q -> row();
				 }
				 return false;
			
			}


			private function newSettings($data,$email){
						//updates settings with new ones
						$this -> db -> where('email',$email);
						$this -> db -> update('user_settings',$data);
						

			}



			private function getSettings($email){				

				$q = $this -> db -> where('email',$email) -> limit(1) -> get('user_settings');

				if($q -> num_rows() > 0){

						return $q->row();
				}

				return false;


			}





	}
?>