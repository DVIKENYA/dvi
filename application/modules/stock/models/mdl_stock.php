<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Stock extends CI_Model
{
	
	function __construct()
	{
	parent::__construct();	
	}

	function get_transaction_type(){
		$this->db->select('id,transaction_type');
        $query = $this->db->get('m_transaction_type');
        return $query->result_array();
	}
	function get_batches($selected_vaccine){
		$this->db->select('batch_number,expiry_date,stock_balance');
		$array = array('vaccine_id' => $selected_vaccine, 'stock_balance !=' => '0');
        $this->db->where($array);
		$query = $this->db->get('m_stock_balance');
		 return $query->result_array();
	}
	function get_batchdetails($selected_batch){
		$this->db->select('expiry_date,stock_balance,mv.name');
		$this->db->join('m_vvm_status mv', 'mv.id = vvm_status', 'left');
		$array = array('batch_number' => $selected_batch, 'stock_balance !=' => '0');
        $this->db->where($array);
		$query = $this->db->get('m_stock_balance ');
		 return $query->result_array();
	
	}
	function get_vaccine_ledger($selected_vaccine){
		$call_procedure="CALL GetVaccinesLedger($selected_vaccine)";
        $query=$this->db->query($call_procedure);
        $query->next_result();
        return $query->result_array();
	}
	function set_physical_count($data,$count){
		$this->db->where($data);
        $this->db->update('m_stock_movement', $count);
	}
	

}