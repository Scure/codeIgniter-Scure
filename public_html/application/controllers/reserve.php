<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



	class Reserve extends CI_Controller{

		function __construct(){

			parent::__construct();
			session_start();

		}

		public function index(){
			
			$this->load->library('form_validation');
			$this->form_validation->set_rules('reserve_email','E-mail','required|valid_email');

			if($this->form_validation->run() !== false){

					$email = $this->input->post('reserve_email');

					$data = array(

							'email' => $email

						);

					$this->load->model('reserve_model');
					$this->reserve_model->addNewReserve($data);
					$this->setNum();
					$_SESSION['email'] = $email;
					$this->load->view('reserve_view');


			}
			else{

				//$this->load->view('landing_view');
				redirect('landing');
			}

		}//end index




		public function setNum(){

				$this->load->model('reserve_model');
				$num = $this->reserve_model->getReserveNum();
				$_SESSION['reserveCount'] = $num;



		}


	}

?>