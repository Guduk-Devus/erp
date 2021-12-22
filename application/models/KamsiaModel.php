<?php

use Config\Database;

defined('BASEPATH') OR exit('No direct script access allowed');

class CityModel extends CI_Model {

	public function getCity($withProvince = FALSE)
	{
		if($withProvince){
			$this->db->select('*, indonesia_provinces.name as province, indonesia_cities.name as city');
			$this->db->join('indonesia_provinces', 'indonesia_provinces.id = indonesia_cities.province_id', 'inner');
		}
		return $this->db->get('indonesia_cities')->result();
	}

	public function cities()
	{
		return $this->db->get('indonesia_cities')->result();
	}

	public function cityPic()
	{
		$this->db->select('*, indonesia_cities.name as cities');
		$this->db->join('users', 'indonesia_cities.user_id = users.id', 'inner');
		$this->db->join('salesmen', 'users.id = salesmen.user_id', 'inner');

		return $this->db->get('indonesia_cities')->result();
	}

	public function picCity()
	{
		$this->db->select('*, indonesia_provinces.name as province, indonesia_cities.name as city');
		$this->db->join('indonesia_provinces', 'indonesia_provinces.id = indonesia_cities.province_id', 'inner');
		$this->db->where('indonesia_cities.user_id', $this->session->userdata('id'));

		return $this->db->get('indonesia_cities')->result();
	}

	public function updateCityPic($data)
	{
		extract($data);
		$exists = $this->db->get_where('indonesia_cities', ['id', $city_id])->result();

		if (count($exists) > 0) {
			foreach ($exists as $e) {
				$this->db->set('indonesia_cities', array('user_id' => null))->where('id', $e->user_id)->update('indonesia_cities');
			}
		}

		if ($this->db->where('id', $user_id)) {
			$this->db->update('users', array('role' => 'pic'));

			$this->db->where('id', $city_id);
			$this->db->update('indonesia_cities', array('user_id' => $user_id));

			return true;
		}

		return false;
	}
}

/* End of file CityModel.php */
/* Location: ./application/models/CityModel.php */
