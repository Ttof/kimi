<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Userinfo extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->helper(array('form', 'url'));  
  		$this->load->library('form_validation');
	}

	public function index(){
		
	}
	public function login(){
		if ($this->session->userdata('is_admin')) 
			redirect('storeList');
		$name = $this->input->post('name');
		$password = $this->input->post('passwd');
		if( $_POST && $name !== false && $password !== false){
			$array = array(
				'userName'	=> $name,
				'password'	=> md5( $password),
				'type'	=> 'admin'
			);
			$result = $this->user_model->search('user',$array,null,1);
			if( !empty( $result)){
				$this->session->set_userdata('is_admin',TRUE);
				redirect('storeList');
			}
		}
		

		$this->load->view('login');
	}
	public function logout()
	{
		
		if ( ! $this->session->userdata('is_admin')) redirect('login');
		$this->session->sess_destroy();
		
		redirect('login');
	}

}