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
		// $this->db->where('code_referral', $s);
		$q = $this->db->get_where('salesmen', ['code_referral' => $s]);
		if ($returnBool) {
			return $q->num_rows() > 0 ? TRUE : FALSE;
		}else{
			return $q->row();
		}
	}

	public function getSalesmanByRef($ref){
		// return $ref;
		$user_id = $this->cekRef($ref, FALSE);
		// return $user_id->id;
		
		 $this->db->get_where('salesmen', ['id', $user_id->id])->row();
		 return $this->db->last_query();
		
		
	}

}

/* End of file AuthModel.php */
/* Location: ./application/models/AuthModel.php */
