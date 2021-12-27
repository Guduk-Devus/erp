<?php

use Config\Database;

defined('BASEPATH') OR exit('No direct script access allowed');

class IRGModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		$this->irg = $this->load->database('irg', TRUE);
	}

	public function getItems($id)
	{
		return $this->irg->get_where('menus', array('restaurants_id' => $id))->result();
	}

	public function getTransactions($id)
	{
		$this->irg->select('*, transaction_details.transactions_id, transactions.id, sum(transaction_details.qty) as selling');
		$this->irg->from('transaction_items');
		$this->irg->join('transactions', 'transaction_details.transactions_id = transactions.id', 'inner');
		$this->kamsia->where('transaction_details.created_at', date('D-M-Y'));
		$this->irg->where('transaction_details.menus_id', $id);
		$query = $this->irg->get();

		return $query->result();
	}
}

/* End of file CityModel.php */
/* Location: ./application/models/CityModel.php */
