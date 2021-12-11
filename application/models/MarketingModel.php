<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarketingModel extends CI_Model {

	public function index()
	{
		$this->db->select('*, users.name as user_name');
		$this->db->from('salesmen');
		$this->db->join('users', 'users.id = salesmen.user_id', 'inner');
		$this->db->join('indonesia_cities city', 'city.id = salesmen.city_id', 'inner');

//		$this->db->where('role', null);
		return $this->db->get()->result();
	}

	public function picMarketing()
	{
		$this->load->model('CityModel', 'city');

		$this->db->select('*, users.name as user_name');
		$this->db->from('salesmen');
		$this->db->join('users', 'users.id = salesmen.user_id', 'inner');
		$this->db->join('indonesia_cities city', 'city.id = salesmen.city_id', 'inner');

		return $this->db->get()->result();
	}

	public function insertMerchant($object){
		return $this->db->insert('merchants', $object);
	}

	public function getMerchant($numrowsOnly = FALSE){
		$q = $this->db->get('merchants', ['salesman_id' => $this->session->userdata('item')]);
		return $numrowsOnly ? $q->result() : $q->num_rows();
	}

}

/* End of file MarketingModel.php */
/* Location: ./application/models/MarketingModel.php */
