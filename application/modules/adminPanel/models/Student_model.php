<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Student_model extends Admin_model
{
	public $table = "register r";
	public $select_column = ['r.id', 'r.name', 'r.email', 'r.mobile', 'r.dob', 'c.cat_name', 'p.amount', '(c.price * 1.18) price', 'CONCAT(et.e_date, " ",et.e_time) e_date', 'p.hard_copy'];
	public $search_column = ['r.id', 'r.name', 'r.email', 'r.mobile', 'r.dob', 'c.cat_name', 'p.amount'];
    public $order_column = [null, 'r.name', 'r.email', 'r.mobile', 'r.dob', 'c.cat_name', 'p.amount', null];
	public $order = ['r.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
            	 ->where(['c.is_deleted' => 0])
            	 ->join('payments p', 'r.id = p.u_id')
            	 ->join('category c', 'r.exam_cat = c.id')
            	 ->join('exam_table et', 'et.id = p.exam');
		if ($this->input->post('status'))
			$this->db->where(['r.exam_cat' => d_id($this->input->post('status'))]);

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('r.id')
		         ->from($this->table)
            	 ->where(['c.is_deleted' => 0])
            	 ->join('payments p', 'r.id = p.u_id')
            	 ->join('category c', 'r.exam_cat = c.id')
            	 ->join('exam_table et', 'et.id = c.id');
		if ($this->input->post('status'))
			$this->db->where(['r.exam_cat' => d_id($this->input->post('status'))]);
		            	
		return $this->db->get()->num_rows();
	}

	public function count_cat($exam_cat)
	{
		$this->db->select('COUNT(r.id) total')
		         ->from($this->table)
            	 ->where(['r.exam_cat' => $exam_cat]);
		            	
		return $this->db->get()->row_array()['total'];
	}
}