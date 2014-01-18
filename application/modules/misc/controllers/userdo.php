<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Userdo extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('list_model');
	}

	public function index(){
		
	}
	public function doComments(){
		$this->input_require('storeId');	
		$this->input_require('tecScore');
		$this->input_require('partScore');
		$this->input_require('serverScore');
		$this->input_require('deviceScore');
		$this->input_require('comments');
		$this>input_require('userId');

		$storeId = $this->input->post('storeId');
		$tecScore =$this->input->post('tecScore');
		$partScore = $this->input->post('partScore');
		$serverScore = $this->input->post('serverScore');
		$deviceScore = $this->input->post('deviceScore');
		$comments = $this->input->post('comments');
		$userId = $this->input->post('userId');

		$keepFee = $this->input->post('keepFee');
		$repairFee = $this->input->post('repairFee');
		$meirongFee = $this->input->post('meirongFee');
		$miles = $this->input->post('miles');

		$createTime = date('Y-md H:i:s',time());

		$array = array(
				'storeId' 	=> $storeId,
				'tecScore'	=> $tecScore,
				'partScore'	=> $partScore,
				'serverScore'	=> $serverScore,
				'deviceScore'	=> $deviceScore,
				'comments'		=> $comments,
				'createTime'	=> $createTime,
				'userId'		=> $userId
			);
		if( $keepFee){
			$array['keepFee'] = $keepFee;
		}
		if( $repairFee){
			$array['repairFee'] = $repairFee;
		}
		if( $meirongFee ){
			$array['meirongFee'] = $meirongFee;
		}
		if( $miles ){
			$array['miles'] = $miles;
		}

		$result = $this->list_model->upsert('comments',$array);

		if( !empty( $result)){
			$this->jsonResponse( array('message'=>'success', 'result'=> $result));
		}else{
			$this->jsonResponse( array('message'=>'error'),400);
		}

	}
}