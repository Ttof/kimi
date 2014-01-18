<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Store extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('store_model');
	}

	public function index(){
		
	}
	public function storeList(){
		// if ( !$this->session->userdata('is_admin')) 
		// 	redirect('login');
		$array = array('id <> '=> '');
		 $selectVal = $this->input->get('selectVal');
		if( $selectVal !== false){
			if( $selectVal == 'pass'){
				$array = array('status'=>'pass');
			}
			if( $selectVal == 'pending'){
				$array = array( 'status'=>'pending');
			}
		}
		
		$storeInfo = $this->store_model->search('store',$array,null);

		$data['storeInfo'] = $storeInfo;
		$this->load->view('storeList',$data);
	}
	public function pass(){
		$id = $this->input->post('id');
		$this->store_model->updateWhere('store',array('status'=>'pass'),array('id'=> $id));
		echo 1;
	}
	public function deny(){
		$id = $this->input->post('id');
		$this->store_model->updateWhere('store',array('status'=>'deny'),array('id'=> $id));	
		echo 1;
	}


}