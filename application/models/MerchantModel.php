<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MerchantModel extends CI_Model {

	public function get(){
		if ($this->session->userdata('is_admin') == TRUE) {
			$q = $this->db->get('merchants');
		}else{
			$q = $this->db->get('merchants', ['salesman_id' => $this->session->userdata('salesman_id')]);
		}
		return $q->result();
	}

	public function count_merchant($type){
		return $this->db->get('merchants', ['merchant_type' => strtoupper($type)])->num_rows();
	}

}

/* End of file MerchantModel.php */
/* Location: ./application/models/MerchantModel.php */