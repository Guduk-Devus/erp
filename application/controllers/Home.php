<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data = [];
		if($this->session->userdata('id')){
			if ($this->session->userdata('is_admin') == 1) {
				$this->load->view('pages/dashboard/home', $data);
			}else{
				$this->load->model('MarketingModel', 'marketing');
				$data['target'] = [
					'target' => 2500,
					'actual' => $this->marketing->getMerchant()
				];
				$data['merchant'] = $this->marketing->getMerchant(TRUE);
				$this->load->view('pages/sales_dashboard/home', $data);
			}
		}else{
			redirect(base_url('auth/index'));
		}
		
	}

	public function marketing()
	{
		if ($this->input->post()) {
			$this->db->where('id', $this->input->post('city_id'));
			$exists = $this->db->get('indonesia_cities')->result();

			if (count($exists) > 0) {

				foreach ($exists as $e) {
					$this->db->where('id', $e->user_id);
					$this->db->update('users', array('role' => null));
				}

				$this->db->where('id', $this->input->post('user_id'));
				$this->db->update('users', array('role' => 'pic'));

				$this->db->where('id', $this->input->post('city_id'));
				$this->db->update('indonesia_cities', array('user_id' => $this->input->post('user_id')));
			} else {
				$this->db->where('id', $this->input->post('user_id'));
				$this->db->update('users', array('role' => 'pic'));

				$this->db->where('id', $this->input->post('city_id'));
				$this->db->update('indonesia_cities', array('user_id' => $this->input->post('user_id')));
			}

			return redirect($_SERVER['HTTP_REFERER']);
		} else {
			$admin = $this->session->userdata('is_admin');

			$this->load->model('CityModel', 'city');
			$this->load->model('MarketingModel', 'salesmen');

			$data['city'] = $this->city->cities();
			$data['salesmen'] = $this->salesmen->index();
			$data['marketing'] = $this->salesmen->picMarketing();
			$data['admin'] = $admin;

			$this->load->view('pages/dashboard/master_marketing', $data);
		}
	}

	public function merchant(){
		$this->load->model('MerchantModel', 'merchant');
		$data['merchant'] = $this->merchant->get();
		$data['count_merchant'] = [
			'irg' => $this->merchant->count_merchant('irg'),
			'moopo' => $this->merchant->count_merchant('moopo'),
			'kamsia' => $this->merchant->count_merchant('kamsia'),
		];
		$this->load->view('pages/dashboard/merchant', $data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
