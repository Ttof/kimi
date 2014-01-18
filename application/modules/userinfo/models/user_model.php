<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class User_model extends BaseModel {
	public function __construct() {
		parent::__construct ();
		$this->db = $this->load->database ( 'default', TRUE );
		$this->load->helper ( 'date' );
	}

	public function createUser($data)
	{
		if( !empty( $data['email'])){
			if (isset($data['id'])) {
				$status['email'] = $this->search('users', array('email'=>$data['email'],'id <>'=>$data['id']),NULL, 1);	
			} else {
				$status['email'] = $this->search('users', array('email'=>$data['email']),NULL, 1);
			}
			
			if( !empty($status['email'])){
				return $result = "该邮箱已经注册，请直接登录";
			}
		}
		if( !empty( $data['weiboUserId'])){
			if (isset($data['id'])) {
				$status['weiboUser'] = $this->search('users',array('weiboUserId'=>$data['weiboUserId'],'id <>'=>$data['id']),NULL, 1);
			} else {
				$status['weiboUser'] = $this->search('users',array('weiboUserId'=>$data['weiboUserId']),NULL, 1);
			}
			
			if( !empty( $status['weiboUser'])){
				return $result = "该微博账号已被其他账号绑定，请直接登录";
			}
		}
		$result = $this->upsert( 'users', $data);
		return $result;
	}

	public function getUserInfo($userId)
	{
		$user = $this->search("users",array("id"=>$userId),NULL,1);
		if (!empty($user)) {
			return $user;	
		} else {
			return "";
		}
		
	}

	public function addUserPraiseCount($userId)
	{
		$this->db->set('praiseCount','praiseCount + 1',false);
		$this->db->where("id",$userId);
		$this->db->update("users");
	}


}