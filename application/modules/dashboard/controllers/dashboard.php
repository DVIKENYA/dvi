<?php

class Dashboard extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        Modules::run('secure_tings/is_logged_in');

    }


    function index()
    {
        Modules::run('secure_tings/is_logged_in');


        $info['user_object'] = $this->get_user_object();
        $station_id = $info['user_object']['user_statiton'];
        $user_level = $info['user_object']['user_level'];

       if ($user_level == '1' || $user_level == '2') {
           $data['best'] = $this->best_county_dpt3cov($station_id);
           $data['worst'] = $this->worst_county_dpt3cov($station_id);
       } elseif ($user_level == '3') {
           $data['best'] = $this->best_subcounty_dpt3cov($station_id);
           $data['worst'] = $this->worst_subcounty_dpt3cov($station_id);
       } elseif ($user_level == '4') {
           $data['best'] = $this->best_facility_dpt3cov($station_id);
           $data['worst'] = $this->worst_facility_dpt3cov($station_id);
       }


        $data['section'] = "NVIP-Chanjo";
        $data['subtitle'] = "Dashboard";
        if ($user_level !== '1') {
            $data['view_file'] = "dashboard_view";
        } else if ($user_level == '1') {
            $data['view_file'] = "national_dashboard_view";
        } else if ($user_level == '5') {
            $data['view_file'] = "facility_dashboard_view";
        }

        $data['module'] = "dashboard";
        $data['id'] = ($this->session->userdata['logged_in']['user_id']);
        $data['user_level'] = $user_level;
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        $data['breadcrumb'] = '';
        //
//        $this->output->enable_profiler();
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);

    }


   function get_chart()
   {
       $info['user_object'] = $this->get_user_object();
       $station_id = $info['user_object']['user_statiton'];
       $this->load->model('mdl_dashboard');
       $query = $this->mdl_dashboard->get_stock_balance($station_id);
       //    var_dump($query);
       $json_array = array();
       foreach ($query->result() as $row) {
           $data['name'] = $row->vaccine_name;
           $data['y'] = (float)$row->stock_balance;

           array_push($json_array, $data);
       }
       echo json_encode($json_array);
   }


   function get_coverage()
   {
       $this->load->model('mdl_dashboard');
       $info['user_object'] = $this->get_user_object();
       $station_id = $info['user_object']['user_statiton'];
       $user_level = $info['user_object']['user_level'];
       if ($user_level == '3' || $user_level == '2') {
           $query = $this->mdl_dashboard->get_county_coverage($station_id);
       } else if ($user_level == '4') {
           $query = $this->mdl_dashboard->get_subcounty_coverage($station_id);
       } else if ($user_level == '5') {
           $query = $this->mdl_dashboard->get_subcounty_coverage($station_id);
       } else if ($user_level == '1') {
           $query = $this->mdl_dashboard->get_national_coverage();
       }
       $json_array = array();
       foreach ($query->result() as $row) {
           $data['name'] = $row->Months;
           $data['y'] = (int)$row->BCG;

           array_push($json_array, $data);

       }
       echo json_encode($json_array);
       //
   }

    function best_county_dpt3cov($station_id)
    {
        $this->load->model('mdl_dashboard');


        $query = $this->mdl_dashboard->best_county_dpt3($station_id);

        $json_array = array();
        foreach ($query->result() as $row) {
            $data['county_name'] = $row->county_name;
            $data['totaldpt3'] = (int)$row->totaldpt3;

            array_push($json_array, $data);

        }
        //echo json_encode($json_array);
        return $json_array;

    }

    function worst_county_dpt3cov($station_id)
    {
        $this->load->model('mdl_dashboard');


        $query = $this->mdl_dashboard->best_county_dpt3($station_id);

        $json_array = array();
        foreach ($query->result() as $row) {
            $data['county_name'] = $row->county_name;
            $data['totaldpt3'] = (int)$row->totaldpt3;

            array_push($json_array, $data);

        }
        //echo json_encode($json_array);
        return $json_array;

    }

    function best_subcounty_dpt3cov($station_id)
    {

        $this->load->model('mdl_dashboard');

        $query = $this->mdl_dashboard->best_subcounty_dpt3($station_id);

        $json_array = array();
        foreach ($query->result() as $row) {
            $data['totaldpt3'] = (int)$row->totaldpt3;
            $data['subcounty_name'] = $row->subcounty_name;


            array_push($json_array, $data);

        }
//        echo json_encode($json_array);
        return $json_array;

    }

    function worst_subcounty_dpt3cov($station_id)
    {

        $this->load->model('mdl_dashboard');

        $query = $this->mdl_dashboard->worst_subcounty_dpt3($station_id);

        $json_array = array();
        foreach ($query->result() as $row) {
            $data['totaldpt3'] = (int)$row->totaldpt3;
            $data['subcounty_name'] = $row->subcounty_name;


            array_push($json_array, $data);

        }
//        echo json_encode($json_array);
        return $json_array;

    }
    function best_facility_dpt3cov($station_id)
    {


        $this->load->model('mdl_dashboard');

        $query = $this->mdl_dashboard->best_facility_dpt3($station_id);

        $json_array = array();
        foreach ($query->result() as $row) {
            $data['totaldpt3'] = (int)$row->totaldpt3;
            $data['facility_name'] = $row->facility_name;


            array_push($json_array, $data);

        }
//        echo json_encode($json_array);
        return $json_array;


    }

    function worst_facility_dpt3cov($station_id)
    {


        $this->load->model('mdl_dashboard');

        $query = $this->mdl_dashboard->worst_facility_dpt3($station_id);

        $json_array = array();
        foreach ($query->result() as $row) {
            $data['totaldpt3'] = (int)$row->totaldpt3;
            $data['facility_name'] = $row->facility_name;


            array_push($json_array, $data);

        }
//        echo json_encode($json_array);
        return $json_array;


    }

   function months_of_stock()
   {
       $info['user_object'] = $this->get_user_object();
       $user_level = $info['user_object']['user_level'];
       $station_id = $info['user_object']['user_statiton'];
       $this->load->model('mdl_dashboard');
       $query = $this->mdl_dashboard->vaccine();
       $json_array = array();
       foreach ($query as $row) {
           $vaccine[] = $row->Vaccine_name;
       }
       $size = sizeof($vaccine);
       for ($i = 0; $i < $size; $i++) {
           $bal_query = $this->mdl_dashboard->get_stock_balance_where($station_id, $vaccine[$i]);

           foreach ($bal_query as $row) {
               $vaccines[] = $row->vaccine_name;
               $balance[] = $row->stock_balance;

               $doses_query = $this->mdl_dashboard->get_doses_administered_where($user_level, $station_id, $vaccines[$i]);
               foreach ($doses_query as $r) {
                   $data['name'] = $vaccines[$i];
                   $data['y'] = (int)($balance[$i] / $r->{$vaccines[$i]});
                   $json_array[] = $data;

               }

           }

       }
       echo json_encode($json_array);

   }

}


