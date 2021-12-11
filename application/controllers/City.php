<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_admin') != TRUE and $this->session->userdata('role') != 'pic') {
			redirect(base_url('/home'));
		}

		$this->load->model('CityModel', 'city');
	}

	public function index()
	{
		$admin = $this->session->userdata('is_admin');

		$data['city'] = $this->city->getCity(TRUE);
		$data['cityPic'] = $this->city->cityPic();
		$data['picCity'] = $this->city->picCity();
		$data['admin'] = $admin;

		$this->load->view('pages/dashboard/city', $data);
	}
}

/* End of file City.php */
/* Location: ./application/controllers/City.php */
