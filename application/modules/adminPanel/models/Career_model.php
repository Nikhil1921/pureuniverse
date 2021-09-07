<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Career_model extends Admin_model
{
	public $table = "careers c";
	public $select_column = ['c.id', 'c.name', 'c.phone', 'c.email', 'c.gender', 'c.salary', 'c.resume'];
	public $search_column = ['c.id', 'c.name', 'c.phone', 'c.email', 'c.gender', 'c.salary'];
    public $order_column = [null, 'c.name', 'c.phone', 'c.email', 'c.gender', 'c.salary', null];
	public $order = ['c.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
            	 ->where(['c.is_deleted' => 0]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('c.id')
		         ->from($this->table)
		         ->where(['c.is_deleted' => 0]);
		            	
		return $this->db->get()->num_rows();
	}
}