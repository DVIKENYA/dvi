<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fridges extends MY_Controller {

function __construct() {
parent::__construct();
}
	public function index()
	{
		$this->load->model('mdl_fridges');
		$this->load->library('pagination');
		$this->load->library('table');
		$config['base_url'] = base_url().'/fridges/index';
		$config['total_rows'] = $this->mdl_fridges->get('id')->num_rows;
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
		$data['records'] = $this->db->get('m_fridges_view', $config['per_page'], $this->uri->segment(3));
		$data['section'] = "Configuration";
        $data['subtitle'] = "fridges";
        $data['page_title'] = "List Fridges";
		$data['module']="fridges";
		$data['view_file']="list_fridges_view";
        $data['user_object'] = $this->get_user_object();
           $data['main_title'] = $this->get_title();
           echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);	
	}
   	
	
	

		function create(){
            Modules::run('secure_tings/is_logged_in');
            $update_id= $this->uri->segment(3);
            $data = array();
            $this->load->model('mdl_fridges');
            
            if (!isset($update_id )){
                $update_id = $this->input->post('update_id', $id);
				$data['mafridge']  = $this->mdl_fridges->getModel();

            }
            
            if (is_numeric($update_id)){
                $data = $this->get_data_from_db($update_id);
                $data['update_id'] = $update_id;
				$data['mafridge']  = $this->mdl_fridges->getModel();

                
            } else {
            $data= $this->get_data_from_post();
			$data['mafridge']  = $this->mdl_fridges->getModel();


            }
           
            
            $data['section'] = "Configuration";
            $data['subtitle'] = "Fridges";
            $data['page_title'] = "Add Fridge";
	        $data['module'] = "fridges";
	        $data['view_file'] = "create_fridges_form";
			$data['user_object'] = $this->get_user_object();

 echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
			
		}
	function get_data_from_db($update_id){
		$query = $this->get_where($update_id);
		foreach ($query->result() as $row){
		  $data['model'] = $row->Model;
		  $data['date_added'] = $row->date_added;
		  
		  


		  }
		  return $data;
	  }
	function get_data_from_post(){
		
		$data['Model'] = $this->input->post('Model', TRUE);
		$data['date_added'] = $this->input->post('date_added', TRUE);		
		return $data;
	}
	function submit(){
    //fridge Information
	   $this->load->library('form_validation');

       $data2['user_object2'] = $this->get_user_object();
       $data3['user_object3'] = $this->get_user_object();
       //print_r($data2); die();
       $user_level= $data2['user_object2']['user_level'];
       $station_name=$data3['user_object3']['user_statiton'];
	   $model = $this -> input -> post('Model');
       $date_added = $this -> input -> post('date_added');
       $user_id= $this->input->post('user');
       $fridge_array['station_level']=$user_level;
       $fridge_array['station_id']=$station_name;
       $fridge_array['date_added']=$date_added;
       $fridge_array['user_id']=$user_id;
	   $fridge_array['Model']=$model;
       $this->db->insert('m_mfridge', $fridge_array);
	   
	  $data = array(
      'date_added'=>$this->input->post('date_added'),
      //'transaction_date'=>$this->input->post('date_received'),
     // 'source'=>$this->input->post('received_from'),
      'model' => $this->input->post('Model'),
       
       'user_id'=>$user_id,
       'station_level'=>$user_level,
       'station_id'=>$station_name
      );
     /* echo json_encode($data);*/
      $this->db->insert('m_mfridge',$data);  
      $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Fridge  added Successfully!</div>');
      redirect('fridges/');
		}
	
	function delete($id){
		$this->load->model('mdl_fridges');
		$this->mdl_fridges->_delete($id);
		$this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Fridge deleted successfully!</div>');
		redirect('fridges/','refresh');
	}		
	

	
function get($order_by){
$this->load->model('mdl_fridges');
$query = $this->mdl_fridges->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_fridges');
$query = $this->mdl_fridges->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_fridges');
$query = $this->mdl_fridges->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_fridges');
$query = $this->mdl_fridges->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_fridges');
$this->mdl_fridges->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_fridges');
$this->mdl_fridges->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_fridges');
$this->mdl_fridges->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_fridges');
$count = $this->mdl_fridges->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_fridges');
$max_id = $this->mdl_fridges->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_fridges');
$query = $this->mdl_fridges->_custom_query($mysql_query);
return $query;
}
}
	


