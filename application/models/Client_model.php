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
		$this->db->group_by('group_code');
		$this->db->order_by('date', 'ASC');
		$query = $this->db->get_where('transactions', array('client_id' => $client_id));
		$result = $query->result_array();
		return $result;
	}

	public function transaction($group_code) {
		$query = $this->db->get_where('transactions', array('group_code' => $group_code));
		$result = $query->result_array();
		return $result;
	}

	public function loan_information($group_code) {
		$query = $this->db->get_where('transactions', array('group_code' => $group_code));
		$result = $query->row_array();
		return $result;
	}

	public function add_loan($client_id) {
		$u_in = $this->input->post();
		$data = array(
			'client_id' => $client_id,
			'date' => $u_in['date'],
			'amount' => $u_in['amount'],
			'rate' => $u_in['rate'],
		);
		$query = $this->db->insert('loans', $data);
		return $this->db->affected_rows();
	}

	public function get_loans($client_id) {
		$this->db->order_by('date', 'ASC');
		$query = $this->db->get_where('loans', array('client_id' => $client_id));
		$result = $query->result_array();
		return $result;
	}

	public function add_payment() {
		$u_in = $this->input->post();
		$data = array(
			'loan_id' => $u_in['loan_id'],
			'date' => $u_in['date'],
			'amount' => $u_in['amount'],
			'description' => $u_in['description']
		);
		$query = $this->db->insert('payments', $data);
		return $this->db->affected_rows();
	}

	public function get_payments($loan_id) {
		$this->db->order_by('date', 'ASC');
		$query = $this->db->get_where('payments', array('loan_id' => $loan_id));
		$result = $query->result_array();
		return $result;
	}

	public function updateLoanStatus($loan_id, $status) {
		$this->db->where('id', $loan_id);
		$this->db->update('loans', array('status'=>$status));
	}
}