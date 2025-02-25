<?php

use Config\Database;

defined('BASEPATH') OR exit('No direct script access allowed');

class MoopoModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->moopo = $this->load->database('moopo', TRUE);
	}

	public function getItems($id)
	{
		return $this->moopo->get_where('items', array('merchant_id' => $id))->result();
	}

	public function getTransactions($id)
	{
		$where = array('transaction_items.item_id' => $id, 'transaction_items.created_at >=' => date('Y-m-d'));

		$this->moopo->select('*, transaction_items.transaction_id, transactions.id, sum(transaction_items.qty) as selling, count(transaction_items.qty) as sellings, count(transaction_items.id) as total_sale');
		$this->moopo->from('transaction_items');
		$this->moopo->join('transactions', 'transaction_items.transaction_id = transactions.id', 'inner');
		$this->moopo->where($where);
		$query = $this->moopo->get();

		return $query->result();
	}

	public function filterTransactions($data)
	{
		extract($data);
		$where = array('transaction_items.created_at' => $month);

		$this->moopo->select('*, transaction_items.transaction_id, transactions.id, sum(transaction_items.qty) as selling, count(transaction_items.qty) as sellings, count(transaction_items.id) as total_sale');
		$this->moopo->from('transaction_items');
		$this->moopo->join('transactions', 'transaction_items.transaction_id = transactions.id', 'inner');
		$this->moopo->where($where);
		$query = $this->moopo->get();

		return $query->result();
	}
}

/* End of file CityModel.php */
/* Location: ./application/models/CityModel.php */
