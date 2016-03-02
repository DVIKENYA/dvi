<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Mdl_Depot extends CI_Model {
    var $order = array('id' => 'desc');
    var $column = array('id', 'depot_location','officer','officer_phone', 'station_id');
    var $fridge_columns = array('m_depot_fridges.id', 'Model', 'Manufacturer', 'temperature_monitor_no', 'main_power_source');
    var $depot_fridges = array('m_depot_fridges.id','m_depot_fridges.fridge_id', 'm_fridges.Model', 'm_fridges.Manufacturer', 'temperature_monitor_no', 'main_power_source', 'age', 'refrigerator_status');

    function __construct() {
        parent::__construct();
    }



    function get_table() {
        $table = "m_depot";
        return $table;
    }
    function get_depots($station_id,$option) {
        $this->_get_datatables_query($station_id,$option);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    private function _get_datatables_query($station_id,$option) {

        if($option==1){
            $this->db->select($this->column);
            $this->db->from($this->get_table());
            $this->db->where('station_id', $station_id);
        }elseif($option==2){
            $this->db->select($this->column);
            $this->db->from($this->get_table());
            $this->db->where('station_id !=', $station_id);
        }

        $i = 0;

        foreach($this->column as $item) {
           if ($_POST['search']['value'])
            //($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            if ($i === 0) {
                $this->db->like($item, $_POST['search']['value']) && $this->db->or_like($item, $_POST['search']['value']);
                $this->db->where('station_id', $station_id);
            }
            $column[$i] = $item;
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }


    function get_fridges_by_id($depot_id) {
        $this->_get_fridges_query($depot_id);
        if ($_POST['length'] != -1) $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtered($station_id,$option) {
        $this->_get_datatables_query($station_id,$option);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_fridges_query($depot_id) {
        $this->db->select($this->depot_fridges);
        $this->db->from('m_depot');
        $this->db->join('m_depot_fridges', 'm_depot_fridges.depot_id = m_depot.id');
        $this->db->join('m_fridges', 'm_depot_fridges.fridge_id = m_fridges.id');
        $this->db->where('m_depot.id', $depot_id);

        $i = 0;

        foreach($this->depot_fridges as $item) {
            if ($_POST['search']['value'])
            ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $depot_fridges[$i] = $item;
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($depot_fridges[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_fridges($id) {
        $this->db->from('m_depot_fridges');
        $this->db->where('m_depot_fridges.id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_fridge_model() {
        $this->db->select('id, Model, Manufacturer');
        $this->db->from('m_fridges');
        $query = $this->db->get();
        return $query->result();
    }


    function count_fridges_filtered($depot_id) {
        $this->_get_fridges_query($depot_id);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function get($order_by) {
        $table = $this->get_table();
        $this->db->order_by($order_by);
        $query = $this->db->get($table);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
        $table = $this->get_table();
        $this->db->limit($limit, $offset);
        $this->db->order_by($order_by);
        $query = $this->db->get($table);
        return $query;
    }

    function get_where($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('m_depot_fridges');
        return $query->result();
    }
    function get_depot($id){
        $table = $this->get_table();
        $this->db->where('id', $id);
        $query=$this->db->get($table);
        return $query;
    }
    function get_where_custom($col, $value) {
        $table = $this->get_table();
        $this->db->where($col, $value);
        $query = $this->db->get($table);
        return $query;
    }

    function _insert($data) {
        $table = $this->get_table();
        $this->db->insert($table, $data);
    }

    function _update($id, $data) {
        $table = $this->get_table();
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }

    function _delete($id) {
        $table = $this->get_table();
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

    function _insert_fridge($data) {
        $table = 'm_depot_fridges';
        $this->db->insert($table, $data);
    }

    function _update_fridge($id, $data) {
        $table = 'm_depot_fridges';
        $this->db->where('id', $id);
        $this->db->update($table, $data);
    }

    function _delete_fridge($id) {
        $table = 'm_depot_fridges';
        $this->db->where('id', $id);
        $this->db->delete($table);
    }

    function count_where($column, $value) {
        $table = $this->get_table();
        $this->db->where($column, $value);
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function count_all($station_id) {
        $table = $this->get_table();
        $this->db->where('station_id', $station_id);
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function count_fridges($depot_id) {
        $table = "m_depot_fridges";
        $this->db->where('depot_id', $depot_id);
        $query = $this->db->get($table);
        $num_rows = $query->num_rows();
        return $num_rows;
    }

    function get_max() {
        $table = $this->get_table();
        $this->db->select_max('id');
        $query = $this->db->get($table);
        $row = $query->row();
        $id = $row->id;
        return $id;
    }

    function _custom_query($mysql_query) {
        $query = $this->db->query($mysql_query);
        return $query;
    }

}