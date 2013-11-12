<?php 

	class Admin_model extends CI_Model{


		function __construct(){

				parent::__construct();


		}



		public function verify_user($email,$password){

			$q = $this -> db -> where('email',$email)->where('password',sha1($password)) -> limit(1) -> get('users');
			//$this->output->enable_profiler(TRUE);
			
			 if( $q -> num_rows() > 0){
			 	return $q -> row();
			 }

			 return false;
		
		}

	}


?>