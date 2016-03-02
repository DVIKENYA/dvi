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


    function receive_stock()
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('vaccines/mdl_vaccines');
        $data['vaccines'] = $this->mdl_vaccines->getVaccine();
        $this->load->model('stock/mdl_vvmstatus');
        $data['vvm_status'] = $this->mdl_vvmstatus->get_vvm();
        $this->load->model('stock/mdl_stock');
        $info['user_object'] = $this->get_user_object();
$user_level = $info['user_object']['user_level'];
        $user_id = $this->session->userdata['logged_in']['user_id'];
        $info['user_object'] = $this->get_user_object();
        $station_id = $info['user_object']['statiton_above'];
        if ($user_level == 1) {
            /*
            user_level = national
            retrieve all regions
            */
            $data['location'] = "National Arrival";
        } else {
            $data['location'] = $station_id;
        }
        $data['module'] = "stock";
        $data['view_file'] = "receive_stock";
        $data['section'] = "manage stock";
        $data['subtitle'] = "Receive Stock";
        $data['page_title'] = "Receive Stock";
        $data['orders'] = $this->get_orders();
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Receive Stocks', 'stock/list_receive_stock', 0);
        $this->make_bread->add('Receive Stocks Directly', '', 0);
        $data['breadcrumb'] = $this->make_bread->output();
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);
    }

    public function list_issue_stock()
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('order/mdl_order');
        $this->load->model('vaccines/mdl_vaccines');
        $this->load->model('stock/mdl_stock');
        $this->load->library('pagination');
        $this->load->library('table');
        $data['vaccines'] = $this->mdl_vaccines->getVaccine();
        $info['user_object'] = $this->get_user_object();
        $station = $info['user_object']['user_level'];
        $station_id = $info['user_object']['user_statiton'];
        
        $config['base_url'] = base_url().'/stock/list_issue_stock';
        $config['total_rows'] =$this->mdl_order->count_placed_orders($station, $station_id);
        $config['per_page'] = 10;
        $config['num_links'] = 4;
        $config["uri_segment"] = 3;
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

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data['orders'] = $this->mdl_order->get_placed_orders($station, $station_id, $config['per_page'],$page);
        
        $data['all_orders'] = $this->mdl_order->get_all_placed_orders($station, $station_id, $config['per_page'],$page);
        $this->pagination->initialize($config);

        $data['submitted_orders'] = $this->mdl_order->get_submitted_orders($station, $station_id);
        $data['section'] = "Manage Stock";
        $data['subtitle'] = "Issue Stocks";
        $data['page_title'] = "Issue Stocks";
        $data['module'] = "stock";
        $info['user_object'] = $this->get_user_object();
$user_level = $info['user_object']['user_level'];
        $user_id = $this->session->userdata['logged_in']['user_id'];
        if ($user_level == 1) {
            /*
            user_level = national
            retrieve all regions
            */
            $data['locations'] = $this->mdl_stock->get_region_base();
        } elseif ($user_level == 2) {
            /*
            user_level = regional
            retrieve all counties
            */
            $data['locations'] = $this->mdl_stock->get_county_base($user_id);
        } elseif ($user_level == 3) {
            /*
            user_level = county
            retrieve all subcounties
            */
            $data['locations'] = $this->mdl_stock->get_subcounty_base($user_id);
        } elseif ($user_level == 4) {
            /*
            user_level = subounty
            retrieve all facilities
            */
            $data['locations'] = $this->mdl_stock->get_facility_base($user_id);
        }
        if ($station == '1') {
            $data['view_file'] = "list_issue_stock";
        } else {
            $data['view_file'] = "list_issue_stock";
        }
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Issue Stocks', '', 0);
        $data['breadcrumb'] = $this->make_bread->output();
        //

        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);


    }

    public function list_receive_stock()
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('order/mdl_order');
        $this->load->model('vaccines/mdl_vaccines');
        $this->load->library('pagination');
        $this->load->library('table');
        $info['user_object'] = $this->get_user_object();
        $info['user_object'] = $this->get_user_object();
