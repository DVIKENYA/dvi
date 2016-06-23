<?php
class Subcounty extends MY_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
	{
            $this->load->model('mdl_subcounty');
            $this->load->library('pagination');
            $this->load->library('table');
            $config['base_url'] = base_url().'/subcounty/index';
            $config['total_rows'] = $this->mdl_subcounty->get('id')->num_rows;
            $config['per_page'] = 5;
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
          // $data['query'] = $this->mdl_subcounty->get('id', $config['per_page'], $this->uri->segment(3));
            $data['records'] = $this->db->get('m_subcounty', $config['per_page'], $this->uri->segment(3));
           //$this->load->view('display', $data);
            $data['section'] = "Configuration";
            $data['subtitle'] = "Sub County";
            $data['page_title'] = "List Sub Counties";
            $data['module']="subcounty";
            $data['view_file']="list_subcounty_view";
            $data['user_object'] = $this->get_user_object();
            $data['main_title'] = $this->get_title();
            $this->load->library('make_bread');
            $this->make_bread->add('Configurations', '', 0);
            $this->make_bread->add('List Sub-counties', '', 0);
            $data['breadcrumb'] = $this->make_bread->output();
            echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);  
	}
   



function create(){
	
            $update_id= $this->uri->segment(3);
            
            if (!isset($update_id )){
                $update_id = $this->input->post('update_id', $id);
            }
            
            if (is_numeric($update_id)){
                $data = $this->get_data_from_db($update_id);
                $data['update_id'] = $update_id;
                
            } else {
            $data= $this->get_data_from_post();
            }
            
            $data['section'] = "Configuration";
            $data['subtitle'] = "Sub County";
            $data['page_title'] = "Add Sub County";
          	$data['module'] = "subcounty";
          	$data['view_file'] = "create_subcounty_form";
          	$data['user_object'] = $this->get_user_object();
            $data['main_title'] = $this->get_title();
            $this->load->library('make_bread');
            $this->make_bread->add('Configurations', '', 0);
            $this->make_bread->add('List Sub-counties', 'subcounty/', 1);
            $this->make_bread->add('Edit Sub-county', '', 0);
            $data['breadcrumb'] = $this->make_bread->output();
            echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
}

function get_data_from_post(){
            $data['subcounty_name']=$this->input->post('subcounty_name', TRUE);
            $data['county_id']=$this->input->post('county_id', TRUE);
            $data['population']=$this->input->post('population', TRUE);          
            $data['population_one']=$this->input->post('population_one', TRUE);
            $data['population_women']=$this->input->post('population_women', TRUE);
            $data['no_facilities']=$this->input->post('no_facilities', TRUE);
            return $data;
        }

        function get_data_from_db($update_id){
               $query = $this->get_where($update_id);
               foreach ($query->result() as $row){
                   $data['subcounty_name'] = $row->subcounty_name;
                   $data['county_id'] = $row->county_id;
                   $data['population'] = $row->population;
                   $data['population_one'] = $row->population_one;
                   $data['population_women'] = $row->population_women;
                   $data['no_facilities'] = $row->no_facilities;
               }
            return $data;
        }
//County Name Estimated Total Population Estimated Population Under One Estimated Population of Women Number of Health Facilities
          function submit (){
            
        $this->load->library('form_validation');
        $this->form_validation->set_rules('subcounty_name', 'Sub County Name', 'required|xss_clean');
        $this->form_validation->set_rules('county_id', 'County Name', 'required|xss_clean');
        $this->form_validation->set_rules('population', 'Estimated Total Population', 'required|xss_clean');
        $this->form_validation->set_rules('population_one', 'Estimated Population Under One', 'required|xss_clean');
        $this->form_validation->set_rules('population_women', 'Estimated Population of Women', 'required|xss_clean');
        $this->form_validation->set_rules('no_facilities', 'Number of Health Facilities', 'required|xss_clean');
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
                       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Sub County details updated successfully!</div>');
            
                   } else {
                       $this->_insert($data);
                       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">New Sub ounty added successfully!</div>');
                   }
                   
                   //$this->session->set_flashdata('success', 'County added successfully.');
                   redirect('subcounty');
        }
        }

        function delete($id){
$this->_delete($id);
$this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Sub County details deleted successfully!</div>');
redirect('subcounty');
}
  









function get($order_by){
$this->load->model('mdl_subcounty');
$query = $this->mdl_subcounty->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_subcounty');
$query = $this->mdl_subcounty->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_subcounty');
$query = $this->mdl_subcounty->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_subcounty');
$query = $this->mdl_subcounty->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_subcounty');
$this->mdl_subcounty->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_subcounty');
$this->mdl_subcounty->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_subcounty');
$this->mdl_subcounty->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_subcounty');
$count = $this->mdl_subcounty->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_subcounty');
$max_id = $this->mdl_subcounty->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_subcounty');
$query = $this->mdl_subcounty->_custom_query($mysql_query);
return $query;
}

}