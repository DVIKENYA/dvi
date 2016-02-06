<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Stock extends CI_Model
{
	var $order = array('expiry_date' => 'desc');
	var $ledger_order_value = array('date_created' => 'desc');
	var $column = array(
			
			'vaccine_name',
			'batch_no',
			'date_created',
			'expiry_date',
			'order_destination',
			'amount_ordered',
			'amount_received',
		);
	var $column2 = array(
			
			'vaccine_name',
			'batch_no',
			'date_created',
			'expiry_date',
			'issuing_station',
			'amount_ordered',
			'amount_issued',
	
		);
	
	function __construct()
	{
	parent::__construct();	
	}

	function get_all_physical_counts($selected_vaccine, $station_id){
		$this->db->select('vaccine_id, Vaccine_name, batch_number, expiry_date ,physical_count as stock_balance');
		$this->db->join('m_vaccines ', ' m_vaccines.ID = m_physical_count.vaccine_id');
		$array = array('vaccine_id' => $selected_vaccine,'station_id' => $station_id);
		$this->db->where($array);
//		$this->db->group_by('station_id');
		$query = $this->db->get('m_physical_count');
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
        $this->db->group_by('batch_number');
		$query = $this->db->get('m_stock_balance');
		return $query->result_array();
	}

	function get_batchdetails($selected_batch, $station_id){
		$this->db->select('order_id as id, expiry_date,sum(stock_balance) as stock_balance,mv.name as status');
		$this->db->join('m_vvm_status mv', 'mv.id = vvm_status', 'left');
		$array = array('batch_number' => $selected_batch, 'station_id' => $station_id);
        $this->db->where($array);
		$query = $this->db->get('m_stock_balance');
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
		// echo $this->db->last_query();
		return $query->result();
	}
	

	private function _get_ledger_in_query($id, $station_id){
		$this->db->select($this->column);
		$this->db->from('view_orders_received ');
		$array = array('vaccine_id' => $id, 'station_id' => $station_id);
		$this->db->where($array);
		$i = 0;

		foreach ($this->column as $item) 
		{	
	
			if($_POST['search']['value']){
				if($i===0) // first loop
                {	
                	
                    // $this->db->where("(".$item.") like ('%".$_POST['search']['value']."%')");
                     $this->db->like($item, $_POST['search']['value']);
                   
                }
                else
                {	
                	
                  // $this->db->or_where("(".$item.") like ('%".$_POST['search']['value']."%')");
                  $this->db->or_like($item, $_POST['search']['value']);
                }

            //     if(count($this->column) - 1 == $i) //last loop
                   // $this->db->group_end(); //close bracket
             }
            $column[$i] = $item; // set column array variable to order processing
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
		$this->db->join('m_vaccines mv ', 'mv.ID=o.vaccine_id', 'inner');
		$this->db->join('m_stock_balance ms ', ' ms.vaccine_id=mv.ID', 'inner');
		$this->db->join('m_vvm_status mvs ', ' mvs.id=ms.vvm_status', 'inner');
		$array = array('o.vaccine_id' => $vaccine_id, 'm.order_id' => $order_id);
		$this->db->group_by('ms.vaccine_id,ms.batch_number,ms.station_id');
        $this->db->where($array);
		$query = $this->db->get();
		return $query->result();
	}	

	function get_order_batch_details($selected_batch ,$order_id){
		$this->db->distinct();
		$this->db->select(' m.order_id,o.vaccine_id,ms.batch_number,ms.expiry_date,sum(ms.stock_balance) as stock_balance,mvs.name as status');
		$this->db->from('m_order m');
		$this->db->join('order_item o ', 'o.order_id=m.order_id', 'inner');
		$this->db->join('m_vaccines mv ', 'mv.ID=o.vaccine_id', 'inner');
		$this->db->join('m_stock_balance ms ', ' ms.vaccine_id=mv.ID', 'inner');
		$this->db->join('m_vvm_status mvs ', ' mvs.id=ms.vvm_status', 'inner');
		$array = array('ms.batch_number' => $selected_batch, 'm.order_id' => $order_id);
        $this->db->where($array);
        $this->db->group_by('ms.vaccine_id,ms.batch_number,ms.station_id');
		$query = $this->db->get('m_stock_balance');
		// return $query->result_array();
		return $query->result();
	}

	function get_stock_balance($selected_vaccine ,$station_id){
		$this->db->distinct();
		// $this->db->select(' ms.batch_number,ms.expiry_date,sum(ms.stock_balance) as stock_balance');
		// $this->db->from('m_stock_balance ms');
		// $this->db->join('m_vaccines mv ', 'mv.ID=ms.vaccine_id', 'inner');
		// $this->db->join('m_vvm_status mvs ', ' mvs.id=ms.vvm_status', 'inner');
		// $array = array('ms.vaccine_id' => $selected_vaccine, 'ms.station_id' => $station_id);
  //       $this->db->where($array);
  //       $this->db->group_by('ms.vaccine_id,ms.station_id');
		$this->db->select(' ms.batch_number,ms.expiry_date,sum(ms.stock_balance) as stock_balance');
		$this->db->from('m_order m');
		$this->db->join('order_item o ', 'o.order_id=m.order_id', 'inner');
		$this->db->join('m_vaccines mv ', 'mv.ID=o.vaccine_id', 'inner');
		$this->db->join('m_stock_balance ms ', ' ms.vaccine_id=mv.ID', 'inner');
		$this->db->join('m_vvm_status mvs ', ' mvs.id=ms.vvm_status', 'inner');
		$array = array('o.vaccine_id' => $selected_vaccine, 'ms.station_id' => $station_id);
		$this->db->where($array);
        $this->db->group_by('o.vaccine_id, ms.station_id');
		$query = $this->db->get();
		return $query->result_array();
	}

	function get_batch_stock_summary($selected_vaccine ,$station_id){
		$this->db->distinct();
		$this->db->select(' ms.batch_number,ms.expiry_date,sum(ms.stock_balance) as stock_balance');
		$this->db->from('m_order m');
		$this->db->join('order_item o ', 'o.order_id=m.order_id', 'inner');
		$this->db->join('m_vaccines mv ', 'mv.ID=o.vaccine_id', 'inner');
		$this->db->join('m_stock_balance ms ', ' ms.vaccine_id=mv.ID', 'inner');
		$this->db->join('m_vvm_status mvs ', ' mvs.id=ms.vvm_status', 'inner');
		$array = array('o.vaccine_id' => $selected_vaccine, 'ms.station_id' => $station_id);
        $this->db->where($array);
        $this->db->group_by('o.vaccine_id, ms.batch_number, ms.station_id');
		$query = $this->db->get();
		return $query->result_array();
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