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

	/* Create user */
	public function create_user($username, $email, $password) {
		$encrypt = password_hash($password, PASSWORD_DEFAULT); //encrypt password
		$data = array(
			'username' => $username,
			'email' => $email,
			'password' => $encrypt
		);
		$query = $this->db->insert('accounts', $data);
		return $this->db->affected_rows();
	}

	/* update user */
	public function update_user($username, $email, $password, $id) {
		echo $username."<br>";
		echo $email."<br>";
		echo $password."<br>";
		echo $id."<br>";

		$encrypt = password_hash($password, PASSWORD_DEFAULT); //encrypt password
		$data = array(
			'username' => $username,
			'email' => $email,
			'password' => $encrypt
		);
		$query = $this->db->update('accounts', $data, array('id' => $id));
		echo $this->db->affected_rows();
		return $this->db->affected_rows();
	}
}