<?php
class Client_model extends CI_Model {

	public function __construct() {
		parent::__construct();
	}

	public function get_clients($id=null) {
		if(isset($id)) {
			$query = $this->db->get_where('clients', array('id' => $id));
			$result = $query->row_array();
		}else { 
			$this->db->order_by('firstname', 'ASC');
			$query = $this->db->get('clients');
			$result = $query->result_array();
		}
		return $result;
	}

	public function new_transaction($client_id) {
		$u_in = $this->input->post();
		$data = array(
			'client_id' => $client_id,
			'date' => $u_in['date'],
			'amount' => $u_in['amount'],
			'charge' => $u_in['charge'],
			'comment' => $u_in['comment'],
			'type' => $u_in['type']
		);

		$query = $this->db->insert('transactions', $data);
		return $this->db->affected_rows();
	}

	public function get_transactions($client_id) {
		$query = $this->db->get_where('transactions', array('client_id' => $client_id));
		$result = $query->result_array();
		return $result;
	}

	public function transaction($t_id) {
		$query = $this->db->get_where('transactions', array('id' => $t_id));
		$result = $query->result_array();
		return $result;
	}

	public function get_loan($t_id) {
		$query = $this->db->get_where('transactions', array('id' => $t_id, 'type' => 'Loan'));
		$result = $query->row_array();
		return $result;
	}
}