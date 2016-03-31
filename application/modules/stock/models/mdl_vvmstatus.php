<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Vvmstatus extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();	
	}
	function get_vvm(){
		$this->db->select('id,name');
        $query = $this->db->get('m_vvm_status');
        return $query->result();
	}

}