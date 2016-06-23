<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Stock extends CI_Model
{
	var $order = array('expiry_date' => 'desc');
	var $receive_order_value = array('date_received' => 'desc');
	var $issue_order_value = array('date_issued' => 'desc');
	var $column = array(
		0 =>'date_received',
		1=>'vaccine_name',
		2 =>'batch_no',
		3 =>'expiry_date',
		4 =>'order_destination',
		5 =>'amount_ordered',
		6 =>'amount_received',
		7 =>'receive_id',
		8 =>'id'
		);
	var $column2 = array(
		0 =>'date_issued',
		1 =>'vaccine_name',
		2 =>'batch_no',
		3 =>'expiry_date',
		4 =>'issued_to',
		5 =>'amount_ordered',
		6 =>'amount_issued',
	
		);
	
	function __construct()
	{
	parent::__construct();	
	}

	function get_all_physical_counts($selected_vaccine, $station_id){
		$this->db->select('vaccine_id, Vaccine_name, batch_number, expiry_date ,physical_count as stock_balance, date_of_count');
		$this->db->join('m_vaccines ', ' m_vaccines.ID = m_physical_count.vaccine_id');
		$array = array('vaccine_id' => $selected_vaccine,'station_id' => $station_id);
		$this->db->where($array);
		$this->db->order_by('date_of_count' , 'desc');
		$query = $this->db->get('m_physical_count');
	    return $query;

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
        $this->db->select('batch_number');
        $array = array('vaccine_id' => $selected_vaccine, 'station_id' => $station_id);
        $this->db->where($array);
        $this->db->group_by('batch_number');
        $this->db->having('min(stock_balance) > 0');
        $this->db->order_by('expiry_date', 'asc');
        // $this->db->limit(1);
        $query = $this->db->get('m_stock_balance');
		return $query->result_array();
	}

	function get_batch_details($selected_batch, $station_id){


		$this->db->select('batch_number,expiry_date,mv.name as status,stock_balance,receive_id');
		$this->db->join('m_vvm_status mv', 'mv.id = vvm_status', 'left');
		$array = array('batch_number' => $selected_batch, 'station_id' => $station_id);
        $this->db->where($array);
        $this->db->order_by('last_update', 'desc');
        $this->db->limit(1);
        // $this->db->group_by('ms.vaccine_id,ms.batch_number,ms.station_id');
        // $this->db->having('sum(ms.stock_balance) > 0');
		$query = $this->db->get('m_stock_balance ms');
		return $query->result_array();
	
	}


	function save_physical_count($data){
		$table = "m_physical_count";
		$this->db->insert($table, $data);
		if($this->db->affected_rows() > 0)
		{
			echo json_encode(array("status" => TRUE));
		}else{
			echo json_encode(array("status" => FALSE));
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
		$this->db->order_by('m_county.county_name', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	
	function get_subcounty_base($user_id){
		$this->db->select('m_subcounty.id, m_subcounty.subcounty_name as location');
		$this->db->from('m_county');
		$this->db->join('county_userbase_view', 'm_county.id = county_userbase_view.county');
		$this->db->join('m_subcounty', 'm_county.id =  m_subcounty.county_id ');
		$this->db->where('user_id',$user_id);
		$this->db->order_by('m_subcounty.subcounty_name', 'asc');
		$query = $this->db->get();
		return $query->result();
	}
	function get_subcounty($user_id){
		$this->db->select('m_subcounty.id, m_subcounty.subcounty_name as location');
		$this->db->from('user_base');
		$this->db->join('m_region', 'm_region.id = region');
		$this->db->join('m_county', 'm_county.region_id = m_region.id');
		$this->db->join('m_subcounty', 'm_subcounty.county_id = m_county.id');
		$this->db->where('user_id',$user_id);
		$this->db->order_by('m_subcounty.subcounty_name', 'asc');
		$query = $this->db->get();
		return $query->result();
	}

	function get_facility_base($user_id){
		$this->db->select('m_facility.id, m_facility.facility_name as location');
		$this->db->from('m_subcounty');
		$this->db->join('subcounty_userbase', 'm_subcounty.id = subcounty_userbase.subcounty');
		$this->db->join('m_facility', 'm_subcounty.id =  m_facility.subcounty_id ');
		$this->db->order_by('m_facility.facility_name', 'asc');
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


	public function show_data_by_date_range($option, $date, $id, $station_id) {
		$condition = "date_created BETWEEN " . "'" . $date[0] . "'" . " AND " . "'" . $date[1] . "'";
		$array = array('vaccine_id' => $id, 'station_id' => $station_id);
		if ($option=='in') {
			$this->db->select($this->column);
			$this->db->where($array);
			$this->db->where($condition);
			$query = $this->db->get('view_orders_received');
		} elseif ($option=='out') {
			$this->db->select($this->column2);
			$this->db->where($array);
			$this->db->where($condition);
			$query = $this->db->get('view_orders_issued');
		}
		
		
		return $query->result();

	}


	private function _get_ledger_in_query($id, $station_id){
		$this->db->select($this->column);
		$this->db->from('view_orders_received ');
		$array = array('vaccine_id' => $id, 'station_id' => $station_id, 'hidden =' => 0);
		$this->db->where($array);
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

		else if(isset($this->receive_order_value))
		{
			$order = $this->receive_order_value;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_vaccine_ledger_out($id, $station_id){
			$this->_get_ledger_out_query($id, $station_id);
			if($_POST['length'] != -1)
			$this->db->limit($_POST['length'], $_POST['start']);
			$query = $this->db->get();
			return $query->result();
		}

	private function _get_ledger_out_query($id, $station_id){
		$this->db->select($this->column2);
		$this->db->from('view_orders_issued');
		$array = array('vaccine_id' => $id, 'station_id' => $station_id);
		$this->db->where($array);
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
		else if(isset($this->issue_order_value))
		{
			$order = $this->issue_order_value;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

    function get_order_batch($order_id ,$vaccine_id, $station_id){
        $this->db->distinct();
        $this->db->select('m.order_id,o.vaccine_id,ms.batch_number,ms.expiry_date,mvs.name');
        $this->db->from('m_order m');
        $this->db->join('order_item o ', 'o.order_id=m.order_id', 'inner');
        $this->db->join('m_vaccines mv ', 'mv.ID=o.vaccine_id', 'inner');
        $this->db->join('m_stock_balance ms ', ' ms.vaccine_id=mv.ID', 'inner');
        $this->db->join('m_vvm_status mvs ', ' mvs.id=ms.vvm_status', 'inner');
        $array = array('o.vaccine_id' => $vaccine_id, 'm.order_id' => $order_id, 'ms.station_id' => $station_id);
        $this->db->group_by('ms.vaccine_id,ms.batch_number,ms.station_id');
        $this->db->where($array);
        $this->db->having('min(ms.stock_balance) > 0');
        $query = $this->db->get();
        return $query->result();
    }

    function get_order_batch_details($selected_batch ,$order_id, $station_id){
		
		$this->db->distinct();
        $sum = ('if(sum(ms.stock_balance) > 0,sum(ms.stock_balance),false) as stock_balance');
        $this->db->select(' m.order_id,o.vaccine_id,ms.batch_number,ms.expiry_date,mvs.name as status,'.$sum.'',false);
		$this->db->from('m_order m');
		$this->db->join('order_item o ', 'o.order_id=m.order_id', 'inner');
		$this->db->join('m_vaccines mv ', 'mv.ID=o.vaccine_id', 'inner');
		$this->db->join('m_stock_balance ms ', ' ms.vaccine_id=mv.ID', 'inner');
		$this->db->join('m_vvm_status mvs ', ' mvs.id=ms.vvm_status', 'inner');
		$array = array('ms.batch_number' => $selected_batch, 'm.order_id' => $order_id, 'ms.station_id' => $station_id);
        $this->db->where($array);
        $this->db->group_by('ms.vaccine_id,ms.batch_number,ms.station_id');
        $this->db->having('sum(ms.stock_balance) > 0');
		$query = $this->db->get('m_stock_balance');
		// return $query->result_array();
		return $query->result();
	}




	function get_stock_balance($selected_vaccine ,$station_id)
	{
		$this->db->distinct();
		$this->db->select('ms.batch_number,ms.expiry_date,sum(ms.stock_balance) as stock_balance');
		$this->db->from('m_stock_balance ms');
		$array = array('vaccine_id' => $selected_vaccine,'station_id' => $station_id);
		$this->db->where($array);
		$this->db->group_by('vaccine_id,station_id');
		
		$this->db->having('sum(ms.stock_balance) > 0');
		$query = $this->db->get();
		return $query->result();
	}

    
    function get_batch_stock_summary($selected_vaccine ,$station_id){

		$this->db->distinct();
		$this->db->select('ms.batch_number,ms.expiry_date, ms.stock_balance');
		$this->db->from('m_stock_balance ms');
		$array = array('ms.vaccine_id' => $selected_vaccine, 'ms.station_id' => $station_id );
        $this->db->where($array);
        $this->db->group_by('ms.vaccine_id, ms.batch_number');
        $this->db->having('min(ms.stock_balance) > 0');
        $this->db->order_by('expiry_date', 'asc');
		$query = $this->db->get();
		return $query;
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

	function _remove_duplicate($id, $data) {
		$table = "view_orders_received";
		$this->db->where('id', $id);
		$this->db->update($table, $data);
		return true;

	}

}