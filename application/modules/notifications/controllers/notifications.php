<?php
class Dashboard extends MY_Controller 
{

function __construct() {
parent::__construct();
Modules::run('secure_tings/is_logged_in');

}

function index() {
  Modules::run('secure_tings/is_logged_in');
 
  $data['section'] = "NVIP Chanjo";
  $data['subtitle'] = "Dashboard";
  $user_level=$this->session->userdata['logged_in']['user_level'];
  $data['view_file'] = "inbox_view";
  $data['module'] = "notifications";
  $data['id'] = ($this->session->userdata['logged_in']['user_id']);
  $data['user_level'] = ($this->session->userdata['logged_in']['user_level']);
  $data['user_object'] = $this->get_user_object();
  $data['main_title'] = $this->get_title();
  echo Modules::run('template/'.$this->redirect($this->session->userdata['logged_in']['user_group']), $data);

}

