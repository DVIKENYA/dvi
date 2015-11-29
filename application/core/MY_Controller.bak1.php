<?php
/**
* 
*/
class MY_Controller extends MX_Controller
{
	

	function __construct() {
		parent::__construct();

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




	function get_user_object()
	{
		if (isset($this->session->userdata['logged_in'])) {
			$user_fname = ($this->session->userdata['logged_in']['user_fname']);
			$user_group = ($this->session->userdata['logged_in']['user_group']);
			$user_level = ($this->session->userdata['logged_in']['user_level']);
			$user_id = ($this->session->userdata['logged_in']['user_id']);

			if ($user_level=='1') {
			    $nation = "KENYA";
			    $path = $nation;
			    $user_statiton = $nation;
			} else if ($user_level=='2') {
			    $nation = "KENYA";
			    $region = $this->getUserRegion();
			    $path = $nation." / ". $region;
			    $user_statiton = $region;
			} else if ($user_level=='3'){
			    $nation = "KENYA";
			    $region = $this->getUserRegion();
			    // $county = Modules::run('template/getUserCounty');
			    $county = $this->getUserCounty();
			    $path = $region." / ". $county;
				$user_statiton = $county;

			}else if ($user_level=='4'){
			    $nation = "KENYA";
			    $region = $this->getUserRegion();
			    $county = $this->getUserCounty();
			    $subcounty = $this->getUserSubcounty();
			    $path = $county." / ". $subcounty;
				$user_statiton = $subcounty;
			}
			else {
			    $nation = "KENYA";
			    $region = $this->getUserRegion();
			    $county = $this->getUserCounty();
			    $subcounty = $this->getUserSubcounty();
			    $facility = $this->getUserFacility();
			    $path = $subcounty." / ". $facility;
				$user_statiton = $facility;    
			}
			$data = array('user_fname' =>$user_fname ,
						'user_group' =>$user_group ,
						'user_level' =>$user_level ,
						'user_id' =>$user_id ,
						'user_statiton' =>$user_statiton ,
						'path' =>$path  );
			return $data;

		} else {
			header("location: users");
		}
	}



	function redirect($user_group)
	{
		if ($user_group=='1') {
			$module = 'admin';
		}else if ($user_group=='2') {
			$module = 'member'; 
		}else if ($user_group=='3') {
			$module = 'epi';
		}else if ($user_group=='4') {
			$module = 'hrio';
		}else if ($user_group=='5') {
			$module = 'moh';
		}else if ($user_group=='6') {
			$module = 'phn';
		}else {
			$module = 'met';
		}

		return $module;
	}

	function get_title() {

		$title = 'DVI KENYA';
		return $title;
	}

}