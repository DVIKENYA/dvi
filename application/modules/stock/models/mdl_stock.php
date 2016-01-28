<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Stock extends CI_Model
{
	var $order = array('id' => 'desc');
	var $ledger_order_value = array('date_created' => 'desc');
	var $column = array(
			'vaccine_id',
			'vaccine_name',
			'batch_no',
			
			'date_created',
			'expiry_date',
			'order_destination',
			'amount_ordered',
			'amount_received',
			'station_id',
		);
	var $column2 = array(
			'vaccine_id',
			'vaccine_name',
			'batch_no',
			
			'date_created',
			'expiry_date',
			'issuing_station',
			'amount_ordered',
			'amount_issued',
			'station_id',
		);
	
	function __construct()
	{
	parent::__construct();	
	}

	function getTotalStockBal($selected_vaccine){
		$this->db->distinct();
		$this->db->select('vaccine_id, Vaccine_name, batch_number, expiry_date ,sum(stock_balance)as stock_balance');
		$this->db->join('m_vaccines ', ' m_vaccines.ID = m_stock_balance.vaccine_id');
		$s = array('vaccine_id' => $selected_vaccine);
		$this->db->where($s);
		$this->db->group_by('station_id');
		$query = $this->db->get('m_stock_balance');
	    return $query->result();

	}

	function count_records($selected_vaccine){
		$this->db->distinct();
		$this->db->select('vaccine_id, Vaccine_name, batch_number, expiry_date ,stock_balance');
		$this->db->join('m_vaccines ', ' m_vaccines.ID = m_stock_balance.vaccine_id');
		$s = array('vaccine_id' => $selected_vaccine);
		$this->db->where($s);
		$query = $this->db->get('m_stock_balance');
	    return $query->num_rows();

	}
	function get_transaction_type(){
		$this->db->select('id,transaction_type');
        $query = $this->db->get('m_transaction_type');
        return $query->result_array();
	}
	function get_batches($selected_vaccine, $station_id){
		$this->db->select('batch_number,expiry_date');
		$s = array('vaccine_id' => $selected_vaccine);
		$u = array('station_id' => $station_id);
        $this->db->where($s);
        $this->db->where($u);
		$query = $this->db->get('m_stock_balance');
		return $query->result_array();
	}

	function get_batchdetails($selected_batch){
		$this->db->select('expiry_date,stock_balance,mv.name');
		$this->db->join('m_vvm_status mv', 'mv.id = vvm_status', 'inner');
		$array = array('batch_number' => $selected_batch);
        $this->db->where($array);
		$query = $this->db->get('m_stock_balance');
		return $query->result_array();
	
	}

	function set_physical_count($data,$count){
		$this->db->where($data);
        $this->db->update('m_stock_balance', $count);
        if($this->db->affected_rows() > 0)
		{
		   echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE, "count" => $count, "data" => $data));
		}
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

	function get_orders($station_id){
		$this->db->select('order_id');
		$this->db->from('m_order');
		$this->db->where('station_id',$station_id);
		$query = $this->db->get();
		return $query->result();
	}

	function get_vaccine_ledger_in($id, $station_id){
		$this->_get_ledger_in_query($id, $station_id);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function get_vaccine_ledger_out($id, $station_id){
		$this->_get_ledger_out_query($id, $station_id);
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	private function _get_ledger_in_query($id, $station_id){
		$this->db->select($this->column);
		$this->db->from('view_orders_received');
		$this->db->where('vaccine_id',$id);
		$this->db->where('station_id',$station_id);
		$i = 0;

		foreach ($this->column as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->ledger_order_value))
		{
			$order = $this->ledger_order_value;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	private function _get_ledger_out_query($id, $station_id){
		$this->db->select($this->column2);
		$this->db->from('view_orders_issued');
		$this->db->where('vaccine_id',$id);
		$this->db->where('station_id',$station_id);
		$i = 0;

		foreach ($this->column2 as $item) 
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column2[$i] = $item;
			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($column2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		else if(isset($this->ledger_order_value))
		{
			$order = $this->ledger_order_value;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_order_batch($order_id ,$vaccine_id){
		$this->db->distinct();
		$this->db->select('m.order_id,o.vaccine_id,ms.batch_number,ms.expiry_date,mvs.name');
		$this->db->from('m_order m');
		$this->db->join('order_item o ', 'o.order_id=m.order_id', 'inner');
		$this->db->join('m_vaccines mv ', 'mv.ID=o.vaccine_id', 'left');
		$this->db->join('m_stock_balance ms ', ' ms.vaccine_id=mv.ID', 'left');
		$this->db->join('m_vvm_status mvs ', ' mvs.id=ms.vvm_status', 'left');
		$array = array('o.vaccine_id' => $vaccine_id, 'm.order_id' => $order_id);
        $this->db->where($array);
		$query = $this->db->get();
		return $query->result();
	}

	
	function count_issued_filtered($id, $station_id){
		$this->_get_ledger_out_query($id, $station_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function count_received_filtered($id, $station_id){
		$this->_get_ledger_in_query($id, $station_id);
		$query = $this->db->get();
		return $query->num_rows();
	}

	function get_store_balance($selected_vaccine, $user_id){
		$this->db->select('Vaccine as vaccine, Stock_Balance as balance');
		$this->db->from('vaccine_stockbalance');
		$this->db->where('id',$selected_vaccine);
		$this->db->where('user_id',$user_id);
		$query = $this->db->get();
		return $query->result();
	}   

	function count_all() {
		$query=$this->db->get('vaccine_movement');
		$num_rows = $query->num_rows();
		return $num_rows;
	}

	function get_order_to_issue($order_id,$station_name){
		$callprocedure="CALL get_order_to_issue($order_id,'$station_name')";
		$query=$this->db->query($callprocedure);
		$query->next_result();
		return $query->result_array();
	}
	function get_order_infor($order_id){
		$callprocedure="CALL get_order_infor($order_id)";
		$query=$this->db->query($callprocedure);
		$query->next_result();
		return $query->result_array();

	}
	function get_order_to_receive($order_id){
		$callprocedure="CALL get_order_to_receive($order_id)";
		$query=$this->db->query($callprocedure);
		$query->next_result();
		return $query->result_array();
	}

}