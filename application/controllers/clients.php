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
        $amount = array('name' => 'amount', 
                        'id' => 'amount', 
                        'type' => 'number',
                        'placeholder' => 'Amount', 
                        'class' => 'form-control', 
                        'required' => true
                    );
        $charge = array('name' => 'charge', 
                        'id' => 'number', 
                        'type' => 'number',
                        'placeholder' => 'Charge', 
                        'class' => 'form-control', 
                        'required' => true
                    );
        $comment = array('name' => 'comment', 
                        'id' => 'comment', 
                        'type' => 'text',
                        'placeholder' => 'Comment', 
                        'class' => 'form-control'
                    );
        $submit = array(
            'type'  => 'submit',
            'name'  => 'submit',
            'value' => 'Submit',
            'class' => 'btn btn-default'
        );

        // Generate Information table
        $this->table->set_heading('Information');
        $this->table->add_row(array('ID', $profile['id']));
        $this->table->add_row(array('Last Name', $profile['lastname']));
        $this->table->add_row(array('First Name', $profile['firstname']));
        $this->table->add_row(array('Address', $profile['address']));
        $this->table->add_row(array('Telephone', $profile['telephone']));
        // $this->table->add_row(array('&#x270e;', anchor(site_url().'/clients/update/'.$profile['id'], 'Edit', 'title="Edit"') ));
        $template = array('table_open' => '<table class="table table-condensed table-striped myTable client-info-tbl">', 'heading_cell_start' => '<th colspan="2">');
        $this->table->set_template($template);
        $data['form'] = $this->table->generate();

        // Generate New Transaction form
        $this->table->set_heading('New Transaction');
        $this->table->add_row(array('Date',form_open('clients/new_transaction/'.$id.'', $form).form_input($date)));
        $this->table->add_row(array('Amount',form_input($amount)));
        $this->table->add_row(array('Charge(%)',form_input($charge)));
        $this->table->add_row(array('Comment',form_input($comment)));
        $this->table->add_row(array('',form_submit($submit).form_close()));
        $template2 = array('table_open' => '<table class="table table-condensed myTable client-new-trans">', 'heading_cell_start' => '<th colspan="2">');
        $this->table->set_template($template2);
        $data['form2'] = $this->table->generate();;
        

        // Generate Transaction table
        $transactions = "";
        $transactions = $this->Client_model->get_transactions($id);
        if(null !== $transactions) {

            foreach ($transactions as $key => $t) {
                $occDate='2014-12-31';
                $forOdNextMonth = date('m d y', strtotime("+1 month", strtotime($occDate)));

                $date = date_create($t['date']);
                $this->table->add_row(array(
                                            $t['id'],
                                            date_format($date, "M. d, Y"),
                                            number_format($t['amount'], 2),
                                            number_format($t['charge'], 2),
                                            $t['comment'],
                                            anchor(site_url().'/clients/transaction/'.$id.'/'.$t['id'], 'View', 'title="View transaction"')
                ));
            }
        }
        $trans_tbl_tem = array('table_open' => '<table class="table table-condensed table-striped myTable client-trans-tbl" id="client-transactions-table">');
        $this->table->set_heading('#', 'Date', 'Amount', 'Charge', 'Comment', 'Action');
        $this->table->set_template($trans_tbl_tem);
        $data['table'] = $this->table->generate();

        $data['breadcrumbs'] =  breadcrumbs(array('clients', $fullname));
        $data['form_header'] = $fullname;
        $data['table_header'] = "Transactions";
        $data['navbar_left'] = navbar_left($this->uri->segment(1));

        $this->load->view('header');
        $this->load->view('generic-page', $data);
        $this->load->view('footer');
    }

    public function transaction($c_id, $t_id) {
        $profile = $this->Client_model->get_clients($c_id);
        $fullname = $profile['firstname']." ".$profile['lastname'];

        // Generate Information
        $this->table->set_heading('Information');
        $this->table->add_row(array('ID', $profile['id']));
        $this->table->add_row(array('Last Name', $profile['lastname']));
        $this->table->add_row(array('First Name', $profile['firstname']));
        $this->table->add_row(array('Address', $profile['address']));
        $this->table->add_row(array('Telephone', $profile['telephone']));
        $template = array('table_open' => '<table class="table table-condensed table-striped myTable client-info-tbl">', 'heading_cell_start' => '<th colspan="2">');
        $this->table->set_template($template);
        $data['form'] = $this->table->generate();

        // Generate Transaction table 

        $transaction = $this->Client_model->transaction($t_id);
        if(null !== $transaction) {

            foreach ($transaction as $key => $t) {
                $date = date_create($t['date']);
                $due_date = date('M. d, Y', strtotime("+1 month", strtotime($t['date'])));

                $this->table->add_row(array(
                                            $t['id'],
                                            date_format($date, "M. d, Y"),
                                            $due_date,
                                            number_format($t['amount'], 2),
                                            number_format($t['charge'], 2),
                                            $t['comment']
                                            // anchor(site_url().'/clients/transaction/'.$id.'/'.$t['id'], 'View', 'title="View transaction"')
                ));
            }
        }
        $trans_tbl_tem = array('table_open' => '<table class="table table-condensed table-striped myTable client-trans-tbl" id="client-transaction">');
        $this->table->set_heading('#', 'Date', 'Due Date', 'Amount', 'Charge', 'Comment', 'Action');
        $this->table->set_template($trans_tbl_tem);
        $data['table'] = $this->table->generate();

        $data['breadcrumbs'] =  breadcrumbs(array('clients', anchor(site_url().'/clients/profile/'.$c_id, $fullname)." / Transaction No. ".$t_id));
        $data['form_header'] = $fullname;
        $data['table_header'] = "Transactions No. ".$t_id;
        $data['navbar_left'] = navbar_left($this->uri->segment(1));

        $this->load->view('header');
        $this->load->view('generic-page', $data);
        $this->load->view('footer');
    }

    public function update($id) {
        echo $id;
    }

    public function new_transaction($client_id) {
        $transaction = $this->Client_model->new_transaction($client_id);
        if($transaction == 1) {
            header("Location: ".site_url()."/clients/profile/".$client_id."?form2_alert=Success");
        }else {
            header("Location: ".site_url()."/clients/profile/".$client_id."?form2_alert=Failed");
        }
    }
}