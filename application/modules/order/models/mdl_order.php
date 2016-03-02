<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mdl_Order extends CI_Model {

function __construct() {
parent::__construct();
}

    // Get a list of orders placed to your station

    function get_placed_orders($station,$station_id,$limit, $offset = 0){
        $call_procedure="CALL get_placed_orders($station,'$station_id',$limit, $offset)";
        $query=$this->db->query($call_procedure);
        $query->next_result();
        return $query->result_array();
    }

    function count_placed_orders($station,$station_id){
        $call_procedure="CALL count_placed_orders($station,'$station_id')";
        $query=$this->db->query($call_procedure);
        $query->next_result();
        return $query->num_rows();
    }

    function get_last_order_details($station_id){
        $call_procedure="CALL last_order_details('$station_id')";
        $query=$this->db->query($call_procedure);
        $query->next_result();
        return $query->result_array();
    }

    // Get list of orders you have submitted
    function get_submitted_orders($station,$station_id){
        $call_procedure="CALL get_submitted_orders($station,'$station_id')";
        $query=$this->db->query($call_procedure);
        $query->next_result();
        return $query->result_array();
    }

        // Get list of all placed orders
    function get_all_placed_orders($station,$station_id,$limit, $offset = 0){
        $call_procedure="CALL get_all_placed_orders($station,'$station_id',$limit, $offset)";
        $query=$this->db->query($call_procedure);
        $query->next_result();
        return $query->result_array();
    }

    //  This function calculates the values of maxstock, minstock
    function calc_orders($station_id,$station_level){
        $call_procedure="CALL calc_orders('$station_id',$station_level)";
        $query=$this->db->query($call_procedure);
        $query->next_result();
        return $query->result_array();

    }

    function forward_orders($station_level,$order_id){
        $call_procedure="CALL forward_order('$station_level',$order_id)";
        $query=$this->db->query($call_procedure);
        return $query;
    }
// Get a list of items in an order 
function get_order_items($order_id,$order_by,$date_created){
    
        $this->db->select('CONCAT(mu.f_name," ",mu.l_name) as order_by,o.date_created as order_date,o.station_id,mv.Vaccine_name,oi.stock_on_hand, oi.min_stock, oi.max_stock,oi.first_expiry, oi.qty_order_doses as quantity_ordered',false);
        $this->db->from('m_order o');
        $this->db->join('m_users mu', 'mu.id=o.order_by', 'inner');
        $this->db->join('order_item oi', 'oi.order_id=o.order_id', 'inner');
        $this->db->join('m_vaccines mv ', 'mv.ID=oi.vaccine_id', 'inner');
	    $this->db->where(array('o.order_id' => $order_id,'o.order_by' => $order_by,'o.date_created'=>$date_created,'oi.qty_order_doses !='=>0));
        $query = $this->db->get();
        return $query->result_array();
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