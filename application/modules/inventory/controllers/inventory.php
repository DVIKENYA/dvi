<?php
class Inventory extends MY_Controller {

      function __construct() {
        parent::__construct();
      }


      public function index()
      {
        $this->load->model('mdl_inventory');
        $this->load->library('pagination');
        $this->load->library('table');
        $config['base_url'] = base_url().'/inventory/index';
        $config['total_rows'] = $this->mdl_inventory->get('id')->num_rows;
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
        $data['records'] = $this->db->get('m_cold_chain_equip', $config['per_page'], $this->uri->segment(3));
        $data['section'] = "Maintenance";
        $data['subtitle'] = "Inventory";
        $data['page_title'] = "Cold Chain Inventory";
        $data['module']="inventory";
        $data['view_file']="list_inventory_view";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data); 
      }




      function create(){


        $update_id= $this->uri->segment(3);
        $data = array();
        $this->load->model('mdl_inventory');

            if (!isset($update_id )){
              $update_id = $this->input->post('update_id', $id);
              $data['maequipment']  = $this->mdl_inventory->getequip();
              $data['matype']  = $this->mdl_inventory->getequiptype();

            }

            if (is_numeric($update_id)){
              $data = $this->get_data_from_db($update_id);
              $data['update_id'] = $update_id;
              $data['maequipment']  = $this->mdl_inventory->getequip();
              $data['matype']  = $this->mdl_inventory->getequiptype();


            } else {
              $data= $this->get_data_from_post();
              $data['maequipment']  = $this->mdl_inventory->getequip();
              $data['matype']  = $this->mdl_inventory->getequiptype();


            }

        $data['section'] = "Maintenance";
        $data['subtitle'] = "Inventory";
        $data['page_title'] = "Add Cold Chain Inventory Item";
        $data['module'] = "inventory";
        $data['view_file'] = "create_inventory_form";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
      }


      function get_data_from_post(){
       
        $data['equipment']=$this->input->post('equipment', TRUE);
        $data['etype']=$this->input->post('etype', TRUE);
        $data['part_type']=$this->input->post('part_type', TRUE);
        $data['brand']=$this->input->post('brand', TRUE);
        $data['model']=$this->input->post('model', TRUE);
        $data['serial']=$this->input->post('serial', TRUE);
        $data['catalogue']=$this->input->post('catalogue', TRUE);
        $data['unit_price']=$this->input->post('unit_price', TRUE);
        $data['date_purchased']=$this->input->post('date_purchased', TRUE);
        $data['quantity']=$this->input->post('quantity', TRUE);

        return $data;
      }

      function get_data_from_db($update_id){
        
       $query = $this->get_where($update_id);
         foreach ($query->result() as $row){
           $data['equipment'] = $row->equipment;
           $data['etype'] = $row->etype;
           $data['name'] = $row->name;
           $data['part_type'] = $row->part_type;
           $data['brand'] = $row->brand;
           $data['model'] = $row->model;
           $data['serial'] = $row->serial;
           $data['catalogue'] = $row->catalogue;
           $data['unit_price'] = $row->unit_price;
           $data['date_purchased'] = $row->date_purchased;
           $data['quantity'] = $row->quantity;
           $data['decomission'] = $row->decomission;
           $data['date_added'] = $row->date_added;
           $data['location'] = $row->location;
           $data['added_by'] = $row->added_by;
          
         }
       return $data;
     }

     function submit (){
      $this->load->library('form_validation');
      $this->form_validation->set_rules('equipment', 'Equipment Name', 'required|xss_clean');
      $this->form_validation->set_rules('etype', 'Type of Equipment', 'required|xss_clean');
      $this->form_validation->set_rules('part_type', 'Type of Part', 'required|xss_clean');
      $this->form_validation->set_rules('brand', 'Equipment Brand', 'required|xss_clean');
      $this->form_validation->set_rules('model', 'Equipment Model', 'required|xss_clean');
      $this->form_validation->set_rules('serial', 'Equipment Serial No.', 'required|xss_clean');
      $this->form_validation->set_rules('catalogue', 'Equipment Catalogue No.', 'required|xss_clean');
      $this->form_validation->set_rules('unit_price', 'Equipment Unit Price', 'required|xss_clean');
      $this->form_validation->set_rules('date_purchased', 'Date of Purchase', 'required|xss_clean');
      $this->form_validation->set_rules('quantity', 'Quantity', 'required|xss_clean');


      $update_id = $this->input->post('update_id', TRUE);
          if ($this->form_validation->run() == FALSE)
          {   
            $this->create();         
          }
          else
          {  

  

           $data =  $this->get_data_from_post();
           $data['decomission'] = FALSE;
           $data['date_added'] = date('Y-m-d');
           $data['location'] = 'KENYA';
           $data['added_by'] = $this->session->userdata['logged_in']['user_name'];
           // echo "<pre>";
           // var_dump($data);
           // die();
          



           if(is_numeric($update_id)){
             $this->_update($update_id, $data);
             $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Inventory details updated successfully!</div>');

           } else {
             $this->_insert($data);
             $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">New Inventory added successfully!</div>');
           }

                       //$this->session->set_flashdata('success', 'depot added successfully.');
       redirect('inventory');
     }
    }

    function delete($id){
      $this->_delete($id);
      $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Inventory details deleted successfully!</div>');
      redirect('inventory');
    }


    function get($order_by){
      $this->load->model('mdl_inventory');
      $query = $this->mdl_inventory->get($order_by);
      return $query;
    }

    function get_with_limit($limit, $offset, $order_by) {
      $this->load->model('mdl_inventory');
      $query = $this->mdl_inventory->get_with_limit($limit, $offset, $order_by);
      return $query;
    }

    function get_where($id){
      $this->load->model('mdl_inventory');
      $query = $this->mdl_inventory->get_where($id);
      return $query;
    }

    function get_where_custom($col, $value) {
      $this->load->model('mdl_inventory');
      $query = $this->mdl_inventory->get_where_custom($col, $value);
      return $query;
    }

    function _insert($data){
      $this->load->model('mdl_inventory');
      $this->mdl_inventory->_insert($data);
    }

    function _update($id, $data){
      $this->load->model('mdl_inventory');
      $this->mdl_inventory->_update($id, $data);
    }

    function _delete($id){
      $this->load->model('mdl_inventory');
      $this->mdl_inventory->_delete($id);
    }

    function count_where($column, $value) {
      $this->load->model('mdl_inventory');
      $count = $this->mdl_inventory->count_where($column, $value);
      return $count;
    }

    function get_max() {
      $this->load->model('mdl_inventory');
      $max_id = $this->mdl_inventory->get_max();
      return $max_id;
    }

    function _custom_query($mysql_query) {
      $this->load->model('mdl_inventory');
      $query = $this->mdl_inventory->_custom_query($mysql_query);
      return $query;
    }

}     