$user_level = $info['user_object']['user_level'];
        $info['user_object'] = $this->get_user_object();
        $station_id = $info['user_object']['statiton_above'];
        if ($user_level == 1) {
            /*
            user_level = national
            retrieve all regions
            */
            $data['location'] = "National Arrival";
        } else {
            $data['location'] = $station_id;
        }
        $station = $info['user_object']['user_level'];
        $station_id = $info['user_object']['user_statiton'];
        $data['vaccines'] = $this->mdl_vaccines->getVaccine();
        
        $config['base_url'] = base_url().'/stock/list_receive_stock';
        $config['total_rows'] =$this->mdl_order->count_placed_orders($station, $station_id);
        $config['per_page'] = 10;
        $config['num_links'] = 4;
        $config["uri_segment"] = 3;
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

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        $data['orders'] = $this->mdl_order->get_placed_orders($station, $station_id, $config['per_page'],$page);
        
        $data['all_orders'] = $this->mdl_order->get_all_placed_orders($station, $station_id, $config['per_page'],$page);
        $this->pagination->initialize($config);

        $data['submitted_orders'] = $this->mdl_order->get_submitted_orders($station, $station_id);
        $data['section'] = "Manage Stock";
        $data['subtitle'] = "Receive Stocks";
        $data['page_title'] = "Receive Stocks";
        $data['module'] = "stock";
        if ($station == '1') {
            $data['view_file'] = "receive_stock";
        } else {
            $data['view_file'] = "list_receive_stock";
        }
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Receive Stocks', '', 0);
        $data['breadcrumb'] = $this->make_bread->output();
        //
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);


    }

    function save_received_stock()
    {
        Modules::run('secure_tings/is_logged_in');
        $data2['user_object2'] = $this->get_user_object();
        $data3['user_object3'] = $this->get_user_object();
        $data4['user_object4'] = $this->get_user_object();
        $station_level = $data2['user_object2']['user_level'];
        $station_id = $data3['user_object3']['user_statiton'];
        $operator_id = $data4['user_object4']['user_id'];

        $data = array(
            'transaction_type' => $this->input->post('transaction_type'),
            'transaction_date' => $this->input->post('date_received'),
            'destination' => $station_id,
            'source' => $this->input->post('received_from'),
            'vaccine_id' => $this->input->post('vaccine'),
            's11' => $this->input->post('s11'),
            'batch_number' => $this->input->post('batch_no'),
            'expiry_date' => $this->input->post('expiry_date'),
            'quantity_in' => $this->input->post('quantity_received'),
            'VVM_status' => $this->input->post('vvm_status'),
            'user_id' => $operator_id,
            'station_level' => $station_level,
            'station_id' => $station_id
        );
        // echo json_encode($data);
        $this->db->insert('m_receive_stock', $data);
        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stock successfully received from <strong>' . $data['source'] . '</strong>!</div>');
    }

    function test(){
        Modules::run('secure_tings/is_logged_in');

        $data['module'] = "stock";
        $data['view_file'] = "test";
        $data['section'] = "manage stock";
        $data['subtitle'] = "Stocks Legder";
        $data['page_title'] = "Stocks Legder";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        //
        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Issue Stocks', 'stock/list_issue_stock', 0);
        $this->make_bread->add('Issue Stocks Directly', '', 0);
        $data['breadcrumb'] = $this->make_bread->output();
        //
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);

    }

    function issue_stock()
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('vaccines/mdl_vaccines');
        $this->load->model('stock/mdl_stock');
        $data['vaccines'] = $this->mdl_vaccines->getVaccine();
        $info['user_object'] = $this->get_user_object();
