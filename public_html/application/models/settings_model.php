<?php

	class Settings_model extends CI_Model{


			function __construct(){

				parent::__construct();
			}



			function newSettings($data,$email){

						$this -> db -> where('email',$email);
						$this -> db -> update('user_settings',$data);


			}


			function getSettings($email){
//			$q = $this -> db -> where('email_address',$email)->where('password',sha1($password)) -> limit(1) -> get('users');
				

			$q = $this -> db -> where('email',$email) -> limit(1) -> get('user_settings');

			if($q -> num_rows() > 0){

					return $q->row();
			}



			}

	}







?>