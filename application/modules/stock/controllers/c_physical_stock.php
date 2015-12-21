<?php
class C_Physical_Stock extends MY_Controller{
    function __construct() {
parent::__construct();
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
        
        $vaccine_id = $this->input->post('vaccine');
        $batch_number=$this->input->post('batch_no');
        $date_of_count=$this->input->post('date_of_count');
        $available_quantity=$this->input->post('available_quantity');
        $physical_count = $this->input->post('physical_count');
        $discrepancy = 0;

        $this->load->model('stock/mdl_stock');
        $this->mdl_stock->save_physical_count($vaccine_id,$batch_number,$date_of_count,$available_quantity,$physical_count,$discrepancy);
        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stock physical count updated successfully!</div>');
    }
   

}

