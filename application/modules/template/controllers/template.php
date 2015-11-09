<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template extends MX_Controller {

	 function home($data){
            $this->load->view('home_view', $data);
    }
    function admin($data){
       $this->load->view('admin_view',$data);
    }	
    function epi($data){
       // Modules::run('secure_tings/ni_admin');
        $this->load->view('epi_view',$data);
    }

    function phn($data){
       // Modules::run('secure_tings/ni_admin');
        $this->load->view('phn_view',$data);
    }

    function hrio($data){
       // Modules::run('secure_tings/ni_admin');
        $this->load->view('hrio_view',$data);
    }

    function member($data){
       // Modules::run('secure_tings/ni_admin');
        $this->load->view('member_view',$data);
    }
    function moh($data){
       // Modules::run('secure_tings/ni_admin');
        $this->load->view('moh_view',$data);
    }
	
	function getUserRegion(){
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result=$this->mdl_users->get_userRegion($user_id)->row();
        $data = $result->region_name;        
       return $data;      
    }
    
    function getUserCounty(){
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result=$this->mdl_users->get_userCounty($user_id)->row();
        $data = $result->county_name;        
       return $data;      
    }

    function getUserSubcounty(){
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result=$this->mdl_users->get_userSubcounty($user_id)->row();
        $data = $result->subcounty_name;        
       return $data;      
    }

    function getUserFacility(){
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result=$this->mdl_users->get_userFacility($user_id)->row();
        $data = $result->facility_name;        
       return $data;      
    }
}

