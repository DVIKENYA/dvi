<?php
class Depot extends MY_Controller 
{

function __construct() {
parent::__construct();
}

public function index()
	{
    Modules::run('secure_tings/is_logged_in');
            $this->load->model('mdl_depot');
            $this->load->library('pagination');
            $this->load->library('table');
            $config['base_url'] = base_url().'/depot/index';
            $config['total_rows'] = $this->mdl_depot->get('id')->num_rows;
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
            //this is a change
            $this->pagination->initialize($config);
            $data['records'] = $this->db->get('m_depot', $config['per_page'], $this->uri->segment(3));
            $data['section'] = "Configuration";
            $data['subtitle'] = "Depot";
            $data['page_title'] = "List Depots";
            $data['module']="depot";
            $data['view_file']="list_depot_view";
             $data['user_object'] = $this->get_user_object();
           $data['main_title'] = $this->get_title();
           echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
	}
   



function create(){
	
            $update_id= $this->uri->segment(3);
            $data = array();
            $this->load->model('mdl_depot');
            
            if (!isset($update_id )){
                $update_id = $this->input->post('update_id', $id);
				$data['region']  = $this->mdl_depot->getRegion();
				$data['county']  = $this->mdl_depot->getCounty();
				$data['subcounty']  = $this->mdl_depot->getSubcounty();
            }
            
            if (is_numeric($update_id)){
                $data = $this->get_data_from_db($update_id);
                $data['update_id'] = $update_id;
				$data['region']  = $this->mdl_depot->getRegion();
				$data['county']  = $this->mdl_depot->getCounty();
				$data['subcounty']  = $this->mdl_depot->getSubcounty();				
                
            } else {
				$data= $this->get_data_from_post();
				$data['region']  = $this->mdl_depot->getRegion();
				$data['county']  = $this->mdl_depot->getCounty();
				$data['subcounty']  = $this->mdl_depot->getSubcounty();			
            }
            
            $data['section'] = "Configuration";
            $data['subtitle'] = "Depots";
            $data['page_title'] = "Add Depot";
	$data['module'] = "depot";
	$data['view_file'] = "create_depot_form";
	 $data['user_object'] = $this->get_user_object();
           $data['main_title'] = $this->get_title();
           echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
}

function get_data_from_post(){
            $data['depot_location']=$this->input->post('depot_location', TRUE);
			$data['region_id']=$this->input->post('region_id', TRUE);
			$data['county_id']=$this->input->post('county_id', TRUE);
			$data['subcounty_id']=$this->input->post('subcounty_id', TRUE);
			        
            return $data;
        }

        function get_data_from_db($update_id){
               $query = $this->get_where($update_id);
               foreach ($query->result() as $row){
                   $data['depot_location'] = $row->depot_location;
                   $data['region_id'] = $row->region_id;
                   $data['county_id'] = $row->county_id;
				   $data['subcounty_id'] = $row->subcounty_id;
               }
            return $data;
        }

          function submit (){
            
        $this->load->library('form_validation');
        $this->form_validation->set_rules('depot_location', 'Depot Name', 'required|xss_clean');
        $this->form_validation->set_rules('region_id', 'Region', 'required|xss_clean');
        $this->form_validation->set_rules('county_id', 'County', 'required|xss_clean');
        $this->form_validation->set_rules('subcounty_id', 'Subcounty', 'required|xss_clean');
       
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
                       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">depot details updated successfully!</div>');
            
                   } else {
                       $this->_insert($data);
                       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">New depot added successfully!</div>');
                   }
                   
                   //$this->session->set_flashdata('success', 'depot added successfully.');
                   redirect('depot');
        }
        }

        function delete($id){
$this->_delete($id);
$this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">depot details deleted successfully!</div>');
redirect('depot');
}
        

function get($order_by){
$this->load->model('mdl_depot');
$query = $this->mdl_depot->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_depot');
$query = $this->mdl_depot->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_depot');
$query = $this->mdl_depot->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_depot');
$query = $this->mdl_depot->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_depot');
$this->mdl_depot->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_depot');
$this->mdl_depot->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_depot');
$this->mdl_depot->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_depot');
$count = $this->mdl_depot->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_depot');
$max_id = $this->mdl_depot->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_depot');
$query = $this->mdl_depot->_custom_query($mysql_query);
return $query;
}

}