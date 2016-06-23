<?php
class Facility extends MY_Controller {

      function __construct(){
            parent::__construct();
      }

      public function index(){
            $data['module']="facility";
            $data['view_file']="list_facility_view";
            $data['section'] = "Configuration";
            $data['subtitle'] = "List Facility";
            $data['page_title'] = "Facility";
            $data['user_object'] = $this->get_user_object();
            $data['main_title'] = $this->get_title();
          //breadcrumbs
          $this->load->library('make_bread');
          $this->make_bread->add('Configurations', '', 0);
          $this->make_bread->add('List Facilities', 'facility/', 0);
          $data['breadcrumb'] = $this->make_bread->output();
          //
            echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
         }
         

      public function create(){

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

            $data['module'] = "facility";
            $data['view_file'] = "create_facility_form";
            $data['section'] = "Configuration";
            $data['subtitle'] = "Edit Facility";
            $data['page_title'] = "Facility";
            $data['user_object'] = $this->get_user_object();
            $data['main_title'] = $this->get_title();
          $this->load->library('make_bread');
          $this->make_bread->add('Configurations', '', 0);
          $this->make_bread->add('List Facilities', 'facility/', 0);
          $this->make_bread->add('Edit Facility', '', 0);
          $data['breadcrumb'] = $this->make_bread->output();
          //
            echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);  
         
      }

      function submit(){

            $this->load->library('form_validation');
            $this->form_validation->set_rules('facility_name','Facility Name','trim|required');
            // $this->form_validation->set_rules('region_id','Region','trim|required');
            // $this->form_validation->set_rules('county_id','County','trim|required');
            // $this->form_validation->set_rules('subcounty_id','Sub-county','trim|required');
            // $this->form_validation->set_rules('refrigerator','refrigerator','trim|required');
            // //$this->form_validation->set_rules('status','Status','trim|required');
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
                       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Facility details updated successfully!</div>');

                   } else {
                       $this->_insert($data);
                       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">New Facility added successfully!</div>');
                   }

                   redirect('facility');
            }
      }

      function get_data_from_db($update_id){
            $query = $this->get_where($update_id);

            foreach ($query->result() as $row){
                  $data['facility_name'] = $row->facility_name;
                  $data['staff'] = $row->staff;
                  //$data['dhis_id'] = $row->dhis_id;
                  $data['officer_incharge'] = $row->officer_incharge;
                  $data['email'] = $row->email;
                  $data['phone'] = $row->phone;
                  $data['nearest_town'] = $row->nearest_town;
                  $data['nearest_town_distance'] = $row->nearest_town_distance;
                  $data['nearest_depot_distance'] = $row->nearest_depot_distance;
                  $data['wcba_population'] = $row->wcba_population;
                  $data['catchment_population'] = $row->catchment_population;
                  $data['catchment_population_under_one'] = $row->catchment_population_under_one;
                  $data['cold_box'] = $row->cold_box;
                  $data['vaccine_carrier'] = $row->vaccine_carrier;
            }
            return $data;
      }

      function get_data_from_post(){
            $data['facility_name']  =$this->input->post('facility_name', TRUE);
            $data['staff']      = $this->input->post('staff', TRUE);
            //$data['dhis_id']    = $this->input->post('dhis_id', TRUE);
            $data['officer_incharge']=$this->input->post('officer_incharge', TRUE);
            $data['email']      = $this->input->post('email', TRUE);
            $data['phone']      = $this->input->post('phone', TRUE);
            $data['nearest_town']   = $this->input->post('nearest_town', TRUE);
            $data['nearest_town_distance']  = $this->input->post('nearest_town_distance', TRUE);
            $data['nearest_depot_distance'] = $this->input->post('nearest_depot_distance', TRUE);
            $data['wcba_population']    = $this->input->post('wcba_population', TRUE);
            $data['catchment_population']   = $this->input->post('catchment_population', TRUE);
            $data['catchment_population_under_one'] = $this->input->post('catchment_population_under_one', TRUE);   
            $data['cold_box']         = $this->input->post('cold_box', TRUE);
            $data['vaccine_carrier']    = $this->input->post('vaccine_carrier', TRUE);
            return $data;
        }

      public function action_list(){
            $this->load->model('mdl_facility');
          
            $list = $this->getFacility();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $facility) {
                  $no++;
                  $row = array();
                  $row[] = $facility->facility_name;
                  $row[] = $facility->officer_incharge;
                  $row[] = $facility->vaccine_carrier;
                  $row[] = $facility->cold_box;

                  //add html for action
                  
                  $row[] = '  <a class="btn btn-sm btn-primary" href="facility/create/'.$facility->id.'" title="Edit"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                              <a class="btn btn-sm btn-info"  href="facility/list_fridge/'.$facility->id.'" title="Add"><i class="glyphicon glyphicon-plus"></i> Fridge</a>';
            
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


      public function list_fridge(){
          $update_id= $this->uri->segment(3);
          $data['id'] = $update_id;
          $data['fridge_model'] = $this->get_fridge_model();
          $data['module'] = "facility";
          $data['view_file'] = "list_refrigerator_view";
          $data['section'] = "Configuration";
          $data['subtitle'] = "Refrigerator";
          $data['page_title'] = "Refrigerator";
          $data['user_object'] = $this->get_user_object();
          $data['main_title'] = $this->get_title();
          $this->load->library('make_bread');
          $this->make_bread->add('Configurations', '', 0);
          $this->make_bread->add('List Facilities', 'facility/', 0);
          $data['breadcrumb'] = $this->make_bread->output();
          //
          echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data); 
      }

     
      function get_fridges_by_id(){
        $id= $this->uri->segment(3);
        $this->load->model('mdl_facility');
        $list = $this->mdl_facility->get_fridges_by_id($id);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $fridge) {
              $no++;
              $row = array();
             
              $row[] = $fridge->Model;
              $row[] = $fridge->Manufacturer;
              $row[] = $fridge->temperature_monitor_no;
              $row[] = $fridge->main_power_source;
              $row[] = $fridge->refrigerator_age;
              //add html for action
              
              $row[] = '  <a class="btn btn-sm btn-primary" title="Edit" onclick="edit_fridge('."'".$fridge->refrigerator_id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
                          <a class="btn btn-sm btn-danger"  title="Delete" onclick="delete_fridge('."'".$fridge->refrigerator_id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
              

              $data[] = $row;
        }

        $output = array(
          "draw" => $_POST['draw'],
          "recordsTotal" => $this->count_fridges("facility_id", $id),
          "recordsFiltered" => $this->count_fridges_filtered($id),
          "data" => $data,
        );
            
            echo json_encode($output);
      }

      function edit_fridge(){
        $id= $this->uri->segment(3);
        $this->load->model('mdl_facility');
        $data = $this->mdl_facility->get_fridges($id);
        echo json_encode($data);
      }

      public function add_fridge(){
        $id= $this->uri->segment(3);
        $data = array(
            'facility_id'         => $id,
            'refrigerator_id'     => $this->input->post('model'),
            'temperature_monitor_no'   => $this->input->post('temperature_monitor_no'),
            'main_power_source'   => $this->input->post('main_power_source'),
            'refrigerator_age'    => $this->input->post('refrigerator_age'),
          );
        $insert = $this->_insert_fridge($data);
        echo json_encode(array("status" => TRUE));
      }

      public function update_fridge(){
        $id= $this->uri->segment(3);
        $data = array(
            'temperature_monitor_no'   => $this->input->post('temperature_monitor_no'),
            'main_power_source'   => $this->input->post('main_power_source'),
            );
        $this->_update_fridge($id, $data);
        echo json_encode(array("status" => TRUE));
      }

      function getFacility(){
            $data['user_object'] = $this->get_user_object();
            $station_id=$data['user_object']['user_statiton'];
            $this->load->model('mdl_facility');
            $query = $this->mdl_facility->getFacility($station_id);
            return $query;
      }

      function get_fridge_model(){
            $this->load->model('mdl_facility');
            $query = $this->mdl_facility->get_fridge_model();
            return $query;
      }

      function dump(){
            $this->load->model('mdl_facility');
            $query = $this->mdl_facility->getFacility();
            //return $query;
            var_dump($query);
      }

      function count_all() {
            $this->load->model('mdl_facility');
            $query = $this->mdl_facility->count_all();
            return $query;
      }

      function count_filtered() {
            $data['user_object'] = $this->get_user_object();
            $station_id=$data['user_object']['user_statiton'];
            $this->load->model('mdl_facility');
            $query = $this->mdl_facility->count_filtered($station_id);
            return $query;
      }

      function delete($id){
            $this->_delete($id);
            $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Facility details deleted successfully!</div>');
            redirect('facility');
      }

      function delete_fridge(){
            $id= $this->uri->segment(3);
            $this->_delete_fridge($id);
            echo json_encode(array("status" => TRUE));
            $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Facility details deleted successfully!</div>');
            //redirect('data');
      }
        
      function get($order_by){
            $this->load->model('mdl_facility');
            $query = $this->mdl_facility->get($order_by);
            return $query;
      }

      function count_fridges($column, $value) {
          $this->load->model('mdl_facility');
          $query = $this->mdl_facility->count_fridges($column, $value);
          return $query;
      }

      function count_fridges_filtered($id) {
         $this->load->model('mdl_facility');
         $query = $this->mdl_facility->count_fridges_filtered($id);
         return $query;
      }
     
      function get_where($id){
            $this->load->model('mdl_facility');
            $query = $this->mdl_facility->get_where($id);
            return $query;
      }

      function _insert($data){
            $this->load->model('mdl_facility');
            $this->mdl_facility->_insert($data);
      }

      function _update($id, $data){
            $this->load->model('mdl_facility');
            $this->mdl_facility->_update($id, $data);
      }

      function _delete($id){
            $this->load->model('mdl_facility');
            $this->mdl_facility->_delete($id);
      }

      function _insert_fridge($data){
            $this->load->model('mdl_facility');
            $this->mdl_facility->_insert_fridge($data);
      }

      function _update_fridge($id, $data){
            $this->load->model('mdl_facility');
            $this->mdl_facility->_update_fridge($id, $data);
      }

      function _delete_fridge($id){
            $this->load->model('mdl_facility');
            $this->mdl_facility->_delete_fridge($id);
      }
    
}