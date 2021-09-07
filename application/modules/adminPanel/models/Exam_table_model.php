<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Exam_table_model extends Admin_model
{
	public $table = "exam_table t";
	public $select_column = ['t.id', 'c.cat_name', 't.e_time', 't.e_date'];
	public $search_column = ['t.id', 'c.cat_name', 't.e_time', 't.e_date'];
    public $order_column = [null, 'c.cat_name', 't.e_date', 't.e_time', null];
	public $order = ['t.id' => 'DESC'];

	public function make_query()
	{  
		$this->db->select($this->select_column)
            	 ->from($this->table)
            	 ->where(['c.is_deleted' => 0, 't.is_deleted' => 0])
                 ->join('category c', 't.cat_id = c.id');

        $this->datatable();
	}

	public function count()
	{
		$this->db->select('t.id')
		         ->from($this->table)
            	 ->where(['c.is_deleted' => 0, 't.is_deleted' => 0])
                 ->join('category c', 't.cat_id = c.id');
		            	
		return $this->db->get()->num_rows();
	}

	public function add_exam_table()
	{
        $post = [
				'cat_id' => d_id($this->input->post('cat_id')),
				'e_date' => $this->input->post('e_date'),
				'e_time' => $this->input->post('e_time')
			];

        $this->db->trans_start();
		$this->db->insert('exam_table', $post);
        foreach ($this->input->post('language') as $k => $v)
            $langs[$k] = [
				'lang_id' => d_id($v),
				'et_id'   => $this->db->insert_id()
		    ];
        $this->db->insert_batch('exam_lang', $langs);
		$this->db->trans_complete();
        
        return $this->db->trans_status();
	}

	public function update_exam_table($id)
	{
        $post = [
				'cat_id' => d_id($this->input->post('cat_id')),
				'e_date' => $this->input->post('e_date'),
				'e_time' => $this->input->post('e_time')
			];

        $this->db->trans_start();
        $this->db->where(['id' => $id])->update('exam_table', $post);
        foreach ($this->input->post('language') as $k => $v)
            $langs[$k] = [
				'lang_id' => d_id($v),
				'et_id'   => $id
		    ];
        $this->db->delete('exam_lang', ['et_id' => $id]);
        $this->db->insert_batch('exam_lang', $langs);
		$this->db->trans_complete();

        return $this->db->trans_status();
	}
}