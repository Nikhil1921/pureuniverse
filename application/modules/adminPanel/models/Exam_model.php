<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Exam_model extends Admin_model
{
	public $table = "exam e";
	public $select_column = ['e.id', 'c.cat_name', 'l.language', 'e.exam_type', 'e.e_code', 'e.duration'];
	public $search_column = ['e.id', 'c.cat_name', 'l.language', 'e.exam_type', 'e.e_code', 'e.duration'];
    public $order_column = [null, 'c.cat_name', 'l.language', 'e.exam_type', 'e.e_code', 'e.duration', null];
	public $order = ['e.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
            	 ->where(['c.is_deleted' => 0, 'e.is_deleted' => 0])
                 ->join('category c', 'e.cat_id = c.id')
                 ->join('language l', 'e.lang_id = l.id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('e.id')
		         ->from($this->table)
            	 ->where(['c.is_deleted' => 0, 'e.is_deleted' => 0])
                 ->join('category c', 'e.cat_id = c.id')
                 ->join('language l', 'e.lang_id = l.id');
		            	
		return $this->db->get()->num_rows();
	}
}