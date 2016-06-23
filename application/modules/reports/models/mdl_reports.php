<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_Reports extends CI_Model {

var $table = 'm_county';	
var $order = array('county_name' => 'desc');
var $column = array('county_name');

	function __construct() {
		parent::__construct();
	}


	function getRegion(){
		$this->db->select('id,county_name');
		$query = $this->db->get("m_county");
		return $query->result();
    }

	 private function _get_datatables_query()
    {
        //$this->db->from($this->table);
        $this->db->from('m_county');
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
 
    function getCounty()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

	function count_filtered(){
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}


}