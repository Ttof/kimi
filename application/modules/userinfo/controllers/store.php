<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Store extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('store_model');
		$this->load->helper('pagination');
	}

	public function index(){
		
	}
	public function storeList(){
		if ( !$this->session->userdata('is_admin')) 
			redirect('login');
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
// 		var_dump( $_GET);
		
		$storeInfo = $this->store_model->search('store',$array,null);

		// Set pagination 还未分页
		$data['limit'] = $this->input->get('per_page') ? $this->input->get('per_page') : 10;
		$data['page'] = $this->input->get('page') ? $this->input->get('page') : 1;

		$total = count( $storeInfo);
		if ($total==0)
		{
			$data['total'] = 0;
		}
		else 
		{
			$data['total'] = $total;
// 			var_dump( uri_string());
			$data['pagination'] = pagination($total, $data['page'], $data['limit'], uri_string());
			// $data['result'] = $this->student_model->find_all($term,$class,$data['limit'],$data['pagination']['offset']);
			// var_dump( $data);
			
		}

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