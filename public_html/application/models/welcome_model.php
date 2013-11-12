<?php 

	class Welcome_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}

		public function setSystemStatus($email,$data){

						$this -> db -> where('email',$email);
						$this -> db -> set('system_status', $data);
						$this -> db -> update('user_settings');



		}

		public function addSystemStatusLog($email,$string, $time){

				$this -> db -> where('email',$email);
				$this -> db -> set('log_body',$string);
				$this -> db -> set('time_stamp',$time);
				$this -> db -> update('daily_logs');

		}



		public function addNewDevice($email,$device_string,$device_name){

				$this -> db -> where('email',$email);
				$this -> db -> set('device_list',$device_string);
				$this -> db -> set('device_names',$device_name);
				$this -> db -> update('user_devices');



		}



		public function getDevices($email){

			$q = $this -> db -> where('email',$email) -> limit(1) -> get('user_devices');
			
			if($q -> num_rows() > 0){
				
				return $q -> row();
			
			}

			return false;

		}

		public function getDailyLog($email){


				$q = $this -> db -> where('email',$email) -> limit(1) -> get('daily_logs');

				if($q -> num_rows() > 0){

					return $q->row();

				}

				return false;



		}
		

		public function getSystemStatus($email){

			$q = $this -> db -> where('email',$email)->limit(1) -> get('user_settings');
			//$this->output->enable_profiler(TRUE);
			
			 if( $q -> num_rows() > 0){
			 	return $q -> row();
			 }

			 return false;
		
		}

	}


?>