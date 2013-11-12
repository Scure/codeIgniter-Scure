<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Logout extends CI_Controller{

	function __construct(){

		parent::__construct();
		session_start();

	}


	public function index(){


		session_destroy();
		$this->load->view('login_view');
		//redirect('admin');

	}


}

?>