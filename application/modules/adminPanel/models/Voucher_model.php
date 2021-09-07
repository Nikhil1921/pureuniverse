<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Voucher_model extends Admin_model
{
	public $table = "voucher v";
	public $select_column = ['v.id', 'v.code', 'v.discount', 'r.name', 'r.mobile'];
	public $search_column = ['v.id', 'v.code', 'v.discount', 'r.name', 'r.mobile'];
    public $order_column = [null, 'v.code', 'v.discount', 'r.name', 'r.mobile', null];
	public $order = ['v.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
            	 
				 ->join('register r', 'r.id = v.u_id', 'left');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('v.id')
		         ->from($this->table)
		         
				 ->join('register r', 'r.id = v.u_id', 'left');
		            	
		return $this->db->get()->num_rows();
	}
}