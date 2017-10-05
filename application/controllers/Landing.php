<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Landing extends CI_Controller {

	public function index() {
		$data['title'] = "Home";
        $this->load->view('header.php', $data);
        $this->load->view('index.php');
		$this->load->view('footer.php');
	}

}