<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mdl_Facility extends CI_Model {
var $order = array('id' => 'desc');
var $column = array('mf.id', 'mf.facility_name', 'officer_incharge', 'vaccine_carrier', 'cold_box','subcounty_name', 'county_name', 'region_name');
var $fridge_columns = array('m_facility.facility_name', 'm_facility_fridges.refrigerator_id', 'Model', 'Manufacturer', 'temperature_monitor_no', 'main_power_source');
var $facility_fridges = array('m_facility_fridges.refrigerator_id',  'm_fridges.Model', 'm_fridges.Manufacturer', 'temperature_monitor_no', 'main_power_source','refrigerator_age');

function __construct() {
parent::__construct();
}



function get_table() {
$table = "m_facility";
return $table;
}

private function _get_datatables_query($station_id){

// $this->db->from($this->get_table());
$this->search_order($station_id);
}
	function search_order($station_id)
	{
        if ($station_id!=NULL){
			$this->db->select($this->column);
			$this->db->from('m_facility mf');
			$this->db->join('m_subcounty', 'm_subcounty.id = mf.subcounty_id');
			$this->db->join('m_county', 'm_county.id = mf.county_id');
			$this->db->join('m_region', 'm_county.region_id = m_region.id');
			$this->db->where('county_name',$station_id);
			$this->db->or_where('subcounty_name',$station_id);
			$this->db->or_where('region_name',$station_id);

		}else{
			$this->db->select($this->column);
			$this->db->from('m_facility mf');
			$this->db->join('m_subcounty', 'm_subcounty.id = mf.subcounty_id');
			$this->db->join('m_county', 'm_county.id = mf.county_id');
			$this->db->join('m_region', 'm_county.region_id = m_region.id');
		}
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
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

    function getFacility($station_id){

        $this->_get_datatables_query($station_id);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
}

function get_fridges_by_id($id){
$this->_get_fridges_query($id);
if($_POST['length'] != -1)
$this->db->limit($_POST['length'], $_POST['start']);
$query = $this->db->get();
return $query->result();
}

function count_filtered($station_id){
$this->_get_datatables_query($station_id);
$query = $this->db->get();
return $query->num_rows();
}

private function _get_fridges_query($id){
$this->db->select($this->facility_fridges);    
$this->db->from('m_facility');
$this->db->join('m_facility_fridges', 'm_facility.id = m_facility_fridges.facility_id');
$this->db->join('m_fridges', 'm_facility_fridges.refrigerator_id = m_fridges.id');
$this->db->where('m_facility.id',$id);

$i = 0;

foreach ($this->facility_fridges as $item) 
{
	if($_POST['search']['value'])
		($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
	$facility_fridges[$i] = $item;
	$i++;
}

if(isset($_POST['order']))
{
	$this->db->order_by($facility_fridges[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
} 
else if(isset($this->order))
{
	$order = $this->order;
	$this->db->order_by(key($order), $order[key($order)]);
}
}


function get_fridges($id){
$this->db->select($this->fridge_columns);    
$this->db->from('m_facility');
$this->db->join('m_facility_fridges', 'm_facility.id = m_facility_fridges.facility_id');
$this->db->join('m_fridges', 'm_facility_fridges.refrigerator_id = m_fridges.id');	
$this->db->where('m_fridges.id',$id);
$query = $this->db->get();
return $query->row();
}

function get_fridge_model(){
$this->db->select('id, Model, Manufacturer');    
$this->db->from('m_fridges');
$query = $this->db->get();
return $query->result();
}


function count_fridges_filtered($id){
$this->_get_fridges_query($id);
$query = $this->db->get();
return $query->num_rows();
}

function get($order_by){
$table = $this->get_table();
$this->db->order_by($order_by);
$query=$this->db->get($table);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$table = $this->get_table();
$this->db->limit($limit, $offset);
$this->db->order_by($order_by);
$query=$this->db->get($table);
return $query;
}

function get_where($id){
$table = $this->get_table();
$this->db->where('id', $id);
$query=$this->db->get($table);
return $query;
}

function get_where_custom($col, $value) {
$table = $this->get_table();
$this->db->where($col, $value);
$query=$this->db->get($table);
return $query;
}

function _insert($data){
$table = $this->get_table();
$this->db->insert($table, $data);
}

function _update($id, $data){
$table = $this->get_table();
$this->db->where('id', $id);
$this->db->update($table, $data);
}

function _delete($id){
$table = $this->get_table();
$this->db->where('id', $id);
$this->db->delete($table);
}

function _insert_fridge($data){
$table = 'm_facility_fridges';
$this->db->insert($table, $data);
}

function _update_fridge($id, $data){
$table = 'm_facility_fridges';
$this->db->where('refrigerator_id', $id);
$this->db->update($table, $data);
}

function _delete_fridge($id){
$table = 'm_facility_fridges';
$this->db->where('refrigerator_id', $id);
$this->db->delete($table);
}

function count_where($column, $value) {
$table = $this->get_table();
$this->db->where($column, $value);
$query=$this->db->get($table);
$num_rows = $query->num_rows();
return $num_rows;
}

function count_all() {
$table = $this->get_table();
$query=$this->db->get($table);
$num_rows = $query->num_rows();
return $num_rows;
}

function count_fridges($column, $value) {
$table = "m_facility_fridges";
$this->db->where($column, $value);
$query=$this->db->get($table);
$num_rows = $query->num_rows();
return $num_rows;
}

function get_max() {
$table = $this->get_table();
$this->db->select_max('id');
$query = $this->db->get($table);
$row=$query->row();
$id=$row->id;
return $id;
}

function _custom_query($mysql_query) {
$query = $this->db->query($mysql_query);
return $query;
}

}