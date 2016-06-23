<?php
class E_name extends MY_Controller 
{

function __construct() {
parent::__construct();
}


public function index()
	{
    
            Modules::run('secure_tings/ni_met');
            $this->load->model('mdl_ename');
            $this->load->library('pagination');
            $this->load->library('table');
            $config['base_url'] = base_url().'/e_name/index';
            $config['total_rows'] = $this->mdl_ename->get('id')->num_rows;
            $config['per_page'] = 10;
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
            $data['records'] = $this->db->get('m_equipment_options', $config['per_page'], $this->uri->segment(3));
            $data['section'] = "Maintenance";
            $data['subtitle'] = "Spare Parts";
            $data['page_title'] = "Equipment Options";
            $data['module']="e_name";
            $data['view_file']="create_e_name_form";
            $data['user_object'] = $this->get_user_object();
            $data['main_title'] = $this->get_title();
            $data['name'] = "";
            echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data); 
	}
   



        function create(){
        
         Modules::run('secure_tings/ni_met');
         $update_id= $this->uri->segment(3);
         $data = array();
         $this->load->model('mdl_ename');

         if (!isset($update_id )){
          $update_id = $this->input->post('update_id', $id);

        }

        if (is_numeric($update_id)){
          $data = $this->get_data_from_db($update_id);
          $data['update_id'] = $update_id;


        } else {
          $data= $this->get_data_from_post();

        }

        $data['section'] = "Maintenance";
        $data['subtitle'] = "Spare Parts";
        $data['page_title'] = "Equipment Options";
        $data['module'] = "e_name";
        $data['view_file'] = "create_e_name_form";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
      }


      function get_data_from_post(){
        $data['name']=$this->input->post('name', TRUE);
        return $data;
      }

      function get_data_from_db($update_id){
       $query = $this->get_where($update_id);
       foreach ($query->result() as $row){
         $data['name'] = $row->name;
         

       }
       return $data;
      }

      function submit (){

        Modules::run('secure_tings/ni_met');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Equipment Name', 'required|xss_clean');
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
           $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Equipment Option details updated successfully!</div>');

         } else {
           $this->_insert($data);
           $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">New Equipment Option added successfully!</div>');
         }

         redirect('spareparts');
       }
      }

      function delete($id){
        Modules::run('secure_tings/ni_met');
        $this->_delete($id);
        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Equipment Option details deleted successfully!</div>');
        redirect('e_name');
      }


      function get($order_by){
        $this->load->model('mdl_ename');
        $query = $this->mdl_ename->get($order_by);
        return $query;
      }

      function get_with_limit($limit, $offset, $order_by) {
        $this->load->model('mdl_ename');
        $query = $this->mdl_ename->get_with_limit($limit, $offset, $order_by);
        return $query;
      }

      function get_where($id){
        $this->load->model('mdl_ename');
        $query = $this->mdl_ename->get_where($id);
        return $query;
      }

      function get_where_custom($col, $value) {
        $this->load->model('mdl_ename');
        $query = $this->mdl_ename->get_where_custom($col, $value);
        return $query;
      }

      function _insert($data){
        $this->load->model('mdl_ename');
        $this->mdl_ename->_insert($data);
      }

      function _update($id, $data){
        $this->load->model('mdl_ename');
        $this->mdl_ename->_update($id, $data);
      }

      function _delete($id){
        $this->load->model('mdl_ename');
        $this->mdl_ename->_delete($id);
      }

      function count_where($column, $value) {
        $this->load->model('mdl_ename');
        $count = $this->mdl_ename->count_where($column, $value);
        return $count;
      }

      function get_max() {
        $this->load->model('mdl_ename');
        $max_id = $this->mdl_ename->get_max();
        return $max_id;
      }

      function _custom_query($mysql_query) {
        $this->load->model('mdl_ename');
        $query = $this->mdl_ename->_custom_query($mysql_query);
        return $query;
      }

      }