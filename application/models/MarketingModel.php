<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MarketingModel extends CI_Model {

	public function index()
	{
		$this->db->select('*, users.id as user_id, users.name as user_name');
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

	public function getMerchant($numrowsOnly = FALSE) {
		$q = $this->db->get('merchants', ['salesman_id' => $this->session->userdata('item')]);
		return $numrowsOnly ? $q->result() : $q->num_rows();
	}

	public function getReferralCode($numrowsOnly = FALSE)
	{
		return $this->db->get_where('salesmen', ['user_id' => $this->session->userdata('id')])->row()->code_referral;
	}

	public function setPIC($data)
	{
		extract($data);
		$exists = $this->db->get_where('indonesia_cities', ['id', $city_id])->result();

		if (count($exists) > 0) {
			foreach ($exists as $e) {
				$this->db->set('indonesia_cities', array('user_id' => null))->where('id', $e->user_id)->update('indonesia_cities');
			}
		}

		if ($role == 'pic_pusat') {
			$pusat = $this->db->get_where('users', ['role', 'pic_pusat'])->result();

			if (count($pusat) > 0) {
				foreach ($pusat as $e) {
					$this->db->set('users', array('role' => null, 'is_admin' => 0))->where('id', $e->user_id)->update('users');
				}
			}

			$this->db->where('id', $user_id);
			$this->db->update('users', array('role' => 'pic_pusat', 'is_admin' => 1));

			return true;
		} else {
			$this->db->where('id', $user_id);
			$this->db->update('users', array('role' => 'pic_kota'));

			$this->db->where('id', $city_id);
			$this->db->update('indonesia_cities', array('user_id' => $user_id));

			return true;
		}

		return false;
	}
}

/* End of file MarketingModel.php */
/* Location: ./application/models/MarketingModel.php */
