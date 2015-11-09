<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mdl_dashboard extends CI_Model {
var $order = array('id' => 'desc');
var $column = array('Months', 'Above2yrs', 'Above1yr');


function __construct() {
parent::__construct();
}

function get_table() {
    $table = "children_immunized";
    return $table;
}

private function _get_datatables_query(){
$this->db->from($this->get_table());
$this->search_order();
}

function getDataTable(){
$this->_get_datatables_query();
if($_POST['length'] != -1)
$this->db->limit($_POST['length'], $_POST['start']);
$query = $this->db->get();
return $query->result();
}

function search_order()
{   
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

function count_filtered(){
$this->_get_datatables_query();
$query = $this->db->get();
return $query->num_rows();
}

function count_all() {
$table = $this->get_table();
$query=$this->db->get($table);
$num_rows = $query->num_rows();
return $num_rows;
}

function getChart($user_id)
{
    $this->db->distinct();
    $this->db->select('Vaccine, SUM(`Stock_Balance`) AS Stock_balance');
    $this->db->group_by('Vaccine');
    $this->db->where("user_id", $user_id);
    $query = $this->db->get('vaccine_stockbalance');
    return $query;

}
function getLineChart($vaccine, $user_id)
{

 $this->db->select('`Vaccine` AS Vaccine, `Stock_Balance` AS Stock_balance');
 $v = array('Vaccine' => $vaccine);
 $u = array('user_id' => $user_id);
 $this->db->where($v);
 $this->db->where($u);
 $query = $this->db->get('vaccine_stockbalance');
 return $query->result();

}

function getData()
{
$query = $this->db->query("SELECT Months, Above2yrs, Above1yr FROM children_immunized");

return $query->result();

}
function get_vaccine_details(){
        $this->db->select('ID,Vaccine_name');
        $query = $this->db->get('m_vaccines');
        return $query;
    }

function getCoverage(){
    $query = $this->db->query("SELECT `periodname` AS Months, `BCG` , `DPT1` , `PCV1` , `OPV` , `ROTA` ,`Measles` FROM `total_doses_adm`");
    
    return $query;
    }

function mofstock(){
    $query = $this->db->query("SELECT sum( bcgdoseadm ) AS totalbcg,sum( opv1dosesadm ) AS totalopv1, sum( pneumococal1adm ) AS totalpneumococal1, sum( rotavirus1dosesadministered ) AS totalrotavirus1
FROM dhis_usage;");
    return $query;
}

function getMonths(){
$query = $this->db->query("SELECT DISTINCT periodname AS months from dhis_usage");
 return $query;

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