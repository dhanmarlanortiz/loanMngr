<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clients extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Client_model');
        $this->load->helper("myHelper");

        if(null === $this->session->userdata('uid')) {
            header("Location: ".site_url('welcome?fa=1')."");
        }
    }

    public function index() {
        $data['breadcrumbs'] =  breadcrumbs(array('clients'));
        $data['table_header'] = "List of clients";
        $data['form_header'] = "Add new client";
        $data['navbar_left'] = navbar_left($this->uri->segment(1));
        $list = $this->Client_model->get_clients();

        $this->table->set_heading('first name', 'last name', 'telephone', 'address' ,'&nbsp;');
        if(null !== $list) {
            foreach ($list as $l):
                $this->table->add_row($l['firstname'], $l['lastname'], '', '', '<a href="'.site_url().'/clients/profile/'.$l['id'].'">View</a>');
            endforeach;
        }
        $template = array('table_open' => '<table class="table-condensed table-bordered table-striped myTable">');
        $this->table->set_template($template);
        $data['table'] = $this->table->generate();

        $this->load->view('header');
        $this->load->view('generic-page', $data);
        $this->load->view('footer');
    }

    public function profile() {

    }

}