<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Language_model extends Admin_model
{
	public $table = "language l";
	public $select_column = ['l.id', 'l.language'];
	public $search_column = ['l.id', 'l.language'];
    public $order_column = [null, 'l.language', null];
	public $order = ['l.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
            	 ->where(['l.is_deleted' => 0]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('l.id')
		         ->from($this->table)
		         ->where(['l.is_deleted' => 0]);
		            	
		return $this->db->get()->num_rows();
	}
}