<?php

class Reports extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
        Modules::run('secure_tings/is_logged_in');

    }


    function counties(){
		$data['module'] = "reports";
		$data['view_file'] = "county_view";
		$data['section'] = "Immunization Performance";
		$data['subtitle'] = "Counties";
		$data['page_title'] = "Counties";
		$data['user_object'] = $this->get_user_object();
		$data['main_title'] = $this->get_title();
		$this->load->library('make_bread');
		$this->make_bread->add('Immunization Performance', '', 0);
		$this->make_bread->add('Counties', '', 0);
		$data['breadcrumb'] = $this->make_bread->output();
		echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data); 
      }

	function county_list(){

		$list = $this->getCounty();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $county) {
		      $no++;
		      $row = array();    
		      $row[] = '  <a onclick="county('.$county->id.')">'.$county->county_name.'</a>';

		      $data[] = $row;
		}

		$output = array(
		  "draw" => $_POST['draw'],
		  "recordsTotal" => $this->count_filtered(),
		  "recordsFiltered" => $this->count_filtered(),
		  "data" => $data,
		);

		echo json_encode($output);
      }

    function getCounty(){
		$this->load->model('mdl_reports');
		$query = $this->mdl_reports->getRegion();
		//var_dump($query);
		return $query;
    }

    function count_filtered() {
    	$this->load->model('mdl_reports');
		$query = $this->mdl_reports->count_filtered();
        return $query;
      }



}