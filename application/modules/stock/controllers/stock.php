<?php
/**
* 
*/
class Stock extends MY_Controller
{
  
  function __construct()
  {
    parent::__construct();
  }

   
    public function testing(){
      /*echo "I WORK";exit;*/
      $dat = array(
      'vaccine' => $this->input->post('vaccine'),
       'batch_no'=>$this->input->post('batch_no'),
       'expiry_date'=>$this->input->post('expiry_date'),
       'amt_ordered'=>$this->input->post('amt_ordered'),
       'amt_issued'=>$this->input->post('amt_issued'),
       'vvm_status'=>$this->input->post('vvm_status')
      );
      echo json_encode($dat);

    } 


    function receive_stock(){
    
      $this->load->model('vaccines/mdl_vaccines');
      $data['vaccines']= $this->mdl_vaccines->getVaccine();
      $this->load->model('stock/mdl_vvmstatus');
      $data['vvm_status']= $this->mdl_vvmstatus->get_vvm();
      $this->load->model('stock/mdl_stock');
      $user_level = $this->session->userdata['logged_in']['user_level'];
      $user_id = $this->session->userdata['logged_in']['user_id'];
          if($user_level==1){
            /* 
            user_level = national
            retrieve all regions 
            */
            $data['locations'] = $this->mdl_stock->get_region_base();
          }elseif ($user_level==2) {
            /* 
            user_level = regional
            retrieve all counties 
            */
            $data['locations'] = $this->mdl_stock->get_region_base();
          }elseif ($user_level==3) {
            /* 
            user_level = county
            retrieve all subcounties 
            */
            $data['locations'] = $this->mdl_stock->get_county_base($user_id);
          }elseif ($user_level==4) {
            /* 
            user_level = subounty
            retrieve all facilities 
            */
            $data['locations'] = $this->mdl_stock->get_subcounty_base($user_id);
          }
      $data['module'] = "stock";
      $data['view_file'] = "receive_stock";
      $data['section'] = "stock";
      $data['subtitle'] = "Receive Stock";
      $data['page_title'] = "Receive Stock";
      $data['user_object'] = $this->get_user_object();
      $data['main_title'] = $this->get_title();
      echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
    }

    function save_received_stock(){
  $data2['user_object2'] = $this->get_user_object();
  $data3['user_object3'] = $this->get_user_object();
  $data4['user_object4'] = $this->get_user_object();
  $station_level= $data2['user_object2']['user_level'];
  $station_id=$data3['user_object3']['user_statiton'];
  $operator_id=$data4['user_object4']['user_id'];

       $data = array(
      'transaction_type'=>$this->input->post('transaction_type'),
      'transaction_date'=>$this->input->post('date_received'),
      'source'=>$this->input->post('received_from'),
      'vaccine_id' => $this->input->post('vaccine'),
       'batch_number'=>$this->input->post('batch_no'),
       'expiry_date'=>$this->input->post('expiry_date'),
       'quantity_in'=>$this->input->post('quantity_received'),
       'VVM_status'=>$this->input->post('vvm_status'),
       'user_id'=>$operator_id,
       'station_level'=>$station_level,
       'station_id'=>$station_id
      );
     /* echo json_encode($data);*/
      $this->db->insert('m_stock_movement',$data);  
      $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stock successfully received from <strong>'.$data['source'].'</strong>!</div>');
    }

    function issue_stock(){

          $this->load->model('vaccines/mdl_vaccines');
          $this->load->model('stock/mdl_stock');
          $data['vaccines']= $this->mdl_vaccines->getVaccine();
          $user_level = $this->session->userdata['logged_in']['user_level'];
          $user_id = $this->session->userdata['logged_in']['user_id'];
          if($user_level==1){
            /* 
            user_level = national
            retrieve all regions 
            */
            $data['locations'] = $this->mdl_stock->get_region_base();
          }elseif ($user_level==2) {
            /* 
            user_level = regional
            retrieve all counties 
            */
            $data['locations'] = $this->mdl_stock->get_county_base($user_id);
          }elseif ($user_level==3) {
            /* 
            user_level = county
            retrieve all subcounties 
            */
            $data['locations'] = $this->mdl_stock->get_subcounty_base($user_id);
          }elseif ($user_level==4) {
            /* 
            user_level = subounty
            retrieve all facilities 
            */
            $data['locations'] = $this->mdl_stock->get_facility_base($user_id);
          }
          $data['module'] = "stock";
          $data['view_file'] = "issue_stock";
          $data['section'] = "stock";
          $data['subtitle'] = "Issue Stock";
          $data['page_title'] = "Issue Stock";
          $data['user_object'] = $this->get_user_object();
          $data['main_title'] = $this->get_title();
          echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
         
    }
    function save_issued_stock(){
          $data2['user_object2'] = $this->get_user_object();
          $data3['user_object3'] = $this->get_user_object();
          $data4['user_object4'] = $this->get_user_object();
          $station_level= $data2['user_object2']['user_level'];
          $station_id=$data3['user_object3']['user_statiton'];
          $operator_id=$data4['user_object4']['user_id'];

          $data = array(
          'transaction_type'=>$this->input->post('transaction_type'),
          'transaction_date'=>$this->input->post('date_issued'),
          'destination'=>$this->input->post('issued_to'),
          's11'=>$this->input->post('s11'),
          'vaccine_id' => $this->input->post('vaccine'),
          'batch_number'=>$this->input->post('batch_no'),
          'expiry_date'=>$this->input->post('expiry_date'),
          'quantity_out'=>$this->input->post('amt_issued'),
          'VVM_status'=>$this->input->post('vvm_status'),
          'user_id'=>$operator_id,
          'station_level'=>$station_level,
          'station_id'=>$station_id
          );
          $this->db->insert('m_stock_movement',$data); 
          $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stock successfully issued to <strong>'.$data['destination'].'</strong>!</div>');
          /*echo json_encode($dat);*/
    }

