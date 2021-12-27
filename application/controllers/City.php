<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class City extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
//		if ($this->session->userdata('is_admin') != TRUE) {
//			redirect(base_url('/home'));
//		}

		$this->load->model('CityModel', 'city');
	}

	public function index()
	{
		if ($this->input->post()) {
			$data = array(
				'id' => $this->input->post('id'),
				'target' => $this->input->post('target')
			);

			$this->load->model('CityModel', 'city');
			if ($this->city->setTarget($data)) {
				return redirect($_SERVER['HTTP_REFERER']);
			}
		} else {
			$admin = $this->session->userdata('is_admin');

			$data['city'] = $this->city->getCity(TRUE);
			$data['cityPic'] = $this->city->cityPic();
			$data['picCity'] = $this->city->picCity();
			$data['admin'] = $admin;
		}

		$this->load->view('pages/dashboard/city', $data);
	}
}

/* End of file City.php */
/* Location: ./application/controllers/City.php */
