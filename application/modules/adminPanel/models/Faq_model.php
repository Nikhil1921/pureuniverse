<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Faq_model extends Admin_model
{
	public $table = "faq f";
	public $select_column = ['f.id', 'f.question'];
	public $search_column = ['f.id', 'f.question'];
    public $order_column = [null, 'f.question', null];
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