$user_level = $info['user_object']['user_level'];
        $user_id = $this->session->userdata['logged_in']['user_id'];
        if ($user_level == 1) {
            /* 
            user_level = national
            retrieve all regions 
            */
            $data['locations'] = $this->mdl_stock->get_region_base();
        } elseif ($user_level == 2) {
            /* 
            user_level = regional
            retrieve all counties 
            */
            $data['locations'] = $this->mdl_stock->get_county_base($user_id);
        } elseif ($user_level == 3) {
            /* 
            user_level = county
            retrieve all subcounties 
            */
            $data['locations'] = $this->mdl_stock->get_subcounty_base($user_id);
        } elseif ($user_level == 4) {
            /* 
            user_level = subounty
            retrieve all facilities 
            */
            $data['locations'] = $this->mdl_stock->get_facility_base($user_id);
        }
        $data['module'] = "stock";
        $data['view_file'] = "issue_stock";
        $data['section'] = "manage stock";
        $data['subtitle'] = "Issue Stock";
        $data['orders'] = $this->get_orders();
        $data['page_title'] = "Issue Stock";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Issue Stocks', 'stock/list_issue_stock', 0);
        $this->make_bread->add('Issue Stocks Directly', '', 0);
        $data['breadcrumb'] = $this->make_bread->output();
        //
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);

    }

    function list_inventory()
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('vaccines/mdl_vaccines');
        $data['vaccines'] = $this->mdl_vaccines->get_vaccine_details();
        $data['module'] = "stock";
        $data['view_file'] = "inventory";
        $data['section'] = "manage stock";
        $data['subtitle'] = "Stocks Legder";
        $data['page_title'] = "Stocks Legder";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Stocks Ledger', '', 0);
        $data['breadcrumb'] = $this->make_bread->output();
        //

        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);

    }

    function get_vaccine_ledger($selected_vaccine)
    {
        // This function gets the ledger of the selected vaccine
        /*alert ($selected_vaccine); */
        Modules::run('secure_tings/is_logged_in');
        $id = $this->uri->segment(3);
        $data['id'] = $id;
        $this->load->model('stock/mdl_stock');
        $this->load->model('vaccines/mdl_vaccines');
        $data['vaccines'] = $this->mdl_vaccines->get_vaccine_details();
        $data['user_object'] = $this->get_user_object();
        $station_id = $data['user_object']['user_statiton'];
        $data['bal'] = $this->mdl_stock->get_stock_balance($selected_vaccine, $station_id);
        $data['module'] = "stock";
        $data['view_file'] = "vaccine_ledger";
        $data['section'] = "manage stock";
        $data['subtitle'] = "Stocks Ledger";
        $data['page_title'] = "Stocks Ledger";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Stocks Ledger', 'stock/list_inventory', 1);

        $data['breadcrumb'] = $this->make_bread->output();
        //

        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);
        //echo Modules::run('template/admin', $data);

    }

    function vaccine_count()
    {

        $id = $this->uri->segment(3);
        $this->load->model('stock/mdl_stock');
        $data['user_object'] = $this->get_user_object();
        $station_id = $data['user_object']['user_statiton'];
        $query = $this->mdl_stock->get_all_physical_counts($id, $station_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($query->result() as $bal) {
            $no++;
            $row = array();
            $row[] = date("Y-m-d", strtotime($bal->date_of_count));
            $row[] = $bal->Vaccine_name;
            $row[] = $bal->batch_number;
            $row[] = $bal->expiry_date;
            $row[] = $bal->stock_balance;
            $data[] = $row;

        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdl_stock->get_all_physical_counts($id, $station_id)->num_rows(),
            "recordsFiltered" => $this->mdl_stock->get_all_physical_counts($id, $station_id)->num_rows(),
            "data" => $data,
        );

        echo json_encode($output);

    }

    function batch_summary()
    {

        $id = $this->uri->segment(3);
        $this->load->model('stock/mdl_stock');
        $data['user_object'] = $this->get_user_object();
        $station_id = $data['user_object']['user_statiton'];
        $query = $this->mdl_stock->get_batch_stock_summary($id, $station_id);
        $data = array();
        $no = $_POST['start'];
        foreach ($query->result_array() as $bal) {
            $no++;
            $row = array();

            $row[] = $bal['batch_number'];
            $row[] = $bal['expiry_date'];
            $row[] = $bal['stock_balance'];
            $data[] = $row;

        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->mdl_stock->get_batch_stock_summary($id, $station_id)->num_rows(),
            "recordsFiltered" => $this->mdl_stock->get_batch_stock_summary($id, $station_id)->num_rows(),
            "data" => $data,
        );

        echo json_encode($output);

    }

    function ledger_in()
    {
        Modules::run('secure_tings/is_logged_in');
        $id = $this->uri->segment(3);
        $this->load->model('stock/mdl_stock');
        $data['user_object'] = $this->get_user_object();
        $station_id = $data['user_object']['user_statiton'];
        
        $date = $_POST['columns'][0]['search']['value'];
        $range = explode("/", $date);
        if(!empty($range[0] )){
            $date = explode("/", $date);
            $option = "in";
            $query = $this->mdl_stock->show_data_by_date_range($option, $date, $id, $station_id);

        }else{
            $query = $this->mdl_stock->get_vaccine_ledger_in( $id, $station_id);
        }
        
        $data = array();
        
        $no = $_POST['start'];
        foreach ($query as $bal) {
            $no++;
            $row = array();
            $row[] = date("Y-m-d", strtotime($bal->date_received));
            $row[] = $bal->vaccine_name;
            $row[] = $bal->amount_received;
            $row[] = $bal->batch_no;
            $row[] = $bal->expiry_date;
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

    function ledger_out()
    {
        Modules::run('secure_tings/is_logged_in');
        $id = $this->uri->segment(3);
        $this->load->model('stock/mdl_stock');
        $data['user_object'] = $this->get_user_object();
        $station_id = $data['user_object']['user_statiton'];
        
        $date = $_POST['columns'][0]['search']['value'];
        $range = explode("/", $date);
        if(!empty($range[0])){
            $date = explode("/", $date);
            $option = "out";
            $query = $this->mdl_stock->show_data_by_date_range($option, $date, $id, $station_id);

        }else{
            $query = $this->mdl_stock->get_vaccine_ledger_out($id, $station_id);
        }
        
        $data = array();
        $no = $_POST['start'];
        foreach ($query as $bal) {
            $no++;
            $row = array();
            $row[] = date("Y-m-d", strtotime($bal->date_issued));
            $row[] = $bal->vaccine_name;
            $row[] = $bal->issued_to;
            $row[] = $bal->amount_issued;
            $row[] = $bal->batch_no;
            $row[] = $bal->expiry_date;
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


    function store_balance($selected_vaccine)
    {
        $data['user_object'] = $this->get_user_object();
        $station_id = $data['user_object']['user_statiton'];
        $this->load->model('stock/mdl_stock');
        $query = $this->mdl_stock->get_store_balance($selected_vaccine, $station_id);
        echo json_encode($query);

    }

    function transfer_stock()
    {
        $data['module'] = "stock";
        $data['view_file'] = "transfer_stock";
        $data['section'] = "manage stock";
        $data['subtitle'] = "Transfer Stock";
        $data['page_title'] = "Transfer Stock";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);
        //echo Modules::run('template/admin', $data);
    }

    function get_batches()
    {
        Modules::run('secure_tings/is_logged_in');
        $data['user_object'] = $this->get_user_object();
        $station_id = $data['user_object']['user_statiton'];
        $selected_vaccine = $this->input->post('selected_vaccine');
        $this->load->model('stock/mdl_stock');
        $data = $this->mdl_stock->get_batches($selected_vaccine, $station_id);
        /* echo json_encode($selected_vaccine);*/
        echo json_encode($data);
    }

    function get_batch_details()
    {
        // Gets moore details of the batch selected
        $data['user_object'] = $this->get_user_object();
        $station_id = $data['user_object']['user_statiton'];
        $selected_batch = $this->input->post('selected_batch');
        $this->load->model('stock/mdl_stock');
        $data = $this->mdl_stock->get_batch_details($selected_batch, $station_id);
        /* echo json_encode($selected_vaccine);*/
        echo json_encode($data);
    }

    function get_order_batch()
    {
        //Modules::run('secure_tings/is_logged_in');
        $info['user_object'] = $this->get_user_object();
        $station_id = $info['user_object']['user_statiton'];
        $this->load->model('mdl_stock');
        $order_id = $this->input->post('order_id');
        $selected_batch = $this->input->post('selected_batch');

        $data_array = array();
        foreach ($selected_batch as $item) {
            $query = $this->mdl_stock->get_order_batch($order_id, $item['selected_batch'], $station_id);

            foreach ($query as $row) {
                //var_dump($query);
                $data['vaccine_id'] = $row->vaccine_id;
                $data['batch_no'] = $row->batch_number;
                // $data['expiry_date'] = $row->expiry_date;
                // $data['vvm_status'] = $row->name;
                $data_array['issue_row' . $row->vaccine_id][] = $data;

            }

        }
        echo json_encode($data_array);
        // $this->output->enable_profiler(TRUE);
    }


    function get_order_batch_details()
    {
        // Gets more details of the batch selected
        $data['user_object'] = $this->get_user_object();
        $station_id = $data['user_object']['user_statiton'];
        $order_id = $this->input->post('order_id');
        $selected_batch = $this->input->post('selected_batch');
        $this->load->model('stock/mdl_stock');
        $data = $this->mdl_stock->get_order_batch_details($selected_batch, $order_id, $station_id);
        echo json_encode($data);
    }

    function get_orders()
    {
        $data['user_object'] = $this->get_user_object();
        $station_id = $data['user_object']['user_statiton'];
        $this->load->model('stock/mdl_stock');
        $query = $this->mdl_stock->get_orders($station_id);
        return $query;
        //var_dump($query);
    }


    function count_all()
    {
        $this->load->model('stock/mdl_stock');
        $query = $this->mdl_stock->count_all();
        return $query;
    }

    function count_filtered($id, $user_id)
    {
        $this->load->model('stock/mdl_stock');
        $query = $this->mdl_stock->count_filtered($id, $user_id);
        return $query;
    }

    function physical_count()
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('vaccines/mdl_vaccines');
        $data['vaccines'] = $this->mdl_vaccines->getVaccine();
        $data['module'] = "stock";
        $data['view_file'] = "physical_stock";
        $data['section'] = "manage stock";
        $data['subtitle'] = "Stock Count";
        $data['page_title'] = "Stock Count";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();

        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Stock Count', '', 0);
        $data['breadcrumb'] = $this->make_bread->output();
        //
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);
    }

    function save_physical_count()
    {
        Modules::run('secure_tings/is_logged_in');
        $data['user_object'] = $this->get_user_object();
        $station_name = $data['user_object']['user_statiton'];
        $user_id = $data['user_object']['user_id'];
        $user_level = $data['user_object']['user_level'];
        $save_data = array(
            'vaccine_id' => $this->input->post('vaccine'),
            'batch_number' => $this->input->post('batch_no'),
            'expiry_date' => $this->input->post('expiry_date'),
            'available_quantity' => $this->input->post('available_quantity'),
            'date_of_count' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s'))),
            'physical_count' => $this->input->post('physical_count'),
            'station_id' => $station_name,
            'user_id' => $user_id,
            'station_level' => $user_level,
            'order_id' => $this->input->post('id')

        );
        $this->load->model('stock/mdl_stock');
        $this->mdl_stock->save_physical_count($save_data);
        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stock physical count updated successfully!</div>');

    }

    function issue_stocks()
    {

        Modules::run('secure_tings/is_logged_in');
        $order_id = $this->uri->segment(3);
        $data['order_id'] = $order_id;
        $data2['user_object2'] = $this->get_user_object();
        $station_name = $data2['user_object2']['user_statiton'];
        $this->load->model('vaccines/mdl_vaccines');
        $data['vaccines'] = $this->mdl_vaccines->getVaccine();
        $this->load->model('mdl_stock');
        $data['issues'] = $this->mdl_stock->get_order_to_issue($order_id, $station_name);
        $data['order_infor'] = $this->mdl_stock->get_order_infor($order_id);
        $data['module'] = "stock";
        $data['view_file'] = "new_issue_stock";
        $data['section'] = "manage stock";
        $data['subtitle'] = "Issue Stock";
        $data['page_title'] = "Issue Stock";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Issue Stocks', 'stock/list_issue_stock', 1);
        $this->make_bread->add('Issue', '', 0);


        $data['breadcrumb'] = $this->make_bread->output();
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);

    }

    function new_save_issued_stock()
    {
        //Modules::run('secure_tings/is_logged_in');
        //Issue Stock Information
        $data2['user_object2'] = $this->get_user_object();
        $data3['user_object3'] = $this->get_user_object();


        $order_id = $this->input->post('order');
        $S11 = $this->input->post('s11');
        $date_issued = $this->input->post('date_issued');
        $date_recorded = $this->input->post('date_recorded');
        $user_id = $data2['user_object2']['user_id'];
        $user_level = $data2['user_object2']['user_level'];
        $station_name = $data3['user_object3']['user_statiton'];


        $issue_array['order_id'] = $order_id;
        $issue_array['S11'] = $S11;
        $issue_array['date_issued'] = $date_issued;
        $issue_array['date_recorded'] = $date_recorded;
        $issue_array['issued_by_user'] = $user_id;
        $issue_array['issued_by_station_level'] = $user_level;
        $issue_array['issued_by_station_id'] = $station_name;

        $this->db->insert('m_issue_stock', $issue_array);
        $issue_id = $this->db->insert_id();

        // Issue Stock Item Information
        $vaccine = $this->input->post('vaccine');
        $batch_no = $this->input->post('batch_no');
        $expiry_date = $this->input->post('expiry_date');
        $amount_ordered = $this->input->post('amt_ordered');
        $stock_quantity = $this->input->post('available_quantity');
        $amount_issued = $this->input->post('amt_issued');
        $vvm_status = $this->input->post('vvm_status');
        $comment = $this->input->post('comment');

        $issue_array = array();
        $issue_counter = 0;

        foreach ($vaccine as $vaccines) {
            $issue_array[$issue_counter]['vaccine_id'] = $vaccine[$issue_counter];
            $issue_array[$issue_counter]['batch_no'] = $batch_no[$issue_counter];
            $issue_array[$issue_counter]['expiry_date'] = $expiry_date[$issue_counter];
            $issue_array[$issue_counter]['vvm_status'] = $vvm_status[$issue_counter];
            $issue_array[$issue_counter]['stock_on_hand'] = $stock_quantity[$issue_counter];
            $issue_array[$issue_counter]['amount_ordered'] = $amount_ordered[$issue_counter];
            $issue_array[$issue_counter]['amount_issued'] = $amount_issued[$issue_counter];
            $issue_array[$issue_counter]['comment'] = $comment[$issue_counter];
            $issue_array[$issue_counter]['issue_id'] = $issue_id[$issue_counter];

            $issue_counter++;
        }

        $main_array['own_issues'] = $issue_array;
        // Add assigned issue id to issue items
        foreach ($main_array as $key => $value) {
            foreach ($value as $keyvac => $valuevac) {
                foreach ($valuevac as $keys => $values) {
                    if ($keys == "issue_id") {
                        $temp[$keyvac]['order_id'] = $order_id;
                        $temp[$keyvac]['issue_id'] = $issue_id;
                    } else {
                        $temp[$keyvac][$keys] = $values;
                    }


                }

            }

        }
        echo json_encode($temp);

        $this->db->insert_batch('m_issue_stock_item', $temp);

        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stocks have been issued successfully</div>');
        redirect('order/list_orders');
    }

    function save_issued_stock()
    {
        Modules::run('secure_tings/is_logged_in');
        $data2['user_object2'] = $this->get_user_object();
        $data3['user_object3'] = $this->get_user_object();


        $issued_to = $this->input->post('issued_to');
        $S11 = $this->input->post('s11');
        $date_issued = $this->input->post('date_issued');
        $date_recorded = $this->input->post('date_recorded');
        $user_id = $data2['user_object2']['user_id'];
        $user_level = $data2['user_object2']['user_level'];
        $station_name = $data3['user_object3']['user_statiton'];


        //$issue_array['order_id']=$order_id;
        $issue_array['S11'] = $S11;
        $issue_array['date_issued'] = $date_issued;
        $issue_array['issued_to'] = $issued_to;
        $issue_array['date_recorded'] = $date_recorded;
        $issue_array['issued_by_user'] = $user_id;
        $issue_array['issued_by_station_level'] = $user_level;
        $issue_array['issued_by_station_id'] = $station_name;

        $this->db->insert('m_issue_stock', $issue_array);
        $issue_id = $this->db->insert_id();

        $batch = stripcslashes($_POST['batch']);
        $batch = json_decode($batch, TRUE);

        $issue_array = array();
        $issue_counter = 0;

        foreach ($batch as $item) {
            $issue_array[$issue_counter]['vaccine_id'] = $item['vaccine_id'];
            $issue_array[$issue_counter]['batch_no'] = $item['batch_no'];
            $issue_array[$issue_counter]['expiry_date'] = $item['expiry_date'];
            $issue_array[$issue_counter]['vvm_status'] = $item['vvm_status'];
            $issue_array[$issue_counter]['amount_ordered'] = $item['amount_ordered'];
            $issue_array[$issue_counter]['amount_issued'] = $item['amount_issued'];
            $issue_array[$issue_counter]['issue_id'] = $issue_id[$issue_counter];

            $issue_counter++;
        }

        $main_array['own_issues'] = $issue_array;
        // Add assigned issue id to issue items
        foreach ($main_array as $key => $value) {
            foreach ($value as $keyvac => $valuevac) {
                foreach ($valuevac as $keys => $values) {
                    if ($keys == "issue_id") {
                        $temp[$keyvac]['issue_id'] = $issue_id;
                    } else {
                        $temp[$keyvac][$keys] = $values;
                    }


                }

            }
            echo json_encode($temp);

            $this->db->insert_batch('m_issue_stock_item', $temp);

        }


        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Stocks have been issued successfully</div>');
        redirect('order/list_orders');

    }

    function receive_stocks($order_id)
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('vaccines/mdl_vaccines');
        $data['vaccines'] = $this->mdl_vaccines->getVaccine();
        $this->load->model('stock/mdl_vvmstatus');
        $data['vvm_status'] = $this->mdl_vvmstatus->get_vvm();
        $this->load->model('mdl_stock');
        $data['receipts'] = $this->mdl_stock->get_order_to_receive($order_id);
        $data['module'] = "stock";
        $data['view_file'] = "new_receive_stock";
        $data['section'] = "manage stock";
        $data['subtitle'] = "Receive Stock";
        $data['page_title'] = "Receive Stock";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();

        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stocks', '', 0);
        $this->make_bread->add('Receive Stocks', 'stock/list_receive_stock', 1);
        $this->make_bread->add('Receive', '', 0);


        $data['breadcrumb'] = $this->make_bread->output();
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);
    }


    function new_save_received_stock()
    {
        Modules::run('secure_tings/is_logged_in');
        //Receive Stock Information
        $data2['user_object2'] = $this->get_user_object();

        $issue_id = $this->input->post('issue_id');
        $order_id = $this->input->post('order_id');
        $S11 = $this->input->post('s11');
        $date_received = $this->input->post('date_received');
        $date_recorded = $this->input->post('date_recorded');
        $user_id = $data2['user_object2']['user_id'];
        $user_level = $data2['user_object2']['user_level'];
        $station_name = $data2['user_object2']['user_statiton'];

        $receive_array['issue_id'] = $issue_id;
        $receive_array['order_id'] = $order_id;
        $receive_array['S11'] = $S11;
        $receive_array['date_received'] = $date_received;
        $receive_array['date_recorded'] = $date_recorded;
        $receive_array['received_by_user'] = $user_id;
        $receive_array['station_level'] = $user_level;
        $receive_array['station_id'] = $station_name;

        $this->db->insert('m_receive_stock', $receive_array);
        $receive_id = $this->db->insert_id();

        // Receive Stock Item Information
        $vaccine = $this->input->post('vaccine');
        $batch_no = $this->input->post('batch_no');
        $expiry_date = $this->input->post('expiry_date');
        $amount_ordered = $this->input->post('quantity_ordered');
        $amount_received = $this->input->post('quantity_received');
        $vvm_status = $this->input->post('vvm_status');
        $comment = $this->input->post('comment');

        $receive_array = array();
        $receive_counter = 0;

        foreach ($vaccine as $vaccines) {
            $receive_array[$receive_counter]['vaccine_id'] = $vaccine[$receive_counter];
            $receive_array[$receive_counter]['batch_no'] = $batch_no[$receive_counter];
            $receive_array[$receive_counter]['expiry_date'] = $expiry_date[$receive_counter];
            $receive_array[$receive_counter]['vvm_status'] = $vvm_status[$receive_counter];
            $receive_array[$receive_counter]['amount_ordered'] = $amount_ordered[$receive_counter];
            $receive_array[$receive_counter]['amount_received'] = $amount_received[$receive_counter];
            $receive_array[$receive_counter]['comment'] = $comment[$receive_counter];
            $receive_array[$receive_counter]['receive_id'] = $receive_id[$receive_counter];

            $receive_counter++;
        }

        $main_array['own_receipts'] = $receive_array;
        // Add assigned receive id to received items
        foreach ($main_array as $key => $value) {
            foreach ($value as $keyvac => $valuevac) {
                foreach ($valuevac as $keys => $values) {
                    if ($keys == "receive_id") {
                        $temp[$keyvac]['receive_id'] = $receive_id;
                    } else {
                        $temp[$keyvac][$keys] = $values;
                    }

                }

            }

        }

        $this->db->insert_batch('m_receive_stock_item', $temp);

        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Received stocks have been saved successfully</div>');
        redirect('order/list_orders');
    }

    function save_received_stocks()
    {
        Modules::run('secure_tings/is_logged_in');

        $data['user_object'] = $this->get_user_object();

        $S11 = $this->input->post('s11');
        $date_received = $this->input->post('date_received');
        $date_recorded = $this->input->post('date_recorded');
        $received_from = $this->input->post('received_from');
        $user_id = $data['user_object']['user_id'];
        $user_level = $data['user_object']['user_level'];
        $station_name = $data['user_object']['user_statiton'];

//        $receive_array['order_id']=$order_id;
        $receive_array['S11'] = $S11;
        $receive_array['date_received'] = $date_received;
        $receive_array['date_recorded'] = $date_recorded;
        $receive_array['received_from'] = $received_from;
        $receive_array['received_by_user'] = $user_id;
        $receive_array['station_level'] = $user_level;
        $receive_array['station_id'] = $station_name;

        $this->db->insert('m_receive_stock', $receive_array);
        $receive_id = $this->db->insert_id();

        $batch = stripcslashes($_POST['batch']);
        $batch = json_decode($batch, TRUE);

        $receive_array = array();
        $receive_counter = 0;

        foreach ($batch as $item) {
            $receive_array[$receive_counter]['vaccine_id'] = $item['vaccine_id'];
            $receive_array[$receive_counter]['batch_no'] = $item['batch_no'];
            $receive_array[$receive_counter]['expiry_date'] = $item['expiry_date'];
            $receive_array[$receive_counter]['vvm_status'] = $item['vvm_status'];
            $receive_array[$receive_counter]['amount_received'] = $item['amount_received'];
            $receive_array[$receive_counter]['receive_id'] = $receive_id[$receive_counter];

            $receive_counter++;
        }

        $main_array[] = $receive_array;
        // Add assigned receive id to received items
        foreach ($main_array as $key => $value) {
            foreach ($value as $keyvac => $valuevac) {
                foreach ($valuevac as $keys => $values) {
                    if ($keys == "receive_id") {
                        $temp[$keyvac]['receive_id'] = $receive_id;
                    } else {
                        $temp[$keyvac][$keys] = $values;
                    }
                }

            }
            $this->db->insert_batch('m_receive_stock_item', $temp);

        }

        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Received stocks have been saved successfully</div>');
        redirect('order/list_orders');
    }

}
