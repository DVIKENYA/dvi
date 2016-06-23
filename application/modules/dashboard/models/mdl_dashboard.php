<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Mdl_dashboard extends CI_Model
{
    var $order = array('id' => 'desc');
    var $column = array('Months', 'Above2yrs', 'Above1yr');


    function __construct()
    {
        parent::__construct();
    }


    function vaccine(){
        $this->db->select('Vaccine_name');
        $query = $this->db->get('m_vaccines');
        return $query->result();
    }

    function get_stock_balance($station_id)
    {
        $this->db->select('vaccine_name, sum(stock_balance) as stock_balance');
        $this->db->from('vaccine_stockbalance');
        $array = array('station_id' => $station_id);
        $this->db->where($array);
        $this->db->group_by('vaccine_name,station_id');
        $query = $this->db->get();
        return $query;
    }

    function get_stock_balance_where($station_id, $vaccine)
    {
        $this->db->select('vaccine_name, stock_balance');
        $this->db->from('vaccine_stockbalance');
        $array = array('station_id' => $station_id, 'vaccine_name' => $vaccine);
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result();
    }

    function get_doses_administered_where($user_level, $station_id, $vaccine)
    {
        $this->db->select(''.$vaccine.'');
        if ($user_level == 1) {
            $this->db->from('county_doses_administered');
        } elseif ($user_level == 2) {
            $this->db->from('county_doses_administered');
        } elseif($user_level == 3) {
            $this->db->from('county_doses_administered');
        } elseif ($user_level == 4) {
            $this->db->from('subcounty_doses_administered');
        }elseif ($user_level == 5) {
            $this->db->from('facility_doses_administered');
        }
        $array = array('station_id' => $station_id);
        $this->db->where($array);
        $query = $this->db->get();
        return $query->result();
    }






    function get_subcounty_coverage($id)
    {

        $this->db->select('`periodname` AS Months, BCG,DPT2,DPT3,MEASLES,OPV,OPV1,OPV2,OPV3,PCV1,PCV2,PCV3,ROTA1,ROTA2,m_subcounty.id, subcounty_name');
        $this->db->from('view_subcountycov_calculated');
        $this->db->join('m_subcounty', 'm_subcounty.id = view_subcountycov_calculated.subcounty_id');
        $this->db->where('subcounty_name', $id);
        $this->db->group_by('periodname');
        $query = $this->db->get();

        return $query;
    }

    function get_county_coverage($id)
    {

        $this->db->select('`periodname` AS Months, BCG,DPT2,DPT3,MEASLES,OPV,OPV1,OPV2,OPV3,PCV1,PCV2,PCV3,ROTA1,ROTA2, m_county.id, county_name');
        $this->db->from('view_countycov_calculated');
        $this->db->join('m_county', 'm_county.id = view_countycov_calculated.county_id');
        $this->db->where('county_name', $id);
        $query = $this->db->get();

        return $query;

    }

    function get_national_coverage()
    {

        $this->db->distinct();
        $this->db->select('`periodname` AS Months, BCG,DPT2,DPT3,MEASLES,OPV,OPV1,OPV2,OPV3,PCV1,PCV2,PCV3,ROTA1,ROTA2');
        $this->db->from('view_subcountycov_calculated');
        $query = $this->db->get();

        return $query;

    }

    function best_county_dpt3($station_id)
    {
        $this->db->select('county_name,totaldpt3');
        $this->db->where('region_name', $station_id);
        $this->db->order_by('totaldpt3', 'desc');
        $this->db->limit(3);
        $query = $this->db->get('county_dpt3_cov');

        return $query;
    }

    function worst_county_dpt3($station_id)
    {
        $this->db->select('county_name,totaldpt3');
        $this->db->where('region_name', $station_id);
        $this->db->order_by('totaldpt3', 'asc');
        $this->db->limit(3);
        $query = $this->db->get('county_dpt3_cov');

        return $query;
    }

    function best_subcounty_dpt3($station_id)
    {
        $this->db->select('subcounty_name,totaldpt3');
        $this->db->where('county_name', $station_id);
        $this->db->order_by('totaldpt3', 'desc');
        $this->db->limit(3);
        $query = $this->db->get('subcounty_dpt3_cov');

        return $query;
    }

    function worst_subcounty_dpt3($station_id)
    {
        $this->db->select('subcounty_name,totaldpt3');
        $this->db->where('county_name', $station_id);
        $this->db->order_by('totaldpt3', 'asc');
        $this->db->limit(3);
        $query = $this->db->get('subcounty_dpt3_cov');

        return $query;
    }


    function best_facility_dpt3($station_id)
    {
        $this->db->select('facility_name,totaldpt3');
        $this->db->where('totaldpt3 > 0');
        $this->db->where('subcounty_name', $station_id);
        $this->db->order_by('totaldpt3', 'desc');
        $this->db->limit(3);
        $query = $this->db->get('facility_dpt3_cov');

        return $query;
    }

    function worst_facility_dpt3($station_id)
    {
        $this->db->select('facility_name,totaldpt3');
        $this->db->where('totaldpt3 > 0');
        $this->db->where('subcounty_name', $station_id);
        $this->db->order_by('totaldpt3', 'asc');
        $this->db->limit(3);
        $query = $this->db->get('facility_dpt3_cov');;

        return $query;
    }


}