    function list_inventory(){
          $this->load->model('vaccines/mdl_vaccines');
          $data['vaccines']= $this->mdl_vaccines->get_vaccine_details();
          $data['module'] = "stock";
          $data['view_file'] = "inventory";
          $data['section'] = "stock";
          $data['subtitle'] = "Inventory";
          $data['page_title'] = "Inventory";
          $data['user_object'] = $this->get_user_object();
          $data['main_title'] = $this->get_title();
          echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
         //echo Modules::run('template/admin', $data);
    }

    function get_vaccine_ledger($selected_vaccine){
  // This function gets the ledger of the selected vaccine
      /*alert ($selected_vaccine); */
      
          $id= $this->uri->segment(3);
          $data['id'] = $id;
          $this->load->model('stock/mdl_stock');
          $this->load->model('vaccines/mdl_vaccines');
          $data['vaccines']= $this->mdl_vaccines->get_vaccine_details();
          $data['module'] = "stock";
          $data['view_file'] = "vaccine_ledger";
          $data['section'] = "stock";
          $data['subtitle'] = "Vaccine Ledger";
          $data['page_title'] = "Vaccine Ledger";
          $data['user_object'] = $this->get_user_object();
          $data['main_title'] = $this->get_title();
          echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
         //echo Modules::run('template/admin', $data);
    
    }
    function vaccine_ledg($selected_vaccine){

      $this->load->model('stock/mdl_stock');
      $data= $this->mdl_stock->get_vaccine_ledger($selected_vaccine);
       echo json_encode($data);

    }
    
    function ledger(){
      
      $id= $this->uri->segment(3);
      $this->load->model('stock/mdl_stock');
      $user_id = $this->session->userdata['logged_in']['user_id'];
      $query= $this->mdl_stock->get_vaccine_ledger($id, $user_id);
     // var_dump($query);
      $data = array();
      $no = $_POST['start'];
      foreach ($query as $bal) {
          $no++;
          $row = array();
          $row[] = $bal->name;
          $row[] = $bal->batch_number;
          $row[] = $bal->transaction_date;
          $row[] = $bal->quantity_in;
          $row[] = $bal->quantity_out;
          $row[] = $bal->expiry_date;
          $data[] = $row;
      }
      $output = array(
              "draw" => $_POST['draw'],
              "recordsTotal" => $this->count_all(),
              "recordsFiltered" => $this->count_filtered($id, $user_id),
              "data" => $data,
            );
            
            echo json_encode($output);

    }

    function store_balance($selected_vaccine){
      $user_id = $this->session->userdata['logged_in']['user_id'];
      $this->load->model('stock/mdl_stock');
      $query= $this->mdl_stock->get_store_balance($selected_vaccine, $user_id);
      echo json_encode($query);
     
    }

    function transfer_stock(){
         $data['module'] = "stock";
         $data['view_file'] = "transfer_stock";
         $data['section'] = "stock";
         $data['subtitle'] = "Transfer Stock";
         $data['page_title'] = "Transfer Stock";
         $data['user_object'] = $this->get_user_object();
         $data['main_title'] = $this->get_title();
      echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
         //echo Modules::run('template/admin', $data); 
    }

    function get_batches(){
      $user_id = $this->session->userdata['logged_in']['user_id'];
      $selected_vaccine=$this->input->post('selected_vaccine');
      $this->load->model('stock/mdl_stock');
      $data= $this->mdl_stock->get_batches($selected_vaccine, $user_id);
     /* echo json_encode($selected_vaccine);*/
       echo json_encode($data);
    }
    function get_batch_details(){
  // Gets moore details of the batch selected
      $selected_batch=$this->input->post('selected_batch');
      $this->load->model('stock/mdl_stock');
      $data= $this->mdl_stock->get_batchdetails($selected_batch);
     /* echo json_encode($selected_vaccine);*/
       echo json_encode($data);
    }


function get_order_number(){
  
      $this->load->model('stock/mdl_stock');
      $data= $this->mdl_stock->get_order_number();
      return $data;
    }

    function count_all() {
        $this->load->model('stock/mdl_stock');
        $query = $this->mdl_stock->count_all();
        return $query;
      }

    function count_filtered($id, $user_id) {
       $this->load->model('stock/mdl_stock');
       $query = $this->mdl_stock->count_filtered($id, $user_id);
       return $query;
    }
  
}