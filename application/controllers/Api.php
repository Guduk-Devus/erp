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

	private function http($url, $method, $data = null){
        
        $headers = [
            'Content-Type: text/plain'
        ];

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, $method);
        // SSL important
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //
        if ($method == 1) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

	public function merchant_post()
	{
		$post = json_decode(file_get_contents('php://input'));
		// $this->response($post->ref_code);
		$salesman = $this->auth->cekRef($post->ref_code, FALSE);
		// $this->response(['message' => $salesman]);
		$data = [
			'salesman_id' => $salesman->id,
			'merchant_id' => $post->merchant_id,
			'merchant_name' => $post->merchant_name,
			'merchant_type' => strtoupper($post->merchant_type),
		];
		// $this->response
		$this->marketing->insertMerchant($data);
		$this->response(['message' => "success"]);
	}

	public function ref_get(){
	
		$this->response(['message' => $this->auth->cekRef($this->get('ref')) ? 'available' : 'not found']);
	}

	public function moopo_post(){
		$post = json_decode(file_get_contents('php://input'));
		$http = $this->http('http://kamsia.devus-sby.com/api/util/email?email='.$post->email, 0);
		// $this->response($http);
		if (json_decode($http)->message == 'available') {
			$this->response(['message' => 'success', 'ref' => json_decode($http)->ref]);
		}else{
			$this->response(['message' => 'not available']);
		}
		
	}

}

/* End of file Api.php */
/* Location: ./application/controllers/Api.php */