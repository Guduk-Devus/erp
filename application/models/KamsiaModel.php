<?php

use Config\Database;

defined('BASEPATH') OR exit('No direct script access allowed');

class KamsiaModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->kamsia = $this->load->database('kamsia', TRUE);
	}

	public function getItems($id)
	{
		return $this->kamsia->get_where('menus', array('restaurants_id' => $id))->result();
	}

	public function getTransactions($id)
	{
		$where = array('transaction_details.menus_id' => $id, 'transaction_details.created_at' => date("Y-m-d"));

		$this->kamsia->select('*, transaction_details.transactions_id, transactions.id, sum(transaction_details.qty) as selling');
		$this->kamsia->from('transaction_details');
		$this->kamsia->join('transactions', 'transaction_details.transactions_id = transactions.id', 'inner');
		$this->kamsia->where($where);
		$query = $this->kamsia->get();

		return $query->result();
	}
}

/* End of file CityModel.php */
/* Location: ./application/models/CityModel.php */
