<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Franchise_model extends Admin_model
{
	public $table = "franchise f";
	public $select_column = ['f.id', 'f.name', 'f.mobile', 'f.email', 'f.location'];
	public $search_column = ['f.id', 'f.name', 'f.mobile', 'f.email', 'f.location'];
    public $order_column = [null, 'f.name', 'f.mobile', 'f.email', 'f.location', null];
	public $order = ['f.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
            	 ->where(['f.is_deleted' => 0]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('f.id')
		         ->from($this->table)
		         ->where(['f.is_deleted' => 0]);
		            	
		return $this->db->get()->num_rows();
	}
}