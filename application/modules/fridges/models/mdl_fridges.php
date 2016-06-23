<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mdl_fridges extends CI_Model {

function __construct() {
parent::__construct();
}

function get_table() {
$table = "m_fridges";
return $table;

}
function getModel()
{
	    $this->db->select('id, Model');
		$query = $this->db->get("m_fridges");

		return $query->result();
}
function get_fridge_details(){
	    $this->db->select('id,Model,Manufacturer');
		$this->db->join('m_mfridge', 'm_fridges.id = m_mfridge.model');
            $query = $this->db->get();
            return $query->result_array();
	}
function get_all($id){
    $this->db->select('*');
    $this->db->from('m_facility');
    $this->db->where('region_id', $id);
    $this->db->join('m_region', 'm_region.region_name = m_facility.region_id');
    $query = $this->db->get();
    return $query->result_array();
}

function get($order_by){
$table = $this->get_table();
$this->db->order_by($order_by);
$query=$this->db->get($table);
return $query;
}

function getn($order_by){
$table = $this->get_table();
$this->db->order_by($order_by);
$query=$this->db->get($table);
$num_rows = $query->num_rows();
return $num_rows;
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