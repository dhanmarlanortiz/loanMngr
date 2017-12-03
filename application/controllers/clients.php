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

        $this->generic_page($data);
    }

    function generic_page($data) {
        $this->load->view('header');
        $this->load->view('generic-page', $data);
        $this->load->view('footer');
    }

    function client_information($c_id) {
        $profile = $this->Client_model->get_clients($c_id);
        $fullname = $profile['firstname']." ".$profile['lastname'];
        
        $this->table->set_heading('Client Information');
        $this->table->add_row(array('ID', $profile['id']));
        $this->table->add_row(array('Last Name', $profile['lastname']));
        $this->table->add_row(array('First Name', $profile['firstname']));
        $this->table->add_row(array('Address', $profile['address']));
        $this->table->add_row(array('Telephone', $profile['telephone']));
        $template = array('table_open' => '<table class="table table-condensed table-striped myTable client-info-tbl">', 'heading_cell_start' => '<th colspan="2">');
        $this->table->set_template($template);
        $table =  $this->table->generate();
        
        return $table;
    }

    function loan_information($group_code) {
        $loan = $this->Client_model->loan_information($group_code);
        $this->table->set_heading('Loan Information');
        $this->table->add_row(array('Transaction No.', $loan['group_code']));
        $this->table->add_row(array('Date', $loan['date']));
        $this->table->add_row(array('Amount', "P ".number_format($loan['amount'],2)));
        $this->table->add_row(array('Charge', $loan['charge'].'%'));
        $template = array('table_open' => '<table class="table table-condensed table-striped myTable loan-info-tbl">', 'heading_cell_start' => '<th colspan="2">');
        $this->table->set_template($template);
        $table = $this->table->generate();

        return $table;
    }

    function loan_form($client_id) {
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
        $rate = array('name' => 'rate', 
                        'id' => 'number', 
                        'type' => 'number',
                        'placeholder' => 'Interest Rate', 
                        'class' => 'form-control', 
                        'required' => true
                    );
        $submit = array(
            'type'  => 'submit',
            'name'  => 'submit',
            'value' => 'Submit',
            'class' => 'btn btn-default'
        );
        $this->table->set_heading('Add Loan');
        $this->table->add_row(array('Date',form_open('clients/add_loan/'.$client_id.'', $form).form_input($date)));
        $this->table->add_row(array('Amount',form_input($amount)));
        $this->table->add_row(array('Rate (%)',form_input($rate)));
        $this->table->add_row(array('',form_submit($submit).form_close()));
        $add_loan_form = array('table_open' => '<table class="table table-condensed myTable client-new-loan">', 'heading_cell_start' => '<th colspan="2">');
        $this->table->set_template($add_loan_form);
        $table = $this->table->generate();

        return $table;
    }

    function payment_form($client_id) {
        $loans = $this->Client_model->get_loans($client_id);
        $transaction_options = array(''=>'Select');
        $description_options = array(''=>'Select', 'Interest'=>'Interest', 'Full payment' => 'Full payment' );
        $form = array('class' => '');

        if(null !== $loans) {
            foreach ($loans as $key => $each_loan) {
                $options[$each_loan['id']] = $each_loan['id'];
            $transaction_options = $options;
            }
        }

        $transaction = form_dropdown('loan_id', $transaction_options, ' ', 'class="form-control" required');
        $description = form_dropdown('description', $description_options, ' ', 'class="form-control" required');

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
        $submit = array(
            'type'  => 'submit',
            'name'  => 'submit',
            'value' => 'Submit',
            'class' => 'btn btn-default'
        );
        $this->table->set_heading('Add Payment');
        $this->table->add_row(array('Date',form_open('clients/add_payment/'.$client_id.'', $form).form_input($date)));
        $this->table->add_row(array('Transaction #', $transaction));
        $this->table->add_row(array('Amount',form_input($amount)));
        $this->table->add_row(array('Description',$description));
        $this->table->add_row(array('',form_submit($submit).form_close()));
        $add_payment_form = array('table_open' => '<table class="table table-condensed myTable client-payment-form">', 'heading_cell_start' => '<th colspan="2">');
        $this->table->set_template($add_payment_form);
        $table = $this->table->generate();

        return $table;

    }

    function loan_table($client_id) {
        $loans = "";
        $loans = $this->Client_model->get_loans($client_id);
        if(null !== $loans) {
            $total_payment = 0;
            $balance = 0;
            $interest = 0;
            $status = "";
            foreach ($loans as $key => $each_loan) {
                $loan_id = $each_loan['id'];
                $loan_amount = $each_loan['amount'];
                $status = $each_loan['status'];

                // $occDate='2014-12-31';
                // $forOdNextMonth = date('m d y', strtotime("+1 month", strtotime($occDate)));
                $date = date_create($each_loan['date']);
                $this->table->add_row(
                    array('Transaction No.: ', $loan_id, 'Date: ', date_format($date, "M. d, Y"))
                );

                $this->table->add_row(
                    array('Amount: ', number_format($loan_amount, 2), 'Status: ', $status)
                );

                $payments = $this->Client_model->get_payments($loan_id);
                $this->table->add_row(
                    array('','Date', 'Amount', 'Description')
                );

                
                if(null !== $payments) {
                    foreach ($payments as $each_payment) {
                        $this->table->add_row(
                            array('', $each_payment['date'], number_format($each_payment['amount'],2), $each_payment['description'])
                        );
                        $total_payment = $total_payment + $each_payment['amount'];
                        if($each_payment['description'] == 'Interest') {
                            $interest = $interest + $each_payment['amount'];
                        }
                    }
                }
                
                $this->table->add_row(
                    array('','Total payment',number_format($total_payment,2),'')
                );

                $this->table->add_row(
                    array('','Interest',number_format($interest,2),'')
                );

                $balance = ($loan_amount + $interest)- $total_payment;
                $this->table->add_row(
                    array('','Balance',number_format($balance,2),'')
                );

                $this->table->add_row(
                    array('','','','')
                );

                //update status
                if($balance <= 0) {
                    $this->Client_model->updateLoanStatus($loan_id, 'Fully paid');
                }
                
            }


        }
        $loan_table = array('table_open' => '<table class="table table-condensed" id="" >');
        // $this->table->set_heading('Transaction #', 'Date', 'Amount', 'Status', 'Action');
        $this->table->set_template($loan_table);
        $table = $this->table->generate();

        return $table;
    }


    public function profile($client_id) {
        $profile = $this->Client_model->get_clients($client_id);
        $fullname = $profile['firstname']." ".$profile['lastname'];

        // Generate Information table
        $data['form1'] = $this->client_information($client_id); 
        $data['form2'] = $this->loan_form($client_id); 
        $data['form3'] = $this->payment_form($client_id); 
        $data['table'] = $this->loan_table($client_id); 

        $data['breadcrumbs'] =  breadcrumbs(array('clients', $fullname));
        $data['form_header'] = $fullname;
        $data['table_header'] = "Loans";
        $data['navbar_left'] = navbar_left($this->uri->segment(1));

        $this->generic_page($data);
    }

    public function add_loan($client_id) {
        $add_loan = $this->Client_model->add_loan($client_id);
        if($add_loan == 1) {
            header("Location: ".site_url()."/clients/profile/".$client_id."?form2_alert=Success");
        }else {
            header("Location: ".site_url()."/clients/profile/".$client_id."?form2_alert=Failed");
        }
    }

    public function add_payment($client_id) {
        $add_payment = $this->Client_model->add_payment($client_id);
        if($add_payment == 1) {
            header("Location: ".site_url()."/clients/profile/".$client_id."?form3_alert=Success");
        }else {
            header("Location: ".site_url()."/clients/profile/".$client_id."?form3_alert=Failed");
        }
    }


    public function transaction($c_id, $group_code) {
        $profile = $this->Client_model->get_clients($c_id);
        $fullname = $profile['firstname']." ".$profile['lastname'];
        $data['form'] = $this->client_information($c_id);
        $data['form2'] = $this->loan_information($group_code);

        // Generate Transaction table 
        $transaction = $this->Client_model->transaction($group_code);
        if(null !== $transaction) {
            $ctr = 0;
            $total_amount = 0;
            foreach ($transaction as $key => $t) {
                $date = date_create($t['date']);
                $due_date = date('M. d, Y', strtotime("+1 month", strtotime($t['date'])));
                $ctr++;
                $this->table->add_row(
                    array(
                        $ctr,
                        date_format($date, "M. d, Y"),
                        $due_date,
                        number_format($t['amount'], 2),
                        $t['comment']
                        // anchor(site_url().'/clients/transaction/'.$id.'/'.$t['id'], 'View', 'title="View transaction"')
                    )
                );
                $total_amount = $total_amount + $t['amount'];
            }
            $this->table->add_row('','','', number_format($total_amount,2), '');

        }
        $trans_tbl_tem = array('table_open' => '<table class="table table-condensed table-striped myTable client-trans-tbl" id="client-transaction">');
        $this->table->set_heading('#', 'Date', 'Due Date', 'Amount', 'Charge');
        $this->table->set_template($trans_tbl_tem);
        $data['table'] = $this->table->generate();

        $data['breadcrumbs'] =  breadcrumbs(array('clients', anchor(site_url().'/clients/profile/'.$c_id, $fullname)." / Transaction No. ".$group_code));
        $data['form_header'] = $fullname;
        $data['table_header'] = "Transactions No. ".$group_code;
        $data['navbar_left'] = navbar_left($this->uri->segment(1));

        $this->generic_page($data);
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