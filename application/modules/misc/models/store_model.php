<?php
if (! defined ( 'BASEPATH' ))
	exit ( 'No direct script access allowed' );
class Store_model extends BaseModel {
	public function __construct() {
		parent::__construct ();
		$this->db = $this->load->database ( 'default', TRUE );
		$this->load->helper ( 'date' );
	}

	


}