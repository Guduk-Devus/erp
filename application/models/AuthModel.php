<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AuthModel extends CI_Model {

	public function login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', md5($password));
		return $this->db->get('users')->row();
	}

	public function getSalesmanByUser($user_id){
		return $this->db->get('salesmen', ['id', $user_id])->row();
	}

	public function insert($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function insertSalesman($data)
	{
		$this->db->insert('salesmen', $data);
		return $this->db->insert_id();
	}

	public function cekRef($s, $returnBool = TRUE){
		$q = $this->db->get_where('salesmen', ['code_referral' => $s]);
		if ($returnBool) {
			return $q->num_rows() > 0 ? TRUE : FALSE;
		}else{
			return $q->row();
		}
	}

	public function getSalesmanByRef($ref){
		$user_id = $this->cekRef($ref, FALSE)->id;
		return $this->db->get('salesmen', ['id', $user_id])->row();
	}

}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */
