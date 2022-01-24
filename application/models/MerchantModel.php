<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MerchantModel extends CI_Model {

	public function get()
	{
		if ($this->session->userdata('is_admin') == TRUE) {
			$q = $this->db->get('merchants');
		}else{
			$q = $this->db->get_where('merchants', array('salesman_id' => $this->session->userdata('salesman_id')));
		}
		return $q->result();
	}

	public function count_merchant($type){
		if ($this->session->userdata('is_admin') == TRUE) {
			$q = $this->db->get('merchants', ['merchant_type' => strtoupper($type)]);
		} else {
			$where = array('salesman_id' => $this->session->userdata('salesman_id'), 'merchant_type' => strtoupper($type));
			$q = $this->db->get('merchants', array($where));
		}

		return $q->num_rows();
	}

//	public function getSalesLogin()
//	{
//
//	}

}

/* End of file MerchantModel.php */
/* Location: ./application/models/MerchantModel.php */
