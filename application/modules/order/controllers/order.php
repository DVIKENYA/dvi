<?php

class Order extends MY_Controller
{

    function __construct()
    {
        parent::__construct();

    }

    function get($order_by)
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('mdl_vaccines');
        $query = $this->mdl_vaccines->get($order_by);
        return $query;
    }

// Get information on the selected vaccines from orders
    public function get_order_values()
    {
        Modules::run('secure_tings/is_logged_in');
        $data2['user_object2'] = $this->get_user_object();
        $station = $data2['user_object2']['user_level'];
        $data3['user_object3'] = $this->get_user_object();
        $station_id = $data3['user_object3']['user_statiton'];
        $selected_vaccine = $this->input->post('selected_vaccine');
        $this->load->model('mdl_order');
        $data = $this->mdl_order->get_order_values($station, $selected_vaccine, $station_id);
        echo json_encode($data);
    }

// Function to create order. Fetches the list of vaccines and calculations of max stock, minstock
    public function create_order()
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('vaccines/mdl_vaccines');
        $this->load->model('order/mdl_order');
        $data['vaccines'] = $this->mdl_vaccines->getVaccine();
        $data2['user_object2'] = $this->get_user_object();
        $data3['user_object3'] = $this->get_user_object();
        $station_level = $data2['user_object2']['user_level'];
        $station_id = $data3['user_object3']['user_statiton'];
        $data['order_vaccines'] = $this->mdl_order->calc_orders($station_id, $station_level);
        $data['order_details'] = $this->mdl_order->get_last_order_details($station_id);
        $data['section'] = "Vaccines";
        $data['subtitle'] = "Request Stock";
        $data['page_title'] = "Manage Stock";
        $data['module'] = "order";
        $data['view_file'] = "create_order_form";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Request Stocks', 'order/list_orders', 0);
        $this->make_bread->add('Create Request', '', 0);

        $data['breadcrumb'] = $this->make_bread->output();
        //
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);

    }

// Function lists the orders placed or submitted
    public function list_orders()
    {
        Modules::run('secure_tings/is_logged_in');
        $data['user_object'] = $this->get_user_object();
        $station = $data['user_object']['user_level'];
        $station_id = $data['user_object']['user_statiton'];
        $this->load->model('order/mdl_order');
        $this->load->library('pagination');
        $this->load->library('table');
        $config['base_url'] = base_url().'/order/list_orders';
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
        $data['subtitle'] = "Request Stocks";
        $data['page_title'] = "Request Stocks";
        $data['module'] = "order";
        if ($station == '1') {
            $data['view_file'] = "adm_list_order_view";
        } else {
            $data['view_file'] = "list_order_view";
        }
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();

        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Request Stocks', '', 0);

        $data['breadcrumb'] = $this->make_bread->output();
        //
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);


    }
// The function accepts two arguments, order_by and date when order was created,
//  to list the order items on viewing an order
    public function view_orders($order_by, $date_created, $option, $order_id, $status_name)
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('order/mdl_order');
        $data['section'] = "Manage Stock";
        $data['subtitle'] = "View Request";
        $data['page_title'] = " Orders";
        $data['orderitems'] = $this->mdl_order->get_order_items($order_id, $order_by, $date_created);
        $data['option'] = $option;
        $data['status_name'] = $status_name;
        $data['order_id'] = $order_id;
        $data['module'] = "order";
        $data['view_file'] = "order_view";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        //breadcrumbs
        $this->load->library('make_bread');
        $this->make_bread->add('Manage Stock', '', 0);
        $this->make_bread->add('Request Stocks', 'order/list_orders', 0);
        $this->make_bread->add('View Request', '', 0);

        $data['breadcrumb'] = $this->make_bread->output();
        //
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);

    }

    public function prepare_orders($content_array = array())
    {
        Modules::run('secure_tings/is_logged_in');

        $this->load->model('vaccines/mdl_vaccines');
        $data['vaccines'] = $this->mdl_vaccines->getVaccine();

        if (!empty($content_array)) {
            $orderitems = $content_array;
            $data['orderitems'] = $orderitems['orderitems'];
        }
        $data['section'] = "Manage Stock";
        $data['subtitle'] = "Requests";
        $data['page_title'] = " Requests";
        $data['module'] = "order";
        $data['options'] = "view";
        $data['view_file'] = "create_order_form";
        $data['user_object'] = $this->get_user_object();
        $data['main_title'] = $this->get_title();
        echo Modules::run('template/' . $this->redirect($this->session->userdata['logged_in']['user_group']), $data);
    }
