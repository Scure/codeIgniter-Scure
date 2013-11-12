<?php

	class Reserve_model extends CI_Model{


			function __construct(){

				parent::__construct();
			}



			function addNewReserve($data){


						$this -> db -> insert('reserve_list',$data);


			}


			function getReserveNum(){

			$q = $this -> db -> get('reserve_list');

			if($q -> num_rows() > 0){

					return $q->num_rows();
			}



			}

	}







?>