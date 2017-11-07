<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');

        if(null === $this->session->userdata('uid')) {
            header("Location: ".site_url('welcome?fa=1')."");
        }
    }

    public function index() {
        $this->load->view('header');
        $this->load->view('navbar');
        $this->load->view('homepage');
        $this->load->view('footer');
    }

}