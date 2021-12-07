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

	public function marketing(){
		$this->load->model('MarketingModel', 'salesmen');
		$data['salesmen'] = $this->salesmen->index();
		$this->load->view('pages/dashboard/master_marketing', $data);
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