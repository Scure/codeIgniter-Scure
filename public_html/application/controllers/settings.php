<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {

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
		
		$email = $_SESSION['username'];
		$this->load->model('settings_model');
		$row = $this->settings_model->getSettings($email);

		$_SESSION['soundSetting'] = $row -> audio_sensor;
		$_SESSION['tempSetting']  = $row -> temp_sensor;
		$_SESSION['motionSetting'] = $row -> motion_sensor;
/**d
		$soundSetting  = $this->input->post('soundSetting');
		$tempSetting   = $this->input->post('tempSetting');
		$motionSetting = $this->input->post('motionSetting');
**/




		$this->load->view('settings_view');
	}

	public function setNewSettings(){

			$email = $_SESSION['username'];
			$soundSetting = $this->input->post('soundSetting');
			$tempSetting  = $this->input->post('tempSetting');
			$motionSetting = $this->input->post('motionSetting');


			$data = array(

					'audio_sensor' => $soundSetting,
					'temp_sensor'  => $tempSetting, 
					'motion_sensor' => $motionSetting


				);


			$this->load->model('settings_model');
			$this->settings_model->newSettings($data,$email);
			redirect('settings');
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */