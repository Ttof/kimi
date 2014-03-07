<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

class Listinfo extends BaseController
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('list_model');
	}

	public function index(){
		
	}
	//select name of main menu
	public function getMainMenuNameById(){
		$mainMenuId = $this->input->get('mainMenuId');
		if(  $mainMenuId){
			$array = array( 'id' =>$mainMenuId);
		}else{
			//select all of the main menu name
			$array = array('id <> '=> '');
		}

		$result = $this->list_model->search('main_menu',$array,null);
		if( !empty( $result)){
			$this->jsonResponse( array('message'=>'success','result'=>$result));
		}else{
			$this->jsonResponse( array('message'=>'error'),400);
		}
		
	}
	//select the sub menu name  main menu id
	public function getSubMenuNameByMainId(){
		$this->input_require('mainMenuId');
		$mainMenuId = (int)$this->input->get('mainMenuId');
		$result = $this->list_model->search('sub_menu',array('mainMenuId'=>$mainMenuId),null);
		if( !empty( $result)){
			$this->jsonResponse(array('message'=>'success','result'=>$result));
		}else{
			$this->jsonResponse(array('messge'=>'error'),400);
		}
		
	}
	//select the menu list by the sub id
	public function getMenuListBySubId(){
		$this->input_require('subMenuId');
		$subMenuId = (int)$this->input->get('subMenuId');
		$result = $this->list_model->search('menu_list',array('subMenuId'=>$subMenuId),null);
		if( !empty($result)){
			$this->jsonResponse( array('message'=>'success','result'=>$result));
		}else{
			$this->jsonResponse( array('message'=>'error'),400);
		}
		
	}
	//select the renzheng of the store
	public function getStoreMarkByStoreId(){
		$this->input_require('storeId');
		$storeId = $this->input->get('storeId');
		$result = $this->list_model->search('store_mark',array('storeId'=>$storeId),null,1);
		if( !empty( $result)){
			$this->jsonResponse( array('message'=>'success','result'=> $result));
		}else{
			$this->jsonResponse( array('message'=>'error'),400);
		}
	}
	public function stroeInfoByStoreId(){
		$this->input_require('storeId');
		$storeId = $this->input->get('storeId');
		$result = $this->list_model->search('store',array('id'=>$storeId),null,1);
		if( !empty( $result)){
			$this->jsonResponse(array('message'=>'success','result'=> $result));
		}else{
			$this->jsonResponse( array('message'=>'error'),400);
		}
	}
	
	//user collect store
	// public function addCollect(){
	// 	$this->input_require('userId');
	// 	$this->input_require('storeId');
	// 	$userId = $this->input->get('userId');
	// 	// $storeId = $this->input->get('storeId');
	// 	$array = array(
	// 		'userId'	=> $userId,
	// 		'storeId'	=> $storeId,
	// 		'date'		=> date('Y-m-d H:i:s',time());
	// 		);
	// 	$collectId = $this->list_model->upsert('collect',$array);
	// 	$this->jsonResponse( array('message'=>'success','result'=>$collectId));
	// }

	// //list user's store
	// public function getUserCollect(){
	// 	$this->input_require('userId');
	// 	$userId = $this->input->get('userId')
	// 	$sql = 'SELECT * FROM `store` LEFT JOIN `collect` ON `store`.`id`=`colect`.`storeId` where `collect`.`userId`='.$userId;
	// 	$result = $this->db->query( $sql);
	// 	if( !empty( $result)){
	// 		$this->jsonResponse( array('message' => 'success','result'=>$result));
	// 	}else{
	// 		$this->jsonResponse( array('message' => 'error'),400);
	// 	}

	// }

	// add user log
	public function addUserLog(){
		$id = $this->input->get('id');
		if( !isset( $id)){
			$this->input_require('storeName');
			$this->input_require('userId');
		}

		$userId = $this->input->get('userId');
		$storeName = $this->input->get('storeName');
		$miles = $this->input->get('miles');
		$projectName = $this->input->get('projectName');
		$subProName = $this->input->get('subProName');
		$fee = $this->input->get('fee');
		$notes = $this->input->get('notes');

		$array = array(
				'storeName'		=> $storeName,
				'userId'		=> $userId,
				'createTime'	=> date('Y-m-d H:i:s',time())
			);

		if( isset( $miles)){
			$array['miles'] = $miles;
		}
		if( isset( $projectName)){
			$array['projectName'] = $projectName;
		}
		if( isset( $subProName)){
			$array['subProName'] = $subProName;
		}
		if( isset( $fee)){
			$array['fee'] = $fee;
		}
		if( isset( $notes)){
			$array['notes'] = $notes;
		}

		if( !isset( $id)){
			$result = $this->list_model->upsert('user_log',$array);
			$this->jsonResponse( array('message'=>'success','result'=>$result));
		}else{
			$this->list_model->updateWhere('user_log',$array,array('id'=>$id));
			$this->jsonResponse( array('message'=>'success'));
		}
		
	}
	public function getUserLogByUserId(){
		$this->input_require('userId');
		$userId = $this->input->get('userId');

		$result = $this->list_model->search('user_log',array('userId'=> $userId),null);
		if( !empty( $result)){
			$this->jsonResponse( array('message'=>'success','result' => $result));
		}else{
			$this->jsonResponse( array('message'=>'error','result'=>'no user log'),400);
		}
		
	}
	// jingying fanwei
	public function getManage(){
		$this->input_require('storeId');
		$storeId = $this->input->get('storeId');

		$result = $this->list_model->search('manage',array('storeId'=>$storeId),null);
		// if( !empty( $result)){
			$this->jsonResponse( array('message'=>'success','result'=>$result));	
		// }else{
		// 	$this->jsonResponse( array('message'=>'error','result'=>'result null'),400);
		// }
		
	}
	public function getCommentsList(){
		$this->input_require('storeId');
		
		$storeId = $this->input->get('storeId');
		
		$totalTecScore = '';
		$totalPartScore = '';
		$totalServerScore = '';
		$totalDeviceScore = '';
		$result = $this->list_model->search('comments',array('storeId'=>$storeId));
		
		
		if( !empty( $result)){
			$total = count( $result);
			foreach ($result as $val){
				$totalTecScore =  $totalTecScore+ $val['tecScore'];
				$totalPartScore = $totalPartScore + $val['partScore'];
				$totalServerScore = $totalServerScore + $val['serverScore'];
				$totalDeviceScore = $totalDeviceScore + $val['deviceScore'];
				$averageScore = ( $totalDeviceScore + $totalPartScore + $totalServerScore + $totalTecScore )/($total * 4);
				$comments = $val['comments'];
			}
			$average = array(
					'aveTecScore'		=> intval($totalTecScore/$total),
					'avePartScore'		=> $totalPartScore/$total,
					'aveServerScore'	=> $totalServerScore/$total,
					'aveDeviceScore'		=> $totalDeviceScore/$total,
					'averageScore'		=> intval( $averageScore),
					'total'				=> $total,
					'comments'			=> $comments
			);
			$this->jsonResponse( array('message'=>'success','averageList'=>$average,'list'=>$result));
		}else{
			$this->jsonResponse( array('message'=>'error','result' => 'no result'),400);
		}
	}
	
	
	private function getAverageScore($storeId){
		$result = $this->list_model->search('comments',array('storeId'=>$storeId),null);
		
		$totalTecScore ='';
		$totalPartScore = '';
		$totalServerScore = '';
		$totalDeviceScore = '';
		$averageScore = '';
		$total = 1;
		
		if( !empty( $result)){
			$total = count( $result);
			foreach( $result as $val){
				$totalTecScore =  $totalTecScore+ $val['tecScore'];
				$totalPartScore = $totalPartScore + $val['partScore'];
				$totalServerScore = $totalServerScore + $val['serverScore'];
				$totalDeviceScore = $totalDeviceScore + $val['deviceScore'];
			}
			$averageScore = ( $totalDeviceScore + $totalPartScore + $totalServerScore + $totalTecScore )/($total * 4);
		}
		$average = array(
				'aveTecScore'		=> intval($totalTecScore/$total),
				'avePartScore'		=> intval($totalPartScore/$total),
				'aveServerScore'	=> intval($totalServerScore/$total),
				'aveDeviceScore'	=> intval($totalDeviceScore/$total),
				'averageScore'		=> intval( $averageScore),
				'total'				=> $total,
		);
		return $average;
	}
	
	public function getCollectList(){
		$this->input_require('userId');
		$limit = $this->input->get("limit");
		
		$userId = $this->input->get('userId');
		
		if (empty($limit)) {
			$limit = 20;
		}
		$start = $this->input->get("start");
		$page = $this->input->get("page");
		if (!empty($page)) {
			$start = $page * $limit;
		}
		
		$result = $this->list_model->search('collect',array('userId'=>$userId),null);
		if( !empty( $result)){
			foreach( $result as $key => $val){
				$sql = "SELECT * FROM `store` LEFT JOIN `collect` ON `store`.`id`= `collect`.`storeId` WHERE `collect`.`status`='1' AND `store`.`id` = ? limit ?,?";
				$store = $this->list_model->query( $sql,array( $val['storeId'],$start,$limit));
				$result[$key]['store'] = $store['0'];
				$average = $this->getAverageScore( $val['storeId']);
				$result[$key]['score'] = $average['averageScore'] ? $average['aveDeviceScore']:'5';//if no coments then 5 full score
				unset( $result[$key]['editor']);
				unset( $result['status']);
			}
			$this->jsonResponse( array('message'=>'success','result'=>$result));
		}else{
			$this->jsonResponse( array( 'message'=>'error','result'=>'no collect'),400);
		}
	}
	public function getRecommendsList(){
		$this->input_require('userId');
		
		$userId = $this->input->get('userId');
		
		$start = $this->input->get('start');
		$limit = $this->input->get('limit');
		$page = $this->input->get('page');
		
		if( empty( $limit)){
			$limit = 20;
		}
		
		if( !empty( $page)){
			$start = $limit * $page;
		}
		
		$result = $this->list_model->search('recommends',array('userId'=>$userId),'desc',$limit,$start,$page);
		if( !empty( $result)){
			$this->jsonResponse( array('message'=>'success','result'=>$result));
		}else{
			$this->jsonResponse( array('message'=>'error','result'=>'no recommends'),400);
		}
		
	}
	/*
	 * store list 
	 */
	public function getStoreList(){
		$this->input_require('title');
		
		$start = $this->input->get('start');
		$limit = $this->input->get('limit');
		$page = $this->input->get('page');		
		$title = $this->input->get('title');
		
		if( empty($limit)){
			$limit = 20;
		}
		
		if( !empty( $page)){
			$start = $limit * $page;
		}
		
		$sql = "SELECT * FROM `store` WHERE `mainItem` LIKE ? LIMIT ?,?";
		$result = $this->list_model->query($sql, array("%".$title."%",intval($start),intval( $limit)));
		if( !empty( $result)){
			foreach ( $result as &$val){
				unset($val['editByUid']);
				unset($val['editor']);
				unset($val['status']);
			}
		}
		
		if( !empty($result)){
			$this->jsonResponse( array('message'=>'success','result'=>$result));
		}else{
			$this->jsonResponse( array('message'=>'error','result'=>'no store list'),400);
		}
	}
	public function carDoctor(){
		$this->input_require('userId');
		
		$userId = $this->input->get('userId');
		$status = 'pending';
		$content = $this->input->get('content');
		
		$array = array(
				'userId'		=> $userId,
				'createDate'	=> date('Y-m-d H:i:s',time()),
				'status'		=> $status,
				'content'		=> $content
		);
		
	}
	


}
