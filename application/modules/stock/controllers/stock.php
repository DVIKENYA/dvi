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
      $info['user_object'] = $this->get_user_object();
      $station_id=$info['user_object']['statiton_above'];
          if($user_level==1){
            /* 
            user_level = national
            retrieve all regions 
            */
            $data['location'] = "National Arrival";
          }else{
            $data['location'] = $station_id;
          }
      $data['module'] = "stock";
      $data['view_file'] = "receive_stock";
      $data['section'] = "stock";
      $data['subtitle'] = "Receive Stock";
      $data['page_title'] = "Receive Stock";
      $data['orders'] = $this->get_orders();
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
      'destination'=>$station_id,
      'source'=>$this->input->post('received_from'),
      'vaccine_id' => $this->input->post('vaccine'),
      's11'=>$this->input->post('s11'),
      'batch_number'=>$this->input->post('batch_no'),
      'expiry_date'=>$this->input->post('expiry_date'),
      'quantity_in'=>$this->input->post('quantity_received'),
      'VVM_status'=>$this->input->post('vvm_status'),
      'user_id'=>$operator_id,
      'station_level'=>$station_level,
      'station_id'=>$station_id
      );
     // echo json_encode($data);
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
          $data['orders'] = $this->get_orders();
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
          'source'=>$station_id,
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
          //var_dump($data);
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
          $data['total']= $this->get_total_stkbl($selected_vaccine);
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
    
      
    function ledger_in(){
      
      $id= $this->uri->segment(3);
      $this->load->model('stock/mdl_stock');
      $data['user_object'] = $this->get_user_object();
      $station_id=$data['user_object']['user_statiton'];
      $query= $this->mdl_stock->get_vaccine_ledger_in($id, $station_id);
      //var_dump($query);
      $data = array();
      $no = $_POST['start'];
      foreach ($query as $bal) {
          $no++;
          $row = array();
          $row[] = $bal->vaccine_name;
          $row[] = $bal->batch_no;
          $row[] = $bal->expiry_date; 
          $row[] = $bal->date_created;
                   
          $row[] = $bal->order_destination;
          $row[] = $bal->amount_ordered;
          $row[] = $bal->amount_received;
          $data[] = $row;
      
      }
      $output = array(
              "draw" => $_POST['draw'],
              "recordsTotal" => $this->mdl_stock->count_received_filtered($id, $station_id),
              "recordsFiltered" => $this->mdl_stock->count_received_filtered($id, $station_id),
              "data" => $data,
            );
            
            echo json_encode($output);

    }

    function ledger_out(){
      
      $id= $this->uri->segment(3);
      $this->load->model('stock/mdl_stock');
      $data['user_object'] = $this->get_user_object();
      $station_id=$data['user_object']['user_statiton'];
      $query= $this->mdl_stock->get_vaccine_ledger_out($id, $station_id);
      //var_dump($query);
      $data = array();
      $no = $_POST['start'];
      foreach ($query as $bal) {
          $no++;
          $row = array();
          $row[] = $bal->vaccine_name;
          $row[] = $bal->batch_no;
       
          $row[] = $bal->date_created;
          $row[] = $bal->expiry_date;          
          $row[] = $bal->issuing_station;
          $row[] = $bal->amount_ordered;
          $row[] = $bal->amount_issued;
          $data[] = $row;
      }
      $output = array(
              "draw" => $_POST['draw'],
              "recordsTotal" => $this->mdl_stock->count_issued_filtered($id, $station_id),
              "recordsFiltered" => $this->mdl_stock->count_issued_filtered($id, $station_id),
              "data" => $data,
            );
            
            echo json_encode($output);

    }

    
    function store_balance($selected_vaccine){
      $data['user_object'] = $this->get_user_object();
      $station_id=$data['user_object']['user_statiton'];
      $this->load->model('stock/mdl_stock');
      $query= $this->mdl_stock->get_store_balance($selected_vaccine, $station_id);
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
      $data['user_object'] = $this->get_user_object();
      $station_id=$data['user_object']['user_statiton'];
      $selected_vaccine=$this->input->post('selected_vaccine');
      $this->load->model('stock/mdl_stock');
      $data= $this->mdl_stock->get_batches($selected_vaccine, $station_id);
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

       function get_orders(){
        $data['user_object'] = $this->get_user_object();
        $station_id=$data['user_object']['user_statiton'];
        $this->load->model('stock/mdl_stock');
        $query= $this->mdl_stock->get_orders($station_id);
        return $query;
    //var_dump($query);
    }

      function get_total_stkbl($selected_vaccine){
      $user_id = $this->session->userdata['logged_in']['user_id'];
      $selected_vaccine=$this->input->post('selected_vaccine');
      $this->load->model('stock/mdl_stock');
      $data= $this->mdl_stock->getTotalStockBal($selected_vaccine);
     /* echo json_encode($selected_vaccine);*/
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
          'batch_number'=>$this->input->post('batch_no')
          );
       $count = array('physical_count' => $this->input->post('physical_count'));
       $this->load->model('stock/mdl_stock');
      //var_dump($data,$count);
       $this->mdl_stock->set_physical_count($data,$count);
       $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stock physical count updated successfully!</div>');
     
    }

    function issue_stocks($order_id){
      Modules::run('secure_tings/is_logged_in');
          $data2['user_object2'] = $this->get_user_object();
          $station_name=$data2['user_object2']['user_statiton'];

          $this->load->model('vaccines/mdl_vaccines');
          $data['vaccines']= $this->mdl_vaccines->getVaccine();
          $this->load->model('mdl_stock');
          $data['issues']=$this->mdl_stock->get_order_to_issue($order_id,$station_name);
          $data['order_infor']=$this->mdl_stock->get_order_infor($order_id);
          $data['module'] = "stock";
          $data['view_file'] = "new_issue_stock";
          $data['section'] = "stock";
          $data['subtitle'] = "Issue Stock";
          $data['page_title'] = "Issue Stock";
          $data['user_object'] = $this->get_user_object();
          $data['main_title'] = $this->get_title();
          echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
          
    }

    function new_save_issued_stock(){
      Modules::run('secure_tings/is_logged_in');
      //Issue Stock Information
       $data2['user_object2'] = $this->get_user_object();
       $data3['user_object3'] = $this->get_user_object();
       
      
       
       $order_id=$this->input->post('order');
       $S11=$this->input->post('s11');
       $date_issued=$this->input->post('date_issued');
       $date_recorded=$this->input->post('date_recorded');
       $user_id= $data2['user_object2']['user_id'];
       $user_level= $data2['user_object2']['user_level'];
       $station_name=$data3['user_object3']['user_statiton'];
     

       $issue_array['order_id']=$order_id;
       $issue_array['S11']=$S11;
       $issue_array['date_issued']=$date_issued;
       $issue_array['date_recorded']=$date_recorded;
       $issue_array['issued_by_user']=$user_id;
       $issue_array['issued_by_station_level']=$user_level;
       $issue_array['issued_by_station_id']=$station_name;
      
       $this->db->insert('m_issue_stock', $issue_array);
       $issue_id = $this->db->insert_id(); 

       // Issue Stock Item Information
       $vaccine=$this->input->post('vaccine');
       $batch_no=$this->input->post('batch_no');
       $expiry_date=$this->input->post('expiry_date');
       $amount_ordered=$this->input->post('amt_ordered');
       $stock_quantity=$this->input->post('available_quantity');
       $amount_issued=$this->input->post('amt_issued');
       $vvm_status=$this->input->post('vvm_status');
       $comment=$this->input->post('comment');
       $order_id=$this->input->post('order');

       $issue_array=array();
       $issue_counter=0;

       foreach ($vaccine as $vaccines) {
        $issue_array[$issue_counter]['vaccine_id']=$vaccine[$issue_counter];
        $issue_array[$issue_counter]['batch_no']=$batch_no[$issue_counter];
        $issue_array[$issue_counter]['expiry_date']=$expiry_date[$issue_counter];
        $issue_array[$issue_counter]['vvm_status']=$vvm_status[$issue_counter];
        $issue_array[$issue_counter]['stock_on_hand']=$stock_quantity[$issue_counter];
        $issue_array[$issue_counter]['amount_ordered']=$amount_ordered[$issue_counter];
        $issue_array[$issue_counter]['amount_issued']=$amount_issued[$issue_counter];
        $issue_array[$issue_counter]['comment']=$comment[$issue_counter];
        $issue_array[$issue_counter]['issue_id']=$issue_id[$issue_counter];
         
         $issue_counter++;
       }

       $main_array['own_issues']=$issue_array;
       // Add assigned issue id to issue items
      foreach ($main_array as $key => $value) {
        foreach ($value as $keyvac => $valuevac) {
          foreach ($valuevac as $keys => $values) {
            if ($keys == "issue_id") {
            $temp[$keyvac]['issue_id'] = $issue_id;
          }  else{
            $temp[$keyvac][$keys] = $values;
          }
          
              
          }
        
        }
         
      }

      $this->db->insert_batch('m_issue_stock_item',$temp);

      $this->session ->set_flashdata('order_message','Stock Issued Successfully');
      redirect('order/list_orders');


    }
    function receive_stocks($order_id){
    
      $this->load->model('vaccines/mdl_vaccines');
      $data['vaccines']= $this->mdl_vaccines->getVaccine();
      $this->load->model('stock/mdl_vvmstatus');
      $data['vvm_status']= $this->mdl_vvmstatus->get_vvm();
      $this->load->model('mdl_stock');
      $data['receipts']=$this->mdl_stock->get_order_to_receive($order_id);
      $data['module'] = "stock";
      $data['view_file'] = "new_receive_stock";
      $data['section'] = "stock";
      $data['subtitle'] = "Receive Against Order";
      $data['page_title'] = "Receive Stock";
      $data['user_object'] = $this->get_user_object();
      $data['main_title'] = $this->get_title();
      echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
    }

    function new_save_received_stock(){
      //Receive Stock Information
       $data2['user_object2'] = $this->get_user_object();
                
       $issue_id=$this->input->post('issue_id');
       $order_id=$this->input->post('order_id');
       $S11=$this->input->post('s11');
       $date_received=$this->input->post('date_received');
       $date_recorded=$this->input->post('date_recorded');
       $user_id= $data2['user_object2']['user_id'];
       $user_level= $data2['user_object2']['user_level'];
       $station_name=$data2['user_object2']['user_statiton'];
     
       $receive_array['issue_id']=$issue_id;
       $receive_array['order_id']=$order_id;
       $receive_array['S11']=$S11;
       $receive_array['date_received']=$date_received;
       $receive_array['date_recorded']=$date_recorded;
       $receive_array['received_by_user']=$user_id;
       $receive_array['station_level']=$user_level;
       $receive_array['station_id']=$station_name;
      
       $this->db->insert('m_receive_stock', $receive_array);
       $receive_id = $this->db->insert_id(); 

       // Receive Stock Item Information
       $vaccine=$this->input->post('vaccine');
       $batch_no=$this->input->post('batch_no');
       $expiry_date=$this->input->post('expiry_date');
       $amount_ordered=$this->input->post('quantity_ordered');
       $amount_received=$this->input->post('quantity_received');
       $vvm_status=$this->input->post('vvm_status');
       $comment=$this->input->post('comment');

       $receive_array=array();
       $receive_counter=0;

       foreach ($vaccine as $vaccines) {
        $receive_array[$receive_counter]['vaccine_id']=$vaccine[$receive_counter];
        $receive_array[$receive_counter]['batch_no']=$batch_no[$receive_counter];
        $receive_array[$receive_counter]['expiry_date']=$expiry_date[$receive_counter];
        $receive_array[$receive_counter]['vvm_status']=$vvm_status[$receive_counter];
        $receive_array[$receive_counter]['amount_ordered']=$amount_ordered[$receive_counter];
        $receive_array[$receive_counter]['amount_received']=$amount_received[$receive_counter];
        $receive_array[$receive_counter]['comment']=$comment[$receive_counter];
        $receive_array[$receive_counter]['receive_id']=$receive_id[$receive_counter];
         
        $receive_counter++;
       }

       $main_array['own_receipts']=$receive_array;
       // Add assigned receive id to received items
      foreach ($main_array as $key => $value) {
        foreach ($value as $keyvac => $valuevac) {
          foreach ($valuevac as $keys => $values) {
            if ($keys == "receive_id") {
            $temp[$keyvac]['receive_id'] = $receive_id;
          }  else{
            $temp[$keyvac][$keys] = $values;
          }
              
          }
        
        }
         
      }
      
            $this->db->insert_batch('m_receive_stock_item',$temp);

      $this->session->set_flashdata('receipt_message','Stock Saved Successfully');
      redirect('order/list_orders');
    }

    function test(){

        $data2['user_object2'] = $this->get_user_object();
                
        $S11=$this->input->post('s11');
        $date_received=$this->input->post('date_received');
        $date_recorded=$this->input->post('date_recorded');
        $user_id= $data2['user_object2']['user_id'];
        $user_level= $data2['user_object2']['user_level'];
        $station_name=$data2['user_object2']['user_statiton'];
        
        $order_array['date_created']=$date_recorded;
        $order_array['station_level']=$user_level;
        $order_array['station_id']=$station_name;

        $this->db->insert('m_order', $order_array);
        $order_id=$this->db->insert_id();

        $receive_array['order_id']=$order_id;
        $receive_array['S11']=$S11;
        $receive_array['date_received']=$date_received;
        $receive_array['date_recorded']=$date_recorded;
        $receive_array['received_by_user']=$user_id;
        $receive_array['station_level']=$user_level;
        $receive_array['station_id']=$station_name;

        $this->db->insert('m_receive_stock', $receive_array);
        $receive_id = $this->db->insert_id(); 

        $batch = stripcslashes($_POST['batch']);
        $batch = json_decode($batch,TRUE);
       
        $receive_array=array();
        $receive_counter=0;

           foreach ($batch as $item) {
            $receive_array[$receive_counter]['vaccine_id']     = $item['vaccine_id'];
            $receive_array[$receive_counter]['batch_no']       = $item['batch_no'];
            $receive_array[$receive_counter]['expiry_date']    = $item['expiry_date'];
            $receive_array[$receive_counter]['vvm_status']     = $item['vvm_status'];
            $receive_array[$receive_counter]['amount_received']= $item['amount_received'];
            $receive_array[$receive_counter]['receive_id']     = $receive_id[$receive_counter];
            
             $receive_counter++;
         }
        
        $main_array[]=$receive_array;
       // Add assigned receive id to received items
        foreach ($main_array as $key => $value) {
          foreach ($value as $keyvac => $valuevac) {
            foreach ($valuevac as $keys => $values) {
                if ($keys == "receive_id") {
                  $temp[$keyvac]['receive_id'] = $receive_id;
                }  else{
                  $temp[$keyvac][$keys] = $values;
                }
            }
          
        } 
        $this->db->insert_batch('m_receive_stock_item',$temp);
        echo json_encode($temp);
      }
      
      $this->session->set_flashdata('msg','<div id="alert-message" class="alert alert-success text-center">Received stocks have been saved successfully</div>');
  }

}
