<?php
class County extends MY_Controller 
{

function __construct() {
parent::__construct();

}

public function index()
	{
            Modules::run('secure_tings/ni_admin');
            $this->load->model('mdl_county');
            $this->load->library('pagination');
            $this->load->library('table');
            $config['base_url'] = base_url().'/county/index';
            $config['total_rows'] = $this->mdl_county->get('id')->num_rows;
            $config['per_page'] = 15;
            $config['num_links'] = 4;
            $config['full_tag_open'] = '<div><ul class="pagination pagination-small pagination-centered">';
            $config['full_tag_close'] = '</ul></div>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
            $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
            $config['next_tag_open'] = "<li>";
            $config['next_tagl_close'] = "</li>";
            $config['prev_tag_open'] = "<li>";
            $config['prev_tagl_close'] = "</li>";
            $config['first_tag_open'] = "<li>";
            $config['first_tagl_close'] = "</li>";
            $config['last_tag_open'] = "<li>";
            $config['last_tagl_close'] = "</li>";
            
            $this->pagination->initialize($config);
          // $data['query'] = $this->mdl_county->get('id', $config['per_page'], $this->uri->segment(3));
            $data['records'] = $this->db->get('m_county', $config['per_page'], $this->uri->segment(3));
           //$this->load->view('display', $data);
            $data['section'] = "Configuration";
            $data['subtitle'] = "County";
            $data['page_title'] = "List Counties";
            $data['module']="county";
            $data['view_file']="list_county_view";
           $data['user_object'] = $this->get_user_object();
           $data['main_title'] = $this->get_title();
        $this->load->library('make_bread');
        $this->make_bread->add('Configurations', '', 0);
        $this->make_bread->add('List Counties', '', 0);
        $data['breadcrumb'] = $this->make_bread->output();
           echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);	
         }
   
function create(){
	Modules::run('secure_tings/ni_admin');
            $update_id= $this->uri->segment(3);
            $data = array();
            $this->load->model('mdl_county');
            
            if (!isset($update_id )){
                $update_id = $this->input->post('update_id', $id);
                 $data['maregion']  = $this->mdl_county->getRegion();
            }
            
            if (is_numeric($update_id)){
                $data = $this->get_data_from_db($update_id);
                $data['update_id'] = $update_id;
                 $data['maregion']  = $this->mdl_county->getRegion();
                
            } else {
            $data= $this->get_data_from_post();
             $data['maregion']  = $this->mdl_county->getRegion();
            }
            
            $data['section'] = "Configuration";
            $data['subtitle'] = "County";
            $data['page_title'] = "Add County";
	$data['module'] = "county";
	$data['view_file'] = "create_county_form";
	$data['user_object'] = $this->get_user_object();
           $data['main_title'] = $this->get_title();
    $this->load->library('make_bread');
    $this->make_bread->add('Configurations', '', 0);
    $this->make_bread->add('List Counties', 'county/', 1);
    $this->make_bread->add('Edit County', '', 0);
    $data['breadcrumb'] = $this->make_bread->output();
           echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);  
}

function get_data_from_post(){
            $data['county_name']=$this->input->post('county_name', TRUE);
      $data['county_headquarter']=$this->input->post('county_headquarter', TRUE);
      $data['region_id']=$this->input->post('region_id', TRUE);
     // $data['dhis_id']=$this->input->post('dhis_id', TRUE);
      $data['population']=$this->input->post('population', TRUE);          
      $data['population_one']=$this->input->post('population_one', TRUE);
      $data['population_women']=$this->input->post('population_women', TRUE);
      $data['county_logistician']=$this->input->post('county_logistician', TRUE);
			$data['county_logistician_phone']=$this->input->post('county_logistician_phone', TRUE);
			$data['county_logistician_email']=$this->input->post('county_logistician_email', TRUE);
			$data['county_nurse']=$this->input->post('county_nurse', TRUE);
			$data['county_nurse_phone']=$this->input->post('county_nurse_phone', TRUE);
			$data['county_nurse_email']=$this->input->post('county_nurse_email', TRUE);
			$data['medical_technician']=$this->input->post('medical_technician', TRUE);
			$data['medical_technician_phone']=$this->input->post('medical_technician_phone', TRUE);
			$data['medical_technician_email']=$this->input->post('medical_technician_email', TRUE);
			$data['county_medicalofficer']=$this->input->post('county_medicalofficer', TRUE);
			$data['county_medicalofficer_phone']=$this->input->post('county_medicalofficer_phone', TRUE);
			$data['county_medicalofficer_email']=$this->input->post('county_medicalofficer_email', TRUE);
		
            return $data;
        }

        function get_data_from_db($update_id){
               $query = $this->get_where($update_id);
               foreach ($query->result() as $row){
                   $data['county_name'] = $row->county_name;
                   $data['county_headquarter'] = $row->county_headquarter;
                   $data['region_id'] = $row->region_id;
				   $data['county_headquarter'] = $row->county_headquarter;
				   $data['dhis_id'] = $row->dhis_id;
           $data['population'] = $row->population;
           $data['population_one'] = $row->population_one;
           $data['population_women'] = $row->population_women;
				   $data['county_logistician'] = $row->county_logistician;
				   $data['county_logistician_phone'] = $row->county_logistician_phone;
				   $data['county_logistician_email'] = $row->county_logistician_email;
				   $data['county_nurse'] = $row->county_nurse;
				   $data['county_nurse_phone'] = $row->county_nurse_phone;
				   $data['county_nurse_email'] = $row->county_nurse_email;
				   $data['medical_technician'] = $row->medical_technician;
				   $data['medical_technician_phone'] = $row->medical_technician_phone;
				   $data['medical_technician_email'] = $row->medical_technician_email;
				   $data['county_medicalofficer'] = $row->county_medicalofficer;
				   $data['county_medicalofficer_phone'] = $row->county_medicalofficer_phone;
				   $data['county_medicalofficer_email'] = $row->county_medicalofficer_email;
			
               }
            return $data;
        }

          function submit (){
            
        $this->load->library('form_validation');
        $this->form_validation->set_rules('county_name', 'County Name', 'required|xss_clean');
        $this->form_validation->set_rules('county_headquarter', 'County Headquarter', 'required|xss_clean');
        $this->form_validation->set_rules('region_id', 'Region', 'required|xss_clean');
        $this->form_validation->set_error_delimiters('<p class="red_text semi-bold">'.'*', '</p>');
                
        $update_id = $this->input->post('update_id', TRUE);
        if ($this->form_validation->run() == FALSE)
        {   
                    $this->create();         
        }
        else
        {       
                   $data =  $this->get_data_from_post();
                   
                   if(is_numeric($update_id)){
                       $this->_update($update_id, $data);
                       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">County details updated successfully!</div>');
            
                   } else {
                       $this->_insert($data);
                       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">New county added successfully!</div>');
                   }
                   
                   //$this->session->set_flashdata('success', 'County added successfully.');
                   redirect('county');
        }
        }

        function delete($id){
$this->_delete($id);
$this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">County details deleted successfully!</div>');
redirect('county');
}
        

function get($order_by){
$this->load->model('mdl_county');
$query = $this->mdl_county->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_county');
$query = $this->mdl_county->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_county');
$query = $this->mdl_county->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_county');
$query = $this->mdl_county->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_county');
$this->mdl_county->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_county');
$this->mdl_county->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_county');
$this->mdl_county->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_county');
$count = $this->mdl_county->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_county');
$max_id = $this->mdl_county->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_county');
$query = $this->mdl_county->_custom_query($mysql_query);
return $query;
}

}