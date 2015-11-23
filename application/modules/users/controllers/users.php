<?php
class Users extends MY_Controller 
{
    function __construct() {
        parent::__construct();
        $this->load->model('mdl_users');

    }

    function index(){
        $data['module']="users";
        $data['view_file']="login_form";
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/home', $data); 
    }

    function list_users(){

      Modules::run('secure_tings/is_logged_in');
       $this->load->model('mdl_users');
       $this->load->library('pagination');
       $this->load->library('table');
       $config['base_url'] = base_url().'/users/list_users';
       $config['total_rows'] = $this->mdl_users->get('id')->num_rows;
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
          // $data['query'] = $this->mdl_region->get('id', $config['per_page'], $this->uri->segment(3));
       $data['records'] = $this->db->get('m_users', $config['per_page'], $this->uri->segment(3));
           //$this->load->view('display', $data);
       $data['module']="users";
       $data['view_file']="list_user_view";
       $data['section'] = "Configuration";
       $data['subtitle'] = "List Users";
       $data['page_title'] = "Users";
       $data['user_object'] = $this->get_user_object();
       $data['main_title'] = $this->get_title();
       echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data); 



   }



function create_user(){
      //Modules::run('secure_tings/ni_admin');
  Modules::run('secure_tings/is_logged_in');
   $data= $this->get_register_data_from_post();
   $data['magroups']  = $this->mdl_users->get_user_groups();
   $data['malevels']  = $this->mdl_users->get_user_levels();
   $data['macounties']  = $this->mdl_users->get_counties();
   $data['masubcounty']  = $this->mdl_users->get_subcounty();
   $data['mafacilities']  = $this->mdl_users->get_facilities();
   $data['maregion']  = $this->mdl_users->getRegion();
   $data['section'] = "DVI Kenya";
   $data['subtitle'] = "Users";
   $data['page_title'] = "Add New Users";
   $data['module']="users";
   $data['view_file']="register1_form";
   $data['user_object'] = $this->get_user_object();
  $data['main_title'] = $this->get_title();
   echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);
}

// function getcounty_ajax() {
       
//         if (isset($_POST) && isset($_POST['region'])) {
//             $region_id = $_POST['region'];
//                  $macounties = $this->mdl_users->loadcountyfromregion($region_id);
//                      foreach ($macounties as $row) {
//                 $arrcounties[$row->id] = $row->county_name;
//             }
             
//             $data['county'] = $arrcountries;

//             // print form_dropdown('state',$arrstates);
//         } else {
//             $this->create_user();
//         }
    
//   }

function get_register_data_from_post(){
    $data['f_name']=$this->input->post('f_name', TRUE);
    $data['l_name']=$this->input->post('l_name', TRUE);
    $data['username']=$this->input->post('username', TRUE);
    $data['phone']=$this->input->post('phone', TRUE);
    $data['email']=$this->input->post('email', TRUE);
    $data['user_level']=$this->input->post('user_level', TRUE);
    $data['user_group']=$this->input->post('user_group', TRUE);
    return $data;
}


