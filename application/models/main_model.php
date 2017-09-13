<?php
class Main_model extends CI_Model {

	public function __construct() {
            parent::__construct();
            // Your own constructor code
    }

	public function getClients() {
		$query = $this->db->get('clients');
		return $query->result_array();
	}

}