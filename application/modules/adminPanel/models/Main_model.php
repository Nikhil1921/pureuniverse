<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Main_model extends Admin_model
{
	public function insert_batch($data, $table)
	{
		return $this->db->insert_batch($table, $data);
	}
	
	public function payment()
	{
		$total = $this->db->select('SUM(amount) amount')
		         ->from('payments')
		         ->get()->row_array();

		return $total ? $total['amount'] : 0;
	}
}