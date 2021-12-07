<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_admin') != TRUE) {
			redirect(base_url('/home'));
		}
		$this->load->model('CityModel', 'city');
	}

	public function index()
	{

		$data['city'] = $this->city->getCity(TRUE);
		$this->load->view('pages/dashboard/city', $data);
	}

}

/* End of file City.php */
/* Location: ./application/controllers/City.php */