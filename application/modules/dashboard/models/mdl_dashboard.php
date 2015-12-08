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



/*function get_Coverage(){
    $query = $this->db->query("SELECT `periodname` AS Months, `totalbcg` , `totaldpt2` , `totaldpt3` , `totalmeasles` , `totalopv` ,`totalopv1`,`totalopv2`,`totalopv3`,`totalpcv1`,`totalpcv2`, `totalpcv3`,`totalrota1`,`totalrota2` FROM `subcounty_coverage`");
    return $query;
    }*/




function get_region_base(){
        $this->db->select('id, region_name as location');
        $query=$this->db->get('m_region');
        return $query->result();
    }

function get_facility_wastage($id){
        $this->db->select('sum( BCG ) AS totalbcg, sum( DPT ) AS totaldpt, sum( MEASLES ) AS totalmeasles,
         sum( OPV ) AS totalopv, sum( PCV ) AS totalpcv, sum( YELLOWFEVER ) AS totalyellowfev, m_facility.id, facility_name');
        $this->db->from('new_wastage');
        $this->db->join('m_facility', 'm_facility.id = new_wastage.facility');
        $this->db->join('user_base',' user_base.facility=new_wastage.facility');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        return $query->result();
    }
function get_county_wastage($id){
        $this->db->select('sum( BCG ) AS totalbcg, sum( DPT ) AS totaldpt, sum( MEASLES ) AS totalmeasles,
         sum( OPV ) AS totalopv, sum( PCV ) AS totalpcv,sum( YELLOWFEVER ) AS totalyellowfev, m_county.id, county_name');
        $this->db->from('new_wastage');
        $this->db->join('m_county', 'm_county.id = new_wastage.county');
        $this->db->join('user_base',' user_base.county=new_wastage.county');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

function get_subcounty_wastage($id){
        $this->db->select('sum(BCG) AS totalbcg, sum(DPT) AS totaldpt, sum(MEASLES) AS totalmeasles,
                           sum(OPV) AS totalopv, sum(PCV) AS totalpcv,
                           sum(YELLOWFEVER) AS totalyellowfev, m_subcounty.id, subcounty_name');
        $this->db->from('new_wastage');
        $this->db->join('m_subcounty', 'm_subcounty.id = new_wastage.subcounty');
        $this->db->join('user_base',' user_base.subcounty=new_wastage.subcounty');
        $this->db->where('user_id',$id);
        $query = $this->db->get();
        return $query->result();
    }

 function get_national_wastage($id){
        $this->db->select('sum(BCG) AS totalbcg, sum(DPT) AS totaldpt, sum(MEASLES) AS totalmeasles,
                           sum(OPV) AS totalopv, sum(PCV) AS totalpcv,
                           sum(YELLOWFEVER) AS totalyellowfev');
        $this->db->from('new_wastage');
        $query = $this->db->get();
        return $query->result();
    }   


function get_subcounty_coverage($id){
        $this->db->select('`periodname` AS Months, `totalbcg` , `totaldpt2` , 
            `totaldpt3` , `totalmeasles` , `totalopv` ,`totalopv1`,`totalopv2`,
            `totalopv3`,`totalpcv1`,`totalpcv2`, `totalpcv3`,`totalrota1`,`totalrota2`,m_subcounty.id, subcounty_name');
        $this->db->from('view_subcountycov_calculated');
        $this->db->join('m_subcounty', 'm_subcounty.id = view_subcountycov_calculated.subcounty_id');
        $this->db->join('user_base',' user_base.subcounty=view_subcountycov_calculated.subcounty_id');
        $this->db->where('user_id',$id);
        $this->db->group_by('periodname');
        $query = $this->db->get();
        return $query->result();
    }

function get_county_coverage($id){
        $this->db->distinct();
        $this->db->select('`periodname` AS Months, sum(totalbcg) as totalbcg, sum(totaldpt2) as totaldpt2, sum(totaldpt3) as totaldpt3, 
                           sum(totalmeasles) as totalmeasles, sum(totalopv) as totalopv, sum(totalopv1) as totalopv1, 
                           sum(totalopv2) as totalopv2,  sum(totalopv3) as totalopv3,  sum(totalpcv1) as totalpcv1,
                           sum(totalpcv2) as totalpcv2,  sum(totalpcv3) as totalpcv3,  sum(totalrota1) as totalrota1,
                           sum(totalrota2) as totalrota2, m_county.id, county_name');
        $this->db->from('view_subcountycov_calculated');
        $this->db->join('m_county', 'm_county.id = view_subcountycov_calculated.county_id');
        $this->db->join('user_base',' view_subcountycov_calculated.county_id');
        $this->db->where('user_id',$id);
        $this->db->group_by('periodname');
        $query = $this->db->get();
        return $query->result();
        
    }
function get_national_coverage($id){
        $this->db->distinct();
        $this->db->select('`periodname` AS Months, sum(totalbcg) as totalbcg, sum(totaldpt2) as totaldpt2, sum(totaldpt3) as totaldpt3, 
                           sum(totalmeasles) as totalmeasles, sum(totalopv) as totalopv, sum(totalopv1) as totalopv1, 
                           sum(totalopv2) as totalopv2,  sum(totalopv3) as totalopv3,  sum(totalpcv1) as totalpcv1,
                           sum(totalpcv2) as totalpcv2,  sum(totalpcv3) as totalpcv3,  sum(totalrota1) as totalrota1,
                           sum(totalrota2) as totalrota2');
        $this->db->from('view_subcountycov_calculated');
        $this->db->group_by('periodname');
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