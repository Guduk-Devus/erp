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
					'actual' => $this->marketing->getMerchant(),
					'referral' => $this->marketing->getReferralCode(),
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
			$data = array(
				'user_id' => $this->input->post('user_id'),
				'city_id' => $this->input->post('city_id'),
				'role' => $this->input->post('role'),
			);

			$this->load->model('MarketingModel', 'marketing');

			if ($this->marketing->setPIC($data)) {
				return redirect($_SERVER['HTTP_REFERER']);
			}
	 	} else {
			$data['role'] = $this->session->userdata('role');
			$data['admin'] = $this->session->userdata('is_admin');

			$this->load->model('CityModel', 'city');
			$this->load->model('MarketingModel', 'salesmen');

			$data['city'] = $this->city->cities();
			$data['salesmen'] = $this->salesmen->index();
			$data['marketing'] = $this->salesmen->picMarketing();

			$this->load->view('pages/dashboard/master_marketing', $data);
		}
	}
	
	public function merchant()
	{
		$data['role'] = $this->session->userdata('role');
		$data['admin'] = $this->session->userdata('is_admin');
		$this->load->model('MerchantModel', 'merchant');
		$data['merchant'] = $this->merchant->get();
		$data['count_merchant'] = [
			'irg' => $this->merchant->count_merchant('irg'),
			'moopo' => $this->merchant->count_merchant('moopo'),
			'kamsia' => $this->merchant->count_merchant('kamsia'),
		];

		$this->load->view('pages/dashboard/merchant', $data);
	}

	public function merchant_detail($id, $merchantType)
	{
		$val = [];
		$transactions = [];
		$itemPrice = [];
		$this->load->model('MoopoModel', 'moopo');
		$this->load->model('KamsiaModel', 'kamsia');
		$this->load->model('IRGModel', 'irg');

		if ($this->input->post()) {
			$id = $this->input->post('id');
			$merchant_id = $this->input->post('merchant_id');
			$merchantType = $this->input->post('merchant');
			$itemPrice = $this->input->post('item_price');

			if ($merchantType == 'MOOPO') {
				$val += $this->moopo->getItems($merchant_id);
				$transactions += $this->moopo->getTransactions($id);

			} elseif ($merchantType == 'KAMSIA') {
				$val += $this->kamsia->getItems($merchant_id);
				$transactions += $this->kamsia->getTransactions($id);

			} else {
				$val += $this->irg->getItems($merchant_id);
				$transactions += $this->irg->getTransactions($id);

			}
		} else {
			if ($merchantType == 'MOOPO') {
				$val += $this->moopo->getItems($id);

			} elseif ($merchantType == 'KAMSIA') {
				$val += $this->kamsia->getItems($id);

			} else {
				$val += $this->irg->getItems($id);
			}
		}


		$data = array();
		$data['merchant_type'] = $merchantType;
		$data['items'] = $val;
		$data['transactions'] = $transactions;
		$data['item_price'] = $itemPrice;

		$this->load->view('pages/dashboard/merchant-detail', $data);
	}

//	public function transaction_item()
//	{
//
//		$val = [];
//		if ($merchant == 'MOOPO') {
//			$this->load->model('MoopoModel', 'moopo');
//			$val += $this->moopo->getTransactions($id);
//
//		} elseif ($merchant == 'KAMSIA') {
//
//		} else {
//
//		}
//
//		$data = array();
//		$data['items'] = $val;
//
//		return redirect($_SERVER['HTTP_REFERER'], $val);
//	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */
