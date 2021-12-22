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
		$this->moopo->select('*, transaction_items.transaction_id, transactions.id, sum(transaction_items.qty) as selling');
		$this->moopo->from('transaction_items');
		$this->moopo->join('transactions', 'transaction_items.transaction_id = transactions.id', 'inner');
		$this->moopo->where('transaction_items.menus_id', $id);
		$query = $this->moopo->get();

		return $query->result();
	}
}

/* End of file CityModel.php */
/* Location: ./application/models/CityModel.php */
