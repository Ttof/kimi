<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Store_model extends BaseModel {
	public function __construct() {
		parent::__construct ();
		$this->db = $this->load->database ( 'default', TRUE );
		$this->load->helper ( 'date' );
	}

	public function createUserInfo( $data){
		
		if ( !$data['id']) {
			//to add a new data to user
			$result = $this->upsert('user',$data);
		}elseif( $data['id']){
			$id = $data['id'];
			unset( $data['id']);
			//to edit the user where the id 
			$result = $this->updataWhere('user',$data,array('id'=> $id));
		}

		return $result;
		
	}

	


}