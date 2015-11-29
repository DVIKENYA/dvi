<?php
class Order extends MY_Controller 
{

function __construct() {
parent::__construct();

}

function get($order_by){
$this->load->model('mdl_vaccines');
$query = $this->mdl_vaccines->get($order_by);
return $query;
}
// Get information on the selected vaccines from orders
public function get_order_values(){
    $data2['user_object2'] = $this->get_user_object();
    $station= $data2['user_object2']['user_level'];
    $data3['user_object3'] = $this->get_user_object();
    $station_id= $data3['user_object3']['user_statiton'];
    $selected_vaccine=$this->input->post('selected_vaccine');
    $this->load->model('mdl_order');
    $data=$this->mdl_order->get_order_values($station,$selected_vaccine,$station_id); 
    echo json_encode($data);
}
// Function to create order. Fetches the list of vaccines and calculations of max stock, minstock
public function create_order(){

  $this->load->model('vaccines/mdl_vaccines');
  $this->load->model('order/mdl_order');
  $data['vaccines']= $this->mdl_vaccines->getVaccine();
  $data3['user_object3'] = $this->get_user_object();
  $station_id= $data3['user_object3']['user_statiton'];
  $data2['user_object2'] = $this->get_user_object();
  $station_level= $data2['user_object2']['user_level'];
  $data['order_vaccines']=$this->mdl_order->calc_orders($station_id,$station_level);
  $data['section'] = "Vaccines";
  $data['subtitle'] = "Place Order";
  $data['page_title'] = "Place Order";
  $data['module'] = "order";
  $data['options']="none";
  $data['view_file'] = "create_order_form";
  $data['user_object'] = $this->get_user_object();
 $data['main_title'] = $this->get_title();
 echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
}

// Function lists the orders placed or submitted
public function list_orders(){
 
  $this->load->model('order/mdl_order');
  $data2['user_object2'] = $this->get_user_object();
  $data3['user_object3'] = $this->get_user_object();
  $station= $data2['user_object2']['user_level'];
  $station_id=$data3['user_object3']['user_statiton'];
  $data['orders']= $this->mdl_order->get_placed_orders($station,$station_id);
  $data['submitted_orders']= $this->mdl_order->get_submitted_orders($station,$station_id);
  $data['section'] = "Vaccines";
  $data['subtitle'] = "Orders";
  $data['page_title'] = " Orders";
  $data['module'] = "order";
  $data['view_file'] = "list_order_view";
  $data['user_object'] = $this->get_user_object();
 $data['main_title'] = $this->get_title();
 echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
  
	
}
// The function accepts two arguments, order_by and date when order was created,
//  to list the order items on viewing an order
public function view_orders($order_by,$date_created,$option){
  $this->load->model('order/mdl_order');
  $data['section'] = "Stock";
  $data['subtitle'] = "View Orders";
  $data['page_title'] = " Orders";
  $data['orderitems']= $this->mdl_order->get_orderitems($order_by,$date_created);
  $data['option']=$option;
  $data['module'] = "order";
  $data['view_file'] = "order_view";
  $data['user_object'] = $this->get_user_object();
  $data['main_title'] = $this->get_title();
  echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
  
}
public function prepare_orders($content_array = array()){  

 $this->load->model('vaccines/mdl_vaccines');
 $data['vaccines']= $this->mdl_vaccines->getVaccine();

if (!empty($content_array)) {
  $orderitems=$content_array;
  $data['orderitems']=$orderitems['orderitems'];
}
  $data['section'] = "Vaccines";
  $data['subtitle'] = "Orders";
  $data['page_title'] = " Order";
  $data['module'] = "order";
  $data['options']="view";
  $data['view_file'] = "create_order_form";
  $data['user_object'] = $this->get_user_object();
  $data['main_title'] = $this->get_title();
  echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
}
// Function to save the orders. Order items are posted to this function,
// where they are stored in an array to be stored in the database
function save_order(){       
  //Order Information
    $data2['user_object2'] = $this->get_user_object();
       $data3['user_object3'] = $this->get_user_object();
       //print_r($data2); die();
       $user_level= $data2['user_object2']['user_level'];
       $station_name=$data3['user_object3']['user_statiton'];
       $date_created = $this -> input -> post('created');
       $user_id= $this->input->post('user');
       $order_array['station_level']=$user_level;
       $order_array['station_id']=$station_name;
       $order_array['date_created']=$date_created;
       $order_array['order_by']=$user_id;
       $this->db->insert('m_order', $order_array);
       $order_id = $this -> db -> insert_id(); 
        

  //Order item information
       $stock_on_hand = $this -> input -> post("stock_on_hand");
       $min_stock = $this -> input -> post("min_stock");
       $max_stock = $this -> input -> post("max_stock");
       $first_expiry_date = $this -> input -> post("first_expiry_date");
       $quantity_dose = $this -> input -> post("quantity_dose");
       $vaccines = $this -> input -> post('vaccine');
       //echo '<pre>';
       //print_r($vaccines);die();

       $vaccine_array=array();
       $vaccine_counter=0;
    
    foreach ($vaccines as $vaccine) {
       
         $vaccine_array[$vaccine_counter]['vaccine_id']=$vaccines[$vaccine_counter];
         $vaccine_array[$vaccine_counter]['stock_on_hand']=$stock_on_hand[$vaccine_counter];
         $vaccine_array[$vaccine_counter]['min_stock']=$min_stock[$vaccine_counter];
         $vaccine_array[$vaccine_counter]['max_stock']=$max_stock[$vaccine_counter];
         $vaccine_array[$vaccine_counter]['first_expiry']=$first_expiry_date[$vaccine_counter];
         $vaccine_array[$vaccine_counter]['qty_order_doses']=$quantity_dose[$vaccine_counter];
         $vaccine_array[$vaccine_counter]['order_id']=$order_id[$vaccine_counter];
         
         $vaccine_counter++;
      
      }
     
      
      $main_array['own_vaccine']=$vaccine_array;

      // Add assigned order id to order items
      foreach ($main_array as $key => $value) {
        foreach ($value as $keyvac => $valuevac) {
          foreach ($valuevac as $keys => $values) {
            if ($keys == "order_id") {
            $temp[$keyvac]['order_id'] = $order_id;
          }  else{
            $temp[$keyvac][$keys] = $values;
          }
              
          }
        
        }
         
      }
      
      $this->db->insert_batch('order_item',$temp);    
 
 $this -> session ->set_flashdata('order_message','Orders Saved Successfully');
    redirect('order/list_orders');
    
}


function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_vaccines');
$query = $this->mdl_vaccines->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_vaccines');
$query = $this->mdl_vaccines->get_where($id);
return $query;
}

function get_where_custom($col, $value) { 
$this->load->model('mdl_vaccines');
$query = $this->mdl_vaccines->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_vaccines');
$this->mdl_vaccines->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_vaccines');
$this->mdl_vaccines->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_vaccines');
$this->mdl_vaccines->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_vaccines');
$count = $this->mdl_vaccines->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_vaccines');
$max_id = $this->mdl_vaccines->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_vaccines');
$query = $this->mdl_vaccines->_custom_query($mysql_query);
return $query;
}

}