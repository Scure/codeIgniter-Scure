<?php 

	class Arduino_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}

	public function get_user_settings($email){
			$q = $this -> db -> where('email',$email)-> limit(1) -> get('user_settings');
			//$this->output->enable_profiler(TRUE);
			
			 if( $q -> num_rows() > 0){
			 	return $q -> row();
			 }
			 return false;
		
		
	}


		public function verify_user($device_id){
			$q = $this -> db -> where('device_id',$device_id)-> limit(1) -> get('user_devices');
			//$this->output->enable_profiler(TRUE);
			
			 if( $q -> num_rows() > 0){
			 	return $q -> row();
			 }
			 return false;
		
		}

	}


?>