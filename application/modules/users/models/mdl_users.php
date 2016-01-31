<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Mdl_users extends CI_Model {

            function __construct() {
                parent::__construct();
            }

            function get_table() {
                $table = "m_users";
                return $table;
            }

        // Read data using username and password
            function login($data) {
                $table = $this->get_table();
                $condition = "username =" . "'" . $data['username'] . "' AND " . "password =" . "'" . $data['password'] . "'";
                $this->db->select('*');
                $this->db->from($table);
                $this->db->where($condition);
                $this->db->limit(1);
                $query = $this->db->get();

                if ($query->num_rows() == 1) {
                    return true;
                } else {
                    return false;
                }
            }

        // Read user information from database 
            function fetch_user_information($username) {
                $table = $this->get_table();
                $condition = "username =" . "'" . $username . "'";
                $this->db->select('*');
                $this->db->from($table);
                $this->db->where($condition);
                $this->db->limit(1);
                $query = $this->db->get();

                if ($query->num_rows() == 1) {
                    return $query->result();
                } else {
                    return false;
                }
            }

            function password_check($username, $password) {
                $table = $this->get_table();
                $this->db->where('username', $username);
                $this->db->where('password', $password);
                $query=$this->db->get($table);
                $num_rows = $query->num_rows();

                if($num_rows>0){
                  return TRUE;
              } else {
                  return FALSE;
              }
              return $num_rows;
          }

          function getRegion(){
        	//$condition = "username =" . "'" . $username . "'";
              $this->db->select('id,region_name');
              $query = $this->db->get("m_region");
              return $query->result();
          }

          function get_counties(){

            $this->db->select('id,county_name');
            $query = $this->db->get('m_county');
            return $query->result();
        }
        function get_subcounty(){

            $this->db->select('id,subcounty_name');
            $query = $this->db->get('m_subcounty');
            return $query->result();
        }
        function get_facilities(){

            $this->db->select('id,facility_name');
            $query = $this->db->get('m_facility');
            return $query->result();
        }

        function get_user_groups(){

            $this->db->select('id,name');
            $query = $this->db->get('m_group');
            return $query->result();
        }

        function get_user_levels(){

            $this->db->select('id,name');
            $query = $this->db->get('user_levels');
            return $query->result();
        }

        function get_userRegion_id($user_id){

            $this->db->select('id');
            $this->db->from('region_userbase_view');
            $this->db->where('user_id',$user_id);
            return $this->db->get();

        }

        function get_userRegion($user_id){

            $this->db->select('region_name');
            $this->db->from('region_userbase_view');
            $this->db->where('user_id',$user_id);
            return $this->db->get();

        }

         function get_userCounty_id($user_id){

            $this->db->select('id');
            $this->db->from('county_userbase_view');
            $this->db->where('user_id',$user_id);
            return $this->db->get();

        }


        function get_userCounty($user_id){

            $this->db->select('county_name');
            $this->db->from('county_userbase_view');
            $this->db->where('user_id',$user_id);
            return $this->db->get();

        }

         function get_userSubcounty_id($user_id){

            $this->db->select('id');
            $this->db->from('subcounty_userbase');
            $this->db->where('user_id',$user_id);
            return $this->db->get();

        }

        function get_userSubcounty($user_id){

            $this->db->select('subcounty_name');
            $this->db->from('subcounty_userbase');
            $this->db->where('user_id',$user_id);
            return $this->db->get();

        }

        function get_userFacility_id($user_id){

            $this->db->select('id');
            $this->db->from('facility_userbase_view');
            $this->db->where('user_id',$user_id);
            return $this->db->get();

        }
        function get_userFacility($user_id){

            $this->db->select('facility_name');
            $this->db->from('facility_userbase_view');
            $this->db->where('user_id',$user_id);
            return $this->db->get();

        }

        function loadcountyfromregion($region_id) {

            $query = $this->db->query("SELECT county_name FROM `m_county` WHERE region_id = '{$region_id}'"); 
            if ($query->num_rows > 0) {
                return $query->result();
            }
        }

        function loadsubcountyfromcounty($county_id) {

            $query = $this->db->query("SELECT subcounty_name FROM `m_subcounty` WHERE county_id = '{$county_id}'"); 
            if ($query->num_rows > 0) {
                return $query->result();
            }
        }


        function loadfacilityfromsubcouty($subcounty_id) {

            $query = $this->db->query("SELECT facility_name FROM `m_facility` WHERE `subcounty_id` = '{$subcounty_id}'"); 
            if ($query->num_rows > 0) {
                return $query->result();
            }
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


        function _insert($data, $data_base) {
        	$table = $this->get_table();
        	// Query to check whether username already exist or not
            $condition = "username =" . "'" . $data['username'] . "'";
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($condition);
            $this->db->limit(1);
            $query = $this->db->get();
            if ($query->num_rows() == 0) {

        // Query to insert data in database
                $this->db->insert($table, $data);
                $data_base['user_id'] = $this->db->insert_id();
                $this->db->insert('user_base', $data_base);
                if ($this->db->affected_rows() > 0) {
                    return true;
                }
            } else {
                return false;
            }
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

        function getCountyByRegion($id){
            $this->db->select("id, county_name");
            $this->db->from('m_county');
            $this->db->where('region_id', $id);
            $query = $this->db->get();
            return $query->result();
        }
        function getSubcountyByCounty($id){
            $this->db->select("id, subcounty_name");
            $this->db->from('m_subcounty');
            $this->db->where('county_id', $id);
            $query = $this->db->get();
            return $query->result();
        }

        function getFacilityBySubcounty($id){
            $this->db->select("id, facility_name");
            $this->db->from('m_facility');
            $this->db->where('subcounty_id', $id);
            $query = $this->db->get();
            return $query->result();
        }
        }