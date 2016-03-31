<?php

class Vaccines extends MY_Controller
{

    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->model('mdl_vaccines');
        $this->load->library('pagination');
        $this->load->library('table');
        $config['base_url'] = base_url() . '/vaccines/index';
        $config['total_rows'] = $this->mdl_vaccines->get('id')->num_rows;
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
        // $data['query'] = $this->mdl_region->get('id', $config['per_page'], $this->uri->segment(3));
        $data['records'] = $this->db->get('m_vaccines', $config['per_page'], $this->uri->segment(3));
        //$this->load->view('display', $data);
        $data['module'] = "vaccines";
        $data['view_file'] = "list_vaccines_view";
        $data['section'] = "Configuration";
        $data['subtitle'] = "List Vaccines";
        $data['page_title'] = "Vaccines";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        $this->load->library('make_bread');
        $this->make_bread->add('Configurations', '', 0);
        $this->make_bread->add('List Vaccines', '', 0);

        $data['breadcrumb'] = $this->make_bread->output();
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);
    }


    function create()
    {

        $update_id = $this->uri->segment(3);
        $data = array();
        $this->load->model('mdl_vaccines');

        if (!isset($update_id)) {
            $update_id = $this->input->post('update_id', $id);
            $data['mavaccine'] = $this->mdl_vaccines->getVaccine();
        }

        if (is_numeric($update_id)) {
            $data = $this->get_data_from_db($update_id);
            $data['update_id'] = $update_id;
            $data['mavaccine'] = $this->mdl_vaccines->getVaccine();

        } else {
            $data = $this->get_data_from_post();
            $data['mavaccine'] = $this->mdl_vaccines->getVaccine();
        }

        $data['module'] = "vaccines";
        $data['view_file'] = "create_vaccines_form";
        $data['section'] = "Configuration";
        $data['subtitle'] = "Add Vaccine";
        $data['page_title'] = "Vaccines";

        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        $this->load->library('make_bread');
        $this->make_bread->add('Configurations', '', 0);
        $this->make_bread->add('List Vaccines', 'vaccines/', 1);
        $this->make_bread->add('Edit Vaccines', '', 0);
        $data['breadcrumb'] = $this->make_bread->output();
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);
    }


    function get_data_from_post()
    {

        $data['Vaccine_name'] = $this->input->post('Vaccine_name', TRUE);
        $data['Doses_required'] = $this->input->post('Doses_required', TRUE);
        $data['Wastage_factor'] = $this->input->post('Wastage_factor', TRUE);
        $data['Vaccine_formulation'] = $this->input->post('Vaccine_formulation', TRUE);
        $data['Mode_administration'] = $this->input->post('Mode_administration', TRUE);
        $data['Vaccine_presentation'] = $this->input->post('Vaccine_presentation', TRUE);
        $data['Vaccine_pck_vol'] = $this->input->post('Vaccine_pck_vol', TRUE);
        $data['Vaccine_price_dose'] = $this->input->post('Vaccine_price_dose', TRUE);

        return $data;
    }

    function get_data_from_db($update_id)
    {
        $query = $this->get_where($update_id);

        foreach ($query->result() as $row) {
            $data['Vaccine_name'] = $row->Vaccine_name;
            $data['Doses_required'] = $row->Doses_required;
            $data['Wastage_factor'] = $row->Wastage_factor;
            $data['Vaccine_formulation'] = $row->Vaccine_formulation;
            $data['Mode_administration'] = $row->Mode_administration;
            $data['Vaccine_presentation'] = $row->Vaccine_presentation;
            $data['Fridge_compart'] = $row->Fridge_compart;
            $data['Vaccine_pck_vol'] = $row->Vaccine_pck_vol;
            $data['Vaccine_price_dose'] = $row->Vaccine_price_dose;


        }
        return $data;
    }

    function submit()
    {

        $this->load->library('form_validation');
        $this->form_validation->set_rules('Vaccine_name', 'Vaccine Name', 'required|alpha_dash|xss_clean');
        $this->form_validation->set_rules('Doses_required', 'Doses Required', 'required|integer|xss_clean');
        $this->form_validation->set_rules('Wastage_factor', 'Wastage Factor', 'required|decimal|xss_clean');
        $this->form_validation->set_rules('Vaccine_formulation', 'Vaccine Formulation', 'required||xss_clean');
        $this->form_validation->set_rules('Mode_administration', 'Mode of Administration', 'required||xss_clean');
        $this->form_validation->set_rules('Vaccine_presentation', 'Vaccine Presentation', 'required||xss_clean');

        $this->form_validation->set_rules('Vaccine_pck_vol', 'Vaccine Packed Volume(cm3/dose)', 'required|numeric|xss_clean');
        $this->form_validation->set_rules('Vaccine_price_dose', 'Vaccine Price($USD/Dose)', 'required|numeric|xss_clean');
        $this->form_validation->set_error_delimiters('<p class="red_text semi-bold">' . '*', '</p>');
        $update_id = $this->input->post('update_id', TRUE);
        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = $this->get_data_from_post();

            if (is_numeric($update_id)) {
                $this->_update($update_id, $data);
                $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Vaccine details updated successfully!</div>');

            } else {
                $this->_insert($data);
                $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">New Vaccine added successfully!</div>');
            }

            redirect('vaccines');
        }
    }


    function delete($id)
    {
        $this->_delete($id);
        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Vaccine details deleted successfully!</div>');
        redirect('vaccines');
    }

    /*function getVaccine(){
    $this->load->model('mdl_vaccines');
    $query = $this->mdl_vaccines->getVaccine();
    return $query;
    }*/

    function get($order_by)
    {
        $this->load->model('mdl_vaccines');
        $query = $this->mdl_vaccines->get($order_by);
        return $query;
    }

    function get_with_limit($limit, $offset, $order_by)
    {
        $this->load->model('mdl_vaccines');
        $query = $this->mdl_vaccines->get_with_limit($limit, $offset, $order_by);
        return $query;
    }

    function get_where($id)
    {
        $this->load->model('mdl_vaccines');
        $query = $this->mdl_vaccines->get_where($id);
        return $query;
    }

    function get_where_custom($col, $value)
    {
        $this->load->model('mdl_vaccines');
        $query = $this->mdl_vaccines->get_where_custom($col, $value);
        return $query;
    }

    function _insert($data)
    {
        $this->load->model('mdl_vaccines');
        $this->mdl_vaccines->_insert($data);
    }

    function _update($id, $data)
    {
        $this->load->model('mdl_vaccines');
        $this->mdl_vaccines->_update($id, $data);
    }

    function _delete($id)
    {
        $this->load->model('mdl_vaccines');
        $this->mdl_vaccines->_delete($id);
    }

    function count_where($column, $value)
    {
        $this->load->model('mdl_vaccines');
        $count = $this->mdl_vaccines->count_where($column, $value);
        return $count;
    }

    function get_max()
    {
        $this->load->model('mdl_vaccines');
        $max_id = $this->mdl_vaccines->get_max();
        return $max_id;
    }

    function _custom_query($mysql_query)
    {
        $this->load->model('mdl_vaccines');
        $query = $this->mdl_vaccines->_custom_query($mysql_query);
        return $query;
    }

}