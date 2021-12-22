<?php

use Config\Database;

defined('BASEPATH') OR exit('No direct script access allowed');

class MoopoModel extends CI_Model {

	public function __construct()
	{
		$this->moopo = $this->load->database('moopo', TRUE);
	}

	public function getItems($id)
	{
		return $this->moopo->get_where('items', array('merchant_id' => $id))->result();
	}

	public function getTransactions($id)
	{
		$this->moopo->select('*, transaction_items.transaction_id, transactions.id, sum(transaction_items.qty) as selling, sum(transactions.total)  as totals');
		$this->moopo->from('transaction_items');
		$this->moopo->join('transactions', 'transaction_items.transaction_id = transactions.id', 'inner');
		$this->moopo->where('transaction_items.item_id', $id);
		$query = $this->moopo->get();

		return $query->result();
	}

	public function picCity()
	{
		$this->db->select('*, indonesia_provinces.name as province, indonesia_cities.name as city');
		$this->db->join('indonesia_provinces', 'indonesia_provinces.id = indonesia_cities.province_id', 'inner');
		$this->db->where('indonesia_cities.user_id', $this->session->userdata('id'));

		return $this->db->get('indonesia_cities')->result();
	}
}

/* End of file CityModel.php */
/* Location: ./application/models/CityModel.php */
