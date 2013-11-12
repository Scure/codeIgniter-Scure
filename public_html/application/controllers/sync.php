<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sync extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	 function __construct(){
			
		session_start();
		parent::__construct();

	}

	public function index()
	{		
		if(!isset($_SESSION['username'])){
			redirect('admin');
		}
		$this->load->library('form_validation');   //Load form validation library
		$this->form_validation->set_rules('deviceid1', 'ID1', 'required|min_length[5]');
		$this->form_validation->set_rules('deviceid2', 'ID2', 'required|min_length[5]');
		$this->form_validation->set_rules('deviceid3', 'ID3', 'required|min_length[5]');
		$this->form_validation->set_rules('deviceid4', 'ID4', 'required|min_length[5]');

		$email = $_SESSION['username'];
		$this->load->model('sync_model');
		$result = $this->sync_model->verify_user($email);

//Insert form validation here 

		$id1 = $this->input->post('deviceid1');
		$id2 = $this->input->post('deviceid2');
		$id3 = $this->input->post('deviceid3');
		$id4 = $this->input->post('deviceid4');


	if($result == false){
		if($this -> form_validation->run() !== false){
		$device_id_string = $id1.$id2.$id3.$id4;


		$data = array(

				'email' => $_SESSION['username'],
				'device_id' => $device_id_string,
				'id1' => $id1,
				'id2' => $id2,
				'id3' => $id3,
				'id4' => $id4

			);

				$this->db->insert('user_devices',$data);
		
		$row = $this->sync_model->getExisting($email);
		$_SESSION['device_id'] = $row -> device_id;
		$_SESSION['id_1'] = $row -> id1;
		$_SESSION['id_2'] = $row -> id2;
		$_SESSION['id_3'] = $row -> id3;
		$_SESSION['id_4'] = $row -> id4;
				//echo "<div class=\"alert alert-success\">Device Succesfully Registered</div>";
	
	}//end validation
		
}
	else{

		//user already has a registered device. 
		$row = $this->sync_model->getExisting($email);
		$_SESSION['device_id'] = $row -> device_id;
		$_SESSION['id_1'] = $row -> id1;
		$_SESSION['id_2'] = $row -> id2;
		$_SESSION['id_3'] = $row -> id3;
		$_SESSION['id_4'] = $row -> id4;


	}

		$this->load->view('sync_view');
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */