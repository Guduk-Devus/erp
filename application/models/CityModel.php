<?php

use Config\Database;

defined('BASEPATH') OR exit('No direct script access allowed');

class CityModel extends CI_Model {

	public function getCity($withProvince = FALSE)
	{
		if($withProvince){
			$this->db->select('*, indonesia_provinces.name as province, indonesia_cities.name as city, indonesia_cities.id as city_id');
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

	public function setTarget($data)
	{
		extract($data);
		$this->db->where('id', $id);
		$this->db->update('indonesia_cities', array('target' => $target));

		return true;
	}
}

/* End of file CityModel.php */
/* Location: ./application/models/CityModel.php */
