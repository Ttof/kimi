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


}