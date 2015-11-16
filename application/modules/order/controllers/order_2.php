<?php
class Order extends MY_Controller 
{

function __construct() {
parent::__construct();
}

function hello(){

  echo "hello";
}

function get($order_by){
$this->load->model('mdl_vaccines');
$query = $this->mdl_vaccines->get($order_by);
return $query;
}
public function create_order(){

  $this->load->model('vaccines/mdl_vaccines');
  $data['vaccines']= $this->mdl_vaccines->getVaccine();
  $data['section'] = "Vaccines";
  $data['subtitle'] = "Place Order";
  $data['page_title'] = "Place Order";
 	$data['module'] = "order";
   $data['options']="none";
	$data['view_file'] = "create_order_form";

	/*echo Modules::run('template/admin', $data);*/
  $this->template($data);
}
public function list_orders(){
  $this->load->model('order/mdl_order');
  $data['orders']= $this->mdl_order->get_orders();
  $data['section'] = "Vaccines";
  $data['subtitle'] = "Orders";
  $data['page_title'] = " Orders";
  $data['module'] = "order";
  $data['view_file'] = "list_order_view";
  echo Modules::run('template/admin', $data);
	
}
public function view_orders($order_id){
  $this->load->model('order/mdl_order');
  $data['orderitems']= $this->mdl_order->get_orderitems($order_id);
  $this -> prepare_orders($data);
  
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
  echo Modules::run('template/admin', $data);
}

public function save_order(){

 $save = $this -> input -> post("place_order");
 if ($save) {

  //Order Information
       $date_created = $this -> input -> post('created');
       $order_array['date_created']=$date_created; 
       $this->db->insert('order', $order_array);
       $order_id = $this -> db -> insert_id(); 

  //Order item information
       $stock_on_hand = $this -> input -> post("stock_on_hand");
       $min_stock = $this -> input -> post("min_stock");
       $max_stock = $this -> input -> post("max_stock");
       $first_expiry_date = $this -> input -> post("first_expiry_date");
       $quantity_dose = $this -> input -> post("quantity_dose");
       $vaccines = $this -> input -> post('vaccine');
       

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
      print_r($main_array);
            die();
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
 }
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