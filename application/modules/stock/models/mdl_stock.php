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
	function get_batches($selected_vaccine, $user_id){
		$this->db->select('batch_number,expiry_date,stock_balance');
		$s = array('vaccine_id' => $selected_vaccine, 'stock_balance !=' => '0');
		$u = array('user_id' => $user_id);
        $this->db->where($s);
        $this->db->where($u);
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
	
	function get_region_base(){
		$this->db->select('id, region_name as location');
		$query=$this->db->get('m_region');
		return $query->result();
	}

	function get_county_base($user_id){
		$this->db->select('m_county.id, m_county.county_name as location');
		$this->db->from('m_region');
		$this->db->join('region_userbase_view', 'm_region.id = region_userbase_view.region');
		$this->db->join('m_county', 'm_region.id =  m_county.region_id ');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_subcounty_base($user_id){
		$this->db->select('m_subcounty.id, m_subcounty.subcounty_name as location');
		$this->db->from('m_county');
		$this->db->join('county_userbase_view', 'm_county.id = county_userbase_view.county');
		$this->db->join('m_subcounty', 'm_county.id =  m_subcounty.county_id ');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_facility_base($user_id){
		$this->db->select('m_facility.id, m_facility.facility_name as location');
		$this->db->from('m_subcounty');
		$this->db->join('subcounty_userbase', 'm_subcounty.id = subcounty_userbase.subcounty');
		$this->db->join('m_facility', 'm_subcounty.id =  m_facility.subcounty_id ');
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->result();
	}


}