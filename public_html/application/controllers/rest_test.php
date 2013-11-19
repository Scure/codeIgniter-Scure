<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rest_test extends CI_Controller {

	function __construct(){

		parent::__construct();
		session_start();

	}

	public function index()
	{

		//$url = 'http://scure.me/index.php/scure_api/user/';
		//$data = array('id'=>'gling','email'=>'csulb.edu','pw'=>'power','firstname'=>'James','lastname'=>'Ling','format'=>'json');

		$this -> native_curl('gling','eiele@cuslb.edu');
	}



  
  function native_curl($new_name, $new_email)  
  {  
				 
				  
				$r = new HttpRequest('http://scure.me/index.php/scure_api/user/', HttpRequest::METH_POST);
		$r->setOptions(array('cookies' => array('lang' => 'de')));
		$r->addPostFields(array('id' => 'mike', 'email' => 'csulb.edu'));
		try {
		    echo $r->send()->getBody();
		} catch (HttpException $ex) {
		    echo $ex;
}
  }


}
