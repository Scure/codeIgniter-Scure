<?php

	class Register_model extends CI_Model{


		function __construct(){

		parent::__construct();
		$this->load->database();


		}

		public function check_for_existing($email){

			$q = $this -> db -> where('email',$email) -> limit(1) -> get('users');
			
	
			if($q->num_rows() > 0){

				return true;	//User exists

			}

			return false;       //User does not exist
		}

		public function verify_user($email,$password){

			$q = $this -> db -> where('email_address',$email)->where('password',sha1($password)) -> limit(1) -> get('users');

			 if( $q -> num_rows > 0){
			 	
			 	return $q -> row();
			
			 }

			 return false;
		
		}
		
		public function register_user(){
			
			
			
			
		}
		

	}


?>