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

       $data = array(
      'transaction_type'=>$this->input->post('transaction_type'),
      'transaction_date'=>$this->input->post('date_received'),
      'source'=>$this->input->post('received_from'),
      'vaccine_id' => $this->input->post('vaccine'),
       'batch_number'=>$this->input->post('batch_no'),
       'expiry_date'=>$this->input->post('expiry_date'),
       'quantity_in'=>$this->input->post('quantity_received'),
       'VVM_status'=>$this->input->post('vvm_status')
      );
     /* echo json_encode($data);*/
      $this->db->insert('m_stock_movement',$data);  
      $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stock received details added successfully!</div>');
    }

    function issue_stock(){

          $this->load->model('vaccines/mdl_vaccines');
          $data['vaccines']= $this->mdl_vaccines->getVaccine();
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
          $data = array(
          'transaction_type'=>$this->input->post('transaction_type'),
          'transaction_date'=>$this->input->post('date_issued'),
          'destination'=>$this->input->post('issued_to'),
          'vaccine_id' => $this->input->post('vaccine'),
           'batch_number'=>$this->input->post('batch_no'),
           'expiry_date'=>$this->input->post('expiry_date'),
           'quantity_out'=>$this->input->post('amt_issued'),
           'VVM_status'=>$this->input->post('vvm_status')
          );
          $this->db->insert('m_stock_movement',$data); 
          $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stock issue details added successfully!</div>');
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
    }

    function get_vaccine_ledger($selected_vaccine){
  // This function gets the ledger of the selected vaccine
      /*alert ($selected_vaccine); */
      
          $this->load->model('stock/mdl_stock');
          $data['ledgers']= $this->mdl_stock->get_vaccine_ledger($selected_vaccine);
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
    
    }
    function vaccine_ledg($selected_vaccine){

      $this->load->model('stock/mdl_stock');
      $data= $this->mdl_stock->get_vaccine_ledger($selected_vaccine);
       echo json_encode($data);

    }

    function physical_count(){
        $this->load->model('vaccines/mdl_vaccines');
        $data['vaccines']= $this->mdl_vaccines->getVaccine();
        $data['module'] = "stock";
        $data['view_file'] = "physical_stock";
        $data['section'] = "stock";
        $data['subtitle'] = "Physical Stock Count";
        $data['page_title'] = "Physical Stock Count";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
    }
    function save_physical_count(){
       $data = array( 
          'vaccine_id' => $this->input->post('vaccine'),
          'batch_number'=>$this->input->post('batch_no'),
          'physical_count =' => '0' 
          );
       $count = array('physical_count' => $this->input->post('physical_count'));
         $this->load->model('stock/mdl_stock');
         $this->mdl_stock->set_physical_count($data,$count);
          /*this->db->insert('m_stock_movement',$data); 
          $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stock issue details added successfully!</div>');*/
          echo json_encode($data);
          print_r($data);

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
    }

    function get_batches(){
  
      $selected_vaccine=$this->input->post('selected_vaccine');
      $this->load->model('stock/mdl_stock');
      $data= $this->mdl_stock->get_batches($selected_vaccine);
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
	
}