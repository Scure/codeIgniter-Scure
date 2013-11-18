<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class rest_test extends CI_Controller {

	function __construct(){

		parent::__construct();
		session_start();

	}

	public function index()
	{
				$user = json_decode(  
    file_get_contents('http://scure.me/index.php/scure_api/user_model/id/gling/format/json')  
		);  
		  
		echo $user->name; 
	}





}

