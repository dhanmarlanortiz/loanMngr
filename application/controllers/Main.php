<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function index() {
        $this->load->model('Main_model');
        $data['title'] = "Clients";
        $data['clients'] = $this->Main_model->getClients();
        $this->load->view('header.php', $data);
        $this->load->view('clients.php', $data);
        $this->load->view('footer.php');
    }

}
