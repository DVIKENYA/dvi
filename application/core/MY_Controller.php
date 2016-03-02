<?php

/**
 *
 */
class MY_Controller extends MX_Controller
{


    function __construct()
    {
        parent::__construct();

    }

    function getUserRegion()
    {
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result = $this->mdl_users->get_userRegion($user_id)->row();
        $data = $result->region_name;
        return $data;
    }

    function getUserRegionid()
    {
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result = $this->mdl_users->get_userRegion_id($user_id)->row();
        $data = $result->id;
        return $data;
    }

    function getUserCounty()
    {
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result = $this->mdl_users->get_userCounty($user_id)->row();
        $data = $result->county_name;
        return $data;
    }

    function getUserCountyid()
    {
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result = $this->mdl_users->get_userCounty_id($user_id)->row();
        $data = $result->id;
        return $data;
    }

    function getUserSubcounty()
    {
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result = $this->mdl_users->get_userSubcounty($user_id)->row();
        $data = $result->subcounty_name;
        return $data;
    }

    function getUserSubcountyid()
    {
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result = $this->mdl_users->get_userSubcounty_id($user_id)->row();
        $data = $result->id;
        return $data;
    }

    function getUserFacility()
    {
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result = $this->mdl_users->get_userFacility($user_id)->row();
        $data = $result->facility_name;
        return $data;
    }

    function getUserFacilityid()
    {
        $this->load->model('users/mdl_users');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result = $this->mdl_users->get_userFacility_id($user_id)->row();
        $data = $result->id;
        return $data;
    }

    function get_user_object()
    {
        if (isset($this->session->userdata['logged_in'])) {
            $user_fname = ($this->session->userdata['logged_in']['user_fname']);
            $user_lname = ($this->session->userdata['logged_in']['user_lname']);
            $user_group = ($this->session->userdata['logged_in']['user_group']);
            $user_level = ($this->session->userdata['logged_in']['user_level']);
            $user_id = ($this->session->userdata['logged_in']['user_id']);

            if ($user_level == '1') {
                $nation = "KENYA";
                $path = $nation;
                $user_statiton = $nation;
                $user_statiton_id = 'KENYA';
                $statiton_above = "";
            } else if ($user_level == '2') {
                $nation = "KENYA";
                $region = $this->getUserRegion();
                $region_id = $this->getUserRegionid();
                $path = $nation . " / " . $region;
                $user_statiton = $region;
                $user_statiton_id = $region_id;
                $statiton_above = $nation;
            } else if ($user_level == '3') {
                $nation = "KENYA";
                $region = $this->getUserRegion();
                $county = $this->getUserCounty();
                $county_id = $this->getUserCountyid();
                $path = $region . " / " . $county;
                $user_statiton = $county;
                $user_statiton_id = $county_id;
                $statiton_above = $region;
            } else if ($user_level == '4') {
                $nation = "KENYA";
                $region = $this->getUserRegion();
                $county = $this->getUserCounty();
                $subcounty = $this->getUserSubcounty();
                $subcounty_id = $this->getUserSubcountyid();
                $path = $county . " / " . $subcounty;
                $user_statiton = $subcounty;
                $user_statiton_id = $subcounty_id;
                $statiton_above = $county;
            } else {
                $nation = "KENYA";
                $region = $this->getUserRegion();
                $county = $this->getUserCounty();
                $subcounty = $this->getUserSubcounty();
                $facility = $this->getUserFacility();
                $facility_id = $this->getUserFacilityid();
                $path = $subcounty . " / " . $facility;
                $user_statiton = $facility;
                $user_statiton_id = $facility_id;
                $statiton_above = $subcounty;
            }
            $data = array(
                'user_fname' => $user_fname,
                'user_lname' => $user_lname,
                'user_group' => $user_group,
                'user_level' => $user_level,
                'user_id' => $user_id,
                'user_statiton' => $user_statiton,
                'user_statiton_id' => $user_statiton_id,
                'statiton_above' => $statiton_above,
                'path' => $path
            );
            return $data;

        } else {
            header("location: users");
        }
    }


    function redirect($user_group)
    {
        if ($user_group == '1') {
            $module = 'admin';
        } else if ($user_group == '2') {
            $module = 'member';
        } else if ($user_group == '3') {
            $module = 'epi';
        } else if ($user_group == '4') {
            $module = 'hrio';
        } else if ($user_group == '5') {
            $module = 'moh';
        } else if ($user_group == '6') {
            $module = 'phn';
        } else if ($user_group == '7') {
            $module = 'met';
        } else {
            exit('Permission denied');
        }

        return $module;
    }

    function get_title()
    {

        $title = 'NVIP Chanjo';
        return $title;
    }

    function get_notification_count()
    {
        $this->load->model('notifications/mdl_notifications');
        $user_id = ($this->session->userdata['logged_in']['user_id']);
        $result = $this->mdl_notifications->getNotificationCount();
        return $result;


    }

}