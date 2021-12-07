<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel', 'auth');
		$this->load->model('MarketingModel', 'marketing');
	}

	public function merchant_post()
	{
		$salesman = $this->auth->getSalesmanByRef($this->input->post('ref_code'));
		$data = [
			'salesman_id' => $salesman->id,
			'merchant_id' => $this->input->post('merchant_id'),
			'merchant_name' => $this->input->post('merchant_name'),
			'merchant_type' => strtoupper($this->input->post('merchant_type')),
		];
		$this->marketing->insertMerchant($data);
		$this->response(['message' => 'success']);
	}

	public function ref_get(){
		$this->response(['message' => $this->auth->cekRef($this->get('ref')) ? 'available' : 'not found']);
	}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */