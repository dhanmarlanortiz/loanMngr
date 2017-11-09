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
        $template = array('table_open' => '<table class="table table-condensed table-striped myTable" id="client-table">');
        $this->table->set_template($template);
        $data['table'] = $this->table->generate();

        $this->load->view('header');
        $this->load->view('generic-page', $data);
        $this->load->view('footer');
    }

    public function profile($id) {
        $profile = $this->Client_model->get_clients($id);
        $fullname = $profile['firstname']." ".$profile['lastname'];

        /* Create form */
        $form = array('class' => '');
        $date = array('name' => 'date', 
                        'id' => 'date',
                        'type'  => 'date',
                        'class' => 'form-control', 
                        'required' => true
                    );
        $amount =    array('name' => 'amount', 
                        'id' => 'amount', 
                        'type' => 'number',
                        'placeholder' => 'Amount', 
                        'class' => 'form-control', 
                        'required' => true
                    );
        $id =    array('name' => 'id', 
                        'id' => 'id', 
                        'value' => $id
                    );
        $submit = array(
            'type'  => 'submit',
            'name'  => 'submit',
            'value' => 'Submit',
            'class' => 'btn btn-default'
        );

        $this->table->set_heading('Information', '');
        $this->table->add_row(array('ID', $profile['id']));
        $this->table->add_row(array('Last Name', $profile['lastname']));
        $this->table->add_row(array('First Name', $profile['firstname']));
        $this->table->add_row(array('Address', $profile['address']));
        $this->table->add_row(array('Telephone', $profile['telephone']));
        // $this->table->add_row(array('&#x270e;', anchor(site_url().'/clients/update/'.$profile['id'], 'Edit', 'title="Edit"') ));
        $template = array('table_open' => '<table class="table table-condensed table-striped myTable">');
        $this->table->set_template($template);
        $data['form'] = $this->table->generate();

        $this->table->set_heading('New Trasaction');
        $this->table->add_row(form_open('clients', $form)
                            ."<p>".form_input($date)."</p>"
                            ."<p>".form_input($amount)."</p>"
                            .form_hidden($id)
                            ."<p>".form_submit($submit)."</p>"
                            .form_close()
                        );
        $template2 = array('table_open' => '<table class="table table-condensed myTable">');
        $this->table->set_template($template2);
        $data['form2'] = $this->table->generate();;
        
        $data['breadcrumbs'] =  breadcrumbs(array('clients', $fullname));
        $data['form_header'] = $fullname;
        $data['table_header'] = "Transactions";
        $data['navbar_left'] = navbar_left($this->uri->segment(1));
        
        $this->load->view('header');
        $this->load->view('generic-page', $data);
        $this->load->view('footer');
    }

    public function update($id) {
        echo $id;
    }
}