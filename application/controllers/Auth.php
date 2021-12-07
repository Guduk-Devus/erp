<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel', 'auth');
		$this->load->model('CityModel', 'city');
	}
	public function index()
	{
		if ($this->input->post()) {
			$userData = $this->auth->login($this->input->post('email'), $this->input->post('password'));
			if (isset($userData->id)) {
				$userData->salesman_id = $this->auth->getSalesmanByUser($userData->id)->id;
				$this->session->set_userdata( (array) $userData);
				redirect(base_url('/home'));
			}else{
				$this->session->set_flashdata('error', 'Email atau Password Salah');
				$this->load->view('pages/auth/login.php');
			}
		}else{
			if ($this->session->userdata('id')) {
				redirect(base_url('/home'));
			}else{
				$this->load->view('pages/auth/login.php');
			}
		}
	}

	public function logout(){
		$user_data = $this->session->all_userdata();
	    foreach ($user_data as $key => $value) {
	        if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
	            $this->session->unset_userdata($key);
	        }
	    }
		redirect(base_url('/auth'));
	}

	public function register()
	{
		$viewdata = [];
		if ($this->input->post()) {
			echo json_encode($this->input->post());
			$data = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'password' => md5($this->input->post('password')),
			];
			$user = $this->auth->insert($data);
			$generated = $this->randomString();
			while($this->auth->cekRef($generated)){
				$generated = $this->randomString();
			}
			$data = [
				'user_id' => $user,
				'no_telp' => $this->input->post('notelp'),
				'city_id' => $this->input->post('city'),
				'code_referral' => $generated,
			];
			
			$userData = $this->auth->login($this->input->post('email'), $this->input->post('password'));
			$userData->salesman_id = $this->auth->insertSalesman($data);
			$this->session->set_userdata( (array) $userData);
			redirect(base_url('/home'));
		}else{
			$viewdata['cities'] = $this->city->getCity();
			$this->load->view('pages/auth/register', $viewdata);
		}
	}

	private function randomString($length = 8){
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}
