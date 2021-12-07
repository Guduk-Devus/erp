<?php
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

}

/* End of file CityModel.php */
/* Location: ./application/models/CityModel.php */