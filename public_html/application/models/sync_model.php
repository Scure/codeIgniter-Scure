<?php 

	class Sync_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}

		public function update_device_id($email,$data){

						$this -> db -> where('email',$email);
						$this -> db -> update('user_devices',$data);

		}


		public function getExisting($email){

			$q = $this -> db -> where('email',$email) -> limit(1) -> get('user_devices');
			
			if($q -> num_rows() > 0){
				return $q->row();
			}
			return false;

		}

		public function verify_user($email){
			

			$q = $this -> db -> where('email',$email)-> limit(1) -> get('user_devices');
			//$this->output->enable_profiler(TRUE);
			
			 if( $q -> num_rows() > 0){
			 	return $q -> row();
			 }
			 return false;
		
		}

	}


?>