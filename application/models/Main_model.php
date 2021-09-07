<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Main_model extends Public_model
{
	public function add($post, $table)
	{
		if ($this->db->insert($table, $post)) {
			$id = $this->db->insert_id();
			return ($id) ? $id : true;
		}else
			return false;
	}
	
	public function getMonths($cat_id)
	{
		return $this->db->select('DATE_FORMAT(e_date, "%M") month')
						->from('exam_table')
						->where(['cat_id' => $cat_id, 'e_date >=' => date('Y-m-d')])
						->group_by('DATE_FORMAT(e_date, "%M")')
						->order_by('e_date ASC')
						->get()->result_array();
	}
	
	public function getStates($country_id)
	{
		return array_map(function($arr){
			return	[
				'id' => e_id($arr['id']),
				'name' => $arr['name']
			];
		}, $this->db->select('id, name')
					->from('states')
					->where(['country_id' => $country_id])
					->get()->result_array());
	}
	
	public function getCities($state_id)
	{
		return array_map(function($arr){
			return	[
				'id' => e_id($arr['id']),
				'name' => $arr['name']
			];
		}, $this->db->select('id, name')
					->from('cities')
					->where(['state_id' => $state_id])
					->get()->result_array());
	}
	
	public function getMonth()
	{
		return $this->db->select('DATE_FORMAT(e_date, "%M") month')
						->from('exam_table')
						->where(['e_date >=' => date('Y-m-d')])
						->group_by('DATE_FORMAT(e_date, "%M")')
						->order_by('e_date ASC')
						->get()->result_array();
	}
	
	public function getPaper($month)
	{
		return array_map(function($arr){
			return	[
				'e_date' => $arr['e_date'],
				'e_time' => $arr['e_time'],
				'cat_name' => $arr['cat_name'],
				'langs' => $this->db->select('l.language')->from('exam_lang el')->where('el.et_id', $arr['id'])->join('language l', 'el.lang_id = l.id')->get()->result_array()
			];
		}, $this->db->select('e.id, DATE_FORMAT(e_date, "%d-%m-%Y") e_date, DATE_FORMAT(e_time, "%h:%i %p") e_time, cat_name')
					->from('exam_table e')
					->where(['e_date >=' => date('Y-m-01', strtotime($month)), 'e_date <=' => date('Y-m-t', strtotime($month))])
					->join('category c', 'e.cat_id = c.id')
					->get()->result_array());
	}
	
	public function getPapers($month, $cat_id)
	{
		return $this->db->select('id, DATE_FORMAT(e_date, "%d-%m-%Y") e_date')
						->from('exam_table')
						->where(['e_date >=' => date('Y-m-01', strtotime($month)), 'e_date <=' => date('Y-m-t', strtotime($month))])
						->where(['cat_id' => $cat_id])
						->get()->result_array();
	}
	
	public function getLang($e_id)
	{
		return $this->db->select('lang_id, language')
						->from('exam_lang el')
						->where(['et_id' => $e_id])
						->join('language l', 'el.lang_id = l.id')
						->get()->result_array();
	}
	
	public function getCategory($dob)
	{
		$dob = date_diff(date_create($dob), date_create('today'))->y;
		
		return $this->db->select('id, cat_name, price')
						->from('category')
						->where(['min_age <=' => $dob, 'max_age >=' => $dob])
						->limit(1)
						->get()->result_array();
	}
	
	public function getTempReg()
	{	
		return $this->db->select('r.id, r.name, r.email, r.address, r.mobile, c.price, r.extra, country, state, city, r.voucher')
						->from('register_temp r')
						->where(['r.id' => $this->session->temp_id])
						->join('category c', 'r.exam_cat = c.id')
						->get()->row_array();
	}
	
	public function register($data)
	{	
		$user = $this->db->select('id, name, email, address, dob, mobile, password, exam, exam_cat, exam_lang, country, state, city, extra, voucher')
						->from('register_temp')
						->where(['id' => $data['merchant_param1']])
						->get()->row_array();
		
		$post = [
			'name' => $user['name'],
			'email' => $user['email'],
			'address' => $user['address'],
			'country' => $user['country'],
			'state' => $user['state'],
			'city' => $user['city'],
			'dob' => $user['dob'],
			'mobile' => $user['mobile'],
			'password' => $user['password'],
			'exam_cat' => $user['exam_cat']
		];

		$this->db->trans_start();
		$this->db->insert('register', $post);
		$auth = $this->db->insert_id();
		$payment = [
			'u_id' => $auth,
			'order_id' => $data['order_id'],
			'tracking_id' => $data['tracking_id'],
			'bank_ref_no' => $data['bank_ref_no'],
			'order_status' => $data['order_status'],
			'amount' => $data['amount'],
			'exam' => $user['exam'],
			'exam_lang' => $user['exam_lang'],
			'created_at' => date('Y-m-d H:i:s'),
			'hard_copy' => $user['extra'] ? 'Yes' : 'No'
		];
		
        $this->db->insert('payments', $payment);
        $this->db->delete('register_temp', ['id' => $user['id']]);
		if ($user['voucher'])
			$this->db->where(['id' => $user['voucher']])->update('voucher', ['u_id' => $auth, 'is_deleted' => 1]);
		$this->db->trans_complete();
        if ($this->db->trans_status() == true){
			$subject = 'Registration details';
    		$invoice['data'] = $this->main->get('exam_table', 'e_time, e_date', ['id' => $user['exam']]);
    		$invoice['data']['language'] = $this->main->check('language', ['id' => $user['exam_lang']], 'language');
    		$invoice['category'] = $this->main->get('category', 'price, cat_name', ['id' => $user['exam_cat']]);
    		$invoice['category']['extra'] = $user['extra'];
			if ($user['voucher'])
				$discount = $this->main->check('voucher', ['id' => $user['voucher']], 'discount');
			else
				$discount = 0;
			$price = round($invoice['category']['price'] * ( (100  - $discount) / 100));
    		$invoice['category']['price'] = $price;
    		$message = $this->load->view('invoice', $invoice, true);
    		send_email($post['email'], $message, $subject, true);
			
			$this->session->set_userdata('user_id', $auth);
		}
        return $this->db->trans_status();
	}

	public function getCurrentExam()
	{
		return $this->db->select('p.id, l.language, e_date, e_time, cat_name, l.id lang_id, et.id exam_id')
						->from('payments p')
						->where(['u_id' => $this->user_id, 'e_date >=' => date('Y-m-d'), 'status' => 'Pending'])
						->join('language l', 'p.exam_lang = l.id')
						->join('exam_table et', 'p.exam = et.id')
						->join('category c', 'et.cat_id = c.id')
						->get()->result_array();
	}

	public function getHistoryExam()
	{
		return $this->db->select('p.id, l.language, e_date, e_time, cat_name')
						->from('payments p')
						->where(['u_id' => $this->user_id, 'status' => 'Completed'])
						->join('language l', 'p.exam_lang = l.id')
						->join('exam_table et', 'p.exam = et.id')
						->join('category c', 'et.cat_id = c.id')
						->get()->result_array();
	}

	public function getQuiz($p_id)
	{
		return $this->db->select('p.exam, e_date, e_time, cat_name, p.exam_lang, et.cat_id, p.id pay_in')
						->from('payments p')
						->where(['u_id' => $this->user_id, 'p.id' => $p_id])
						->join('exam_table et', 'p.exam = et.id')
						->join('category c', 'et.cat_id = c.id')
						->get()->row_array();
	}

	public function getUpcommingExam()
	{
		return array_map(function($arr){
			return ['id' => $arr['id'],
					'e_date' => $arr['e_date'],
					'e_time' => $arr['e_time'],
					'cat_name' => $arr['cat_name'],
					'langs' => $this->db->select('l.language, l.id')->from('exam_lang el')->where('el.et_id', $arr['id'])->join('language l', 'el.lang_id = l.id')->get()->result_array()
				];
		}, $this->db->select('et.id, e_date, e_time, cat_name')
					->from('exam_table et')
					->where(['cat_id' => $this->user['exam_cat'], 'e_date >=' => date('Y-m-d')])
					->join('category c', 'et.cat_id = c.id')
					->get()->result_array());
	}

	public function getQuestions($exam_lang, $p_id)
	{
		$quiz = $this->db->select('e.id, e.exam_type, e.question, e.options, e.duration')
					->from('exam e')
					->where(['cat_id' => $this->user['exam_cat'], 'lang_id' => $exam_lang])
					->order_by('exam_type ASC')
					->get()->result_array();
		foreach ($quiz as $k => $v) {
			$point = $this->db->select('points')
					->from('quiz')
					->where(['exam_id' => $v['id'], 'pay_in' => $p_id])
					->get()->row_array();
			$quiz[$k]['points'] = $point == false ? false : $point['points'];
		}
		return $quiz;
	}

	public function getRescheduleList()
	{
		return array_map(function($arr){
			return [
				'exam_id' => e_id($arr['id']),
				'e_date'  => date('d-m-Y', strtotime($arr['e_date'])).' - '.date('h:i A', strtotime($arr['e_time']))
			];
		}, $this->db->select('e.id, e.e_time, e.e_date')
				->from('exam_table e')
				->where(['e.cat_id' => $this->user['exam_cat'], 'e.is_deleted' => 0, 'el.lang_id' => d_id($this->input->get('lang_id'))])
				->join('exam_lang el', 'e.id = el.et_id')
				->get()->result_array());
	}
}