// Function to save the orders. Order items are posted to this function,
// where they are stored in an array to be stored in the database
    function save_order()
    {
        Modules::run('secure_tings/is_logged_in');
        //Order Information
        $data2['user_object2'] = $this->get_user_object();
        $data3['user_object3'] = $this->get_user_object();

        $user_level = $data2['user_object2']['user_level'];
        $station_name = $data3['user_object3']['user_statiton'];
        $date_created = $this->input->post('created');
        $order_destination = $this->input->post('order_destination');
        $user_id = $this->input->post('user');
        $order_array['station_level'] = $user_level;
        $order_array['station_id'] = $station_name;
        $order_array['date_created'] = $date_created;
        $order_array['order_destination'] = $order_destination;
        $order_array['order_by'] = $user_id;
        $this->db->insert('m_order', $order_array);
        $order_id = $this->db->insert_id();


        //Order item information
        $stock_on_hand = $this->input->post("stock_on_hand");
        $min_stock = $this->input->post("min_stock");
        $max_stock = $this->input->post("max_stock");
        $first_expiry_date = $this->input->post("first_expiry_date");
        $quantity_dose = $this->input->post("quantity_dose");
        $vaccines = $this->input->post('vaccine');
        //echo '<pre>';
        //print_r($vaccines);die();

        $vaccine_array = array();
        $vaccine_counter = 0;

        foreach ($vaccines as $vaccine) {

            $vaccine_array[$vaccine_counter]['vaccine_id'] = $vaccines[$vaccine_counter];
            $vaccine_array[$vaccine_counter]['stock_on_hand'] = $stock_on_hand[$vaccine_counter];
            $vaccine_array[$vaccine_counter]['min_stock'] = $min_stock[$vaccine_counter];
            $vaccine_array[$vaccine_counter]['max_stock'] = $max_stock[$vaccine_counter];
            $vaccine_array[$vaccine_counter]['first_expiry'] = $first_expiry_date[$vaccine_counter];
            $vaccine_array[$vaccine_counter]['qty_order_doses'] = $quantity_dose[$vaccine_counter];
            $vaccine_array[$vaccine_counter]['order_id'] = $order_id[$vaccine_counter];

            $vaccine_counter++;

        }


        $main_array['own_vaccine'] = $vaccine_array;

        // Add assigned order id to order items
        foreach ($main_array as $key => $value) {
            foreach ($value as $keyvac => $valuevac) {
                foreach ($valuevac as $keys => $values) {
                    if ($keys == "order_id") {
                        $temp[$keyvac]['order_id'] = $order_id;
                    } else {
                        $temp[$keyvac][$keys] = $values;
                    }

                }

            }

        }

        $this->db->insert_batch('order_item', $temp);

        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Order submitted Successfully</div>');
        redirect('order/list_orders');

    }

    function save_forwarded_order($order_id)
    {
        Modules::run('secure_tings/is_logged_in');
        $this->load->model('order/mdl_order');
        $data['user_object'] = $this->get_user_object();
        $statiton_above = $data['user_object']['statiton_above'];
        $level = $data['user_object']['user_level'];
        $station_level = $level++;
        $this->mdl_order->forward_orders($station_level, $order_id);
        $this->session->set_flashdata('msg', '<div id="alert-message" class="alert alert-success text-center">Order forwarded successfully to <strong>' . $statiton_above . '</strong>!</div>');

        redirect('order/list_orders');
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