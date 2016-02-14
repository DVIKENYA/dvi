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


    function get_stock_balance($station_id){
        $this->db->distinct();
        $sum = ('if(sum(ms.stock_balance) > 0,sum(ms.stock_balance),false) as stock_balance');
        $this->db->select('mv.Vaccine_name,'.$sum,false);
        $this->db->from('m_stock_balance ms');
        $this->db->join('m_vaccines mv ', 'mv.ID=ms.vaccine_id', 'inner');
        $array = array('ms.station_id' => $station_id);
        $this->db->where($array);
        $this->db->group_by('ms.vaccine_id, ms.station_id');
        $query = $this->db->get();
        return $query;
    }


function get_months_stock($user_id){
    $this->db->distinct();
    $this->db->select('BCG,DPT,MEASLES,ROTA,PCV,OPV');
    $this->db->group_by('user_id');
    $this->db->where("user_id", $user_id);
    $query = $this->db->get('prov_mofstock');

    return $query;
}



function initWastage(){
    $this->db->select('Vaccine_name,Wastage_factor');
    $this->db->group_by('Vaccine_name');
    $query = $this->db->get('initial_wastage');
    return $query;
}


function get_linechart()
{

 $this->db->select('`Vaccine` AS Vaccine, `Stock_Balance` AS Stock_balance');
 //$v = array('Vaccine' => $vaccine);
 // $u = array('user_id' => $user_id);
 //$this->db->where($v);
 // $this->db->where($u);
 $query = $this->db->get('vaccine_stockbalance');
 return $query->result();

}

// Get listof orders you have submitted 
    function get_minmax_stock($station,$station_id){
        $call_procedure="CALL test($station,'$station_id')";
        $query=$this->db->query($call_procedure);
        $query->next_result();
        return $query->result_array();
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


function get_region_base(){
        $this->db->select('id, region_name as location');
        $query=$this->db->get('m_region');
        return $query->result();
    }

function get_facility_wastage($id){

        $this->db->select('BCG,DPT,MEASLES,OPV,PCV,YELLOWFEVER, m_facility.id, facility_name');
        $this->db->from('final_wastage');
        $this->db->join('m_facility', 'm_facility.id = final_wastage.facility');
        $this->db->join('user_base',' user_base.facility=final_wastage.facility');
        $this->db->where('user_id',$id);
        $query = $this->db->get();

        return $query->result();
    }
function get_county_wastage($id){

        $this->db->select('BCG,DPT,MEASLES,OPV,PCV,YELLOWFEVER, m_county.id, county_name');
        $this->db->from('final_wastage');
        $this->db->join('m_county', 'm_county.id = final_wastage.county');
        $this->db->join('user_base',' user_base.county=final_wastage.county');
        $this->db->where('user_id',$id);
        $query = $this->db->get();

        return $query->result();
    }

function get_subcounty_wastage($id){

        $this->db->select('BCG,DPT,MEASLES,OPV,PCV,YELLOWFEVER, m_subcounty.id, subcounty_name');
        $this->db->from('final_wastage');
        $this->db->join('m_subcounty', 'm_subcounty.id = final_wastage.subcounty');
        $this->db->join('user_base',' user_base.subcounty=final_wastage.subcounty');
        $this->db->where('user_id',$id);
        $query = $this->db->get();

        return $query->result();
    }

 function get_national_wastage($id){

        $this->db->select('BCG,DPT,MEASLES,OPV,PCV,YELLOWFEVER');
        $this->db->from('final_wastage');
        $query = $this->db->get();

        return $query->result();
    }   


function get_subcounty_coverage($id){

        $this->db->select('`periodname` AS Months, BCG,DPT2,DPT3,MEASLES,OPV,OPV1,OPV2,OPV3,PCV1,PCV2,PCV3,ROTA1,ROTA2,m_subcounty.id, subcounty_name');
        $this->db->from('view_subcountycov_calculated');
        $this->db->join('m_subcounty', 'm_subcounty.id = view_subcountycov_calculated.subcounty_id');
        $this->db->join('user_base',' user_base.subcounty=view_subcountycov_calculated.subcounty_id');
        $this->db->where('user_id',$id);
        $this->db->group_by('periodname');
        $query = $this->db->get();
        
        return $query;
    }

function get_county_coverage($id){

        $this->db->select('`periodname` AS Months, BCG,DPT2,DPT3,MEASLES,OPV,OPV1,OPV2,OPV3,PCV1,PCV2,PCV3,ROTA1,ROTA2, m_county.id, county_name');
        $this->db->from('view_countycov_calculated');
        $this->db->join('m_county', 'm_county.id = view_countycov_calculated.county_id');
        $this->db->join('user_base',' view_countycov_calculated.county_id');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        
        return $query;
        
    }

function get_national_coverage($id){

        $this->db->distinct();
        $this->db->select('`periodname` AS Months, BCG,DPT2,DPT3,MEASLES,OPV,OPV1,OPV2,OPV3,PCV1,PCV2,PCV3,ROTA1,ROTA2');
        $this->db->from('view_subcountycov_calculated');
        $query = $this->db->get();
        
        return $query;
        
    }

function get_county_dpt3(){

    $this->db->select('county_name,totaldpt3');
    $query = $this->db->get('county_dpt3_cov',3);

    return $query;
}

function get_subcounty_dpt3(){

    $this->db->select('subcounty_name,totaldpt3');
    $query = $this->db->get('subcounty_dpt3_cov',3);

    return $query;
}

function get_facility_dpt3(){

$this->db->select('facility_name,totaldpt3');
$this->db->where('totaldpt3 > 0');
$query = $this->db->get('facility_dpt3_cov',3);

return $query;

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