function register(){
Modules::run('secure_tings/is_logged_in');
    $this->load->library('form_validation');
    $this->form_validation->set_rules('f_name', 'First Name', 'required|xss_clean');
    $this->form_validation->set_rules('l_name', 'Last Name', 'required|xss_clean');
    $this->form_validation->set_rules('username', 'Username', 'required|xss_clean');
    $this->form_validation->set_rules('phone', 'Phone', 'required|xss_clean');
    $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
    $this->form_validation->set_rules('user_group', 'User Group', 'required|xss_clean');
    $this->form_validation->set_rules('user_level', 'Access Level', 'required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'required|xss_clean|matches[passwordc]');
    $this->form_validation->set_rules('passwordc', 'Password Confirm', 'required|xss_clean|matches[password');
    $this->form_validation->set_rules('national', 'National', 'xss_clean');
    $this->form_validation->set_rules('regional', 'Region', 'xss_clean');
    $this->form_validation->set_rules('countyuser', 'County', 'xss_clean');
    $this->form_validation->set_rules('subcountyuser', 'Sub County', 'xss_clean');
    $this->form_validation->set_rules('facilityuser', 'Facility', 'xss_clean');

    if ($this->form_validation->run() == FALSE)
    {   
        $this->create_user();         
    }
    else
    {       
        $data= $this->get_register_data_from_post();
        $password = $this->input->post('password', TRUE);
        $data_base['national']=$this->input->post('national', TRUE);
        $data_base['region']=$this->input->post('regional', TRUE);
        $data_base['county']=$this->input->post('countyuser', TRUE);
        $data_base['subcounty']=$this->input->post('subcountyuser', TRUE);
        $data_base['facility']=$this->input->post('facilityuser', TRUE);
        $data['password'] = Modules::run('secure_tings/hash_it', $password);

        $result = $this->mdl_users->_insert($data, $data_base);
        if ($result == TRUE) {
<<<<<<< HEAD
            //$this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">User Added Successfuly</div>');
=======
            $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">User Added Successfuly</div>');
>>>>>>> 5ce27d877dfd339616208f10ca68f5e09044c455
            redirect('users/create_user', 'refresh');
        } else {
            $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-danger text-center">Username already in use. Try a different one!</div>');
            redirect('users/create_user'); 
        }

    }
}

 function login_process() {
    $this->load->library('form_validation');
    $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
    $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

    if ($this->form_validation->run() == FALSE) {
        if(isset($this->session->userdata['logged_in'])){
            redirect('dashboard/home');
        }else{
           redirect('users'); 
        }
    } else {
         $data['username']=$this->input->post('username', TRUE);
         $password = $this->input->post('password', TRUE);
         $data['password'] = Modules::run('secure_tings/hash_it', $password);

         $result = $this->mdl_users->login($data);

        if ($result == TRUE) {

            $username = $this->input->post('username');
            $result = $this->mdl_users->fetch_user_information($username);
            if ($result != false) {
                // $session_data = array(
                //     'username' => $result[0]->user_name,
                //     'email' => $result[0]->user_email,
                //     );

                $userdata = array(
                'user_id' => $result[0]->id,
                'user_fname' => $result[0]->f_name,
                'user_lname' => $result[0]->l_name,
                'user_group'=> $result[0]->user_group,
                'user_level'=> $result[0]->user_level,
                'logged_in'=>TRUE
                );
                
// Add user data in session
                $this->session->set_userdata('logged_in', $userdata);
                redirect('dashboard/home');

            }
        } else {
            $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-danger text-center">Wrong username or password, Please try again!</div>');
            redirect('users'); 
        }
    }
}




function logout(){
    
    // Removing session data
    $sess_array = array(
    'user_id' => ''
    );
    $this->session->unset_userdata('logged_in', $sess_array);
    $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-danger text-center">Successfully Logout</div>');
    // $this->session->sess_destroy();
    redirect('users');
}


function get($order_by){
    $this->load->model('mdl_users');
    $query = $this->mdl_users->get($order_by);
    return $query;
}

function get_with_limit($limit, $offset, $order_by) {
    $this->load->model('mdl_users');
    $query = $this->mdl_users->get_with_limit($limit, $offset, $order_by);
    return $query;
}

function get_userRegion($user_id){
    $this->load->model('mdl_users');
    $data['regions'] = $this->mdl_users->get_userRegion($user_id);
print_r($data) ;  
 return $data;
   //echo var_dump($data);
}


function getCountyByRegion(){
$id = $this->uri->segment(3);
if(!isset($id)){
$data['error'] = "Region ID not received";
echo json_encode($data);
}else{
$this->load->model('mdl_users');
$query = $this->mdl_users->getCountyByRegion($id);
foreach ($query as $row){
  $array = array(
      'county_id'=> $row->id,
      'county_name'=>$row->county_name,
    );  
  $data[] = $array;
}
echo json_encode($data);
}
}

function getSubcountyByCounty(){
$id = $this->uri->segment(3);
if(!isset($id)){
$data['error'] = "County ID not received";
echo json_encode($data);
}else{
$this->load->model('mdl_users');
$query = $this->mdl_users->getSubcountyByCounty($id);
foreach ($query as $row){
$array = array(
      'subcounty_id'=> $row->id,
      'subcounty_name'=>$row->subcounty_name,
    );  
  $data[] = $array;
}
echo json_encode($data);
}
}

function getFacilityBySubcounty(){
$id = $this->uri->segment(3);
if(!isset($id)){
$data['error'] = "Subcounty ID not received";
echo json_encode($data);
}else{
$this->load->model('mdl_users');
$query = $this->mdl_users->getFacilityBySubcounty($id);
foreach ($query as $row){
$array = array(
      'facility_id'=> $row->id,
      'facility_name'=>$row->facility_name,
    );  
  $data[] = $array;
}
echo json_encode($data);
}
}

function get_where($id){
    $this->load->model('mdl_users');
    $query = $this->mdl_users->get_where($id);
    return $query;
}

function get_where_custom($col, $value) {
    $this->load->model('mdl_users');
    $query = $this->mdl_users->get_where_custom($col, $value);
    return $query;
}

        // function _insert($data,$data_base){
        //     $this->load->model('mdl_users');

        // }

function _update($id, $data){
    $this->load->model('mdl_users');
    $this->mdl_users->_update($id, $data);
}

function _delete($id){
    $this->load->model('mdl_users');
    $this->mdl_users->_delete($id);
}

function count_where($column, $value) {
    $this->load->model('mdl_users');
    $count = $this->mdl_users->count_where($column, $value);
    return $count;
}

function get_max() {
    $this->load->model('mdl_users');
    $max_id = $this->mdl_users->get_max();
    return $max_id;
}

function _custom_query($mysql_query) {
    $this->load->model('mdl_users');
    $query = $this->mdl_users->_custom_query($mysql_query);
    return $query;
}

}