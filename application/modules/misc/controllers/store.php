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
	//this function used to add and edit store data
	public function addStore(){
		
		//if id ,then edit the data
		$id = $this->input->post('id');
		if( !id){
			// $this->input_require('editor');//there are three type 1.user 2.saler 3.storeHost
			$this->input_require('editByUid');
			$this->input_require('storeName');
			$this->input_require('address');
			$this->input_require(array('or'=>array('tel1','tel2','tel3')));
		}
		
		// $editor = $this->input->post('editor');
		$editByUid = $this->input->post('editByUid');
		$storeName = $this->input->post('storeName');
		$address = $this->input->post('address');

		$mainItem = $this->input->post('mainItem');	
		$lon = $this->input->post('lon');
		$lat = $this->input->post('lat');
		$tel1 = $this->input->post('tel1');
		$tel2 = $this->input->post('tel2');
		$tel3 = $this->input->post('tel3');
		$workers = $this->input->post('workers'); //how many peoples are there in the store
		$area = $this->input->post('area');
		$equipment = $this->input->post('equipment');
		$workStations = $this->input->post('workStations');  //gong wei
		$mainParts = $this->input->post('mainParts');
		$selfImg = $this->input->post('selfImg');
		$selfContents = $this->input->post('selfContents');
		$openTime = $this->input->post('openTime');
		$createTime = date('Y-m-d H:i:s');
		$status = 'pending';
		$array = array(
				// 'editor'		=> $editor,
				'editByUid'		=> $editByUid,
				'storeName'		=> $storeName,
				'address'		=> $address,
				'createTime'	=> $createTime
			);
		if( $mainItem != false){
			$array['mainItem'] = $mainItem;
		}
		if( $lon != false){
			$array['lon'] = $lon;
		}
		if( $lat != false){
			$array['lat'] = $lat;
		}
		if( $tel1 != false){
			$array['tel1'] = $tel1;
		}
		if( $tel2 != false){
			$array['tel2'] = $tel2;
		}
		if( $tel3 != false){
			$array['tel3'] = $tel3;
		}
		if( $workers != false){
			$array['workers'] = $workers;
		}
		if( $area != false){
			$array['area'] = $area;
		}
		if( $equipment != false){
			$array['equipment'] = $equipment;
		}
		if( $workStations != false){
			$array['workStations'] = $workStations;
		}
		if( $mainParts != false){
			$array['mainParts'] = $mainParts;
		}
		if( $selfImg != false){
			$array['selfImg'] = $selfImg;
		}
		if( $selfContents != false){
			$array['selfContents'] = $selfContents;
		}
		if( $openTime != false){
			$array['openTime'] = $openTime;
		}
		if( $status != false){
			$array['status'] = $status;
		}


		if( !$id){
			//add a new data
			$result = $this->store_model->upsert('store',$array);
		}else{
			//edit the old data
			$result = $this->stroe_model->updataWhere('store',$array,array('id'=>$id));
		}
		
		if( $result ){
			$this->jsonResponse(array('message'=>'success','result'=>$result));
		}else{
			$this->jsonResponse(array('message'=>'error'),400);
		}

	}


}