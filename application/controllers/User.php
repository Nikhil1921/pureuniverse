<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User extends Public_controller  {

    public function __construct()
	{
		parent::__construct();
		$this->user_id = $this->session->user_id;
		if (!$this->user_id) 
            return redirect('');
        
		$this->user = $this->main->get('register', '*', ['id' => $this->user_id]);
        // $this->langs = $this->main->check('payments', ['id' => $this->user_id], 'exam_lang');
	}

	public function index()
	{
		$data['name'] = 'profile';
		$data['title'] = "profile";
		$data['breadcrumb'] = true;
		$data['current'] = $this->main->getCurrentExam();
		$data['upcomming'] = $this->main->getUpcommingExam();
		$data['history'] = $this->main->getHistoryExam();
		$data['lang'] = $this->main->check('payments', ['u_id' => $this->user_id], 'exam_lang');
		
		return $this->template->load('template', 'profile', $data);
	}

	public function quiz($p_id)
	{
		$data['name'] = 'quiz';
		$data['title'] = "quiz";
		$data['removeHeader'] = true;
		$data['p_id'] = $p_id;
        $data['current'] = $this->main->getQuiz(d_id($p_id));
        
		if ($data['current']) {
            $data['exam'] = $this->main->getQuestions($data['current']['exam_lang'], d_id($p_id));
            
            return $this->template->load('template', 'quiz', $data);
        }else
            return $this->error_404();
	}

	public function save_answer()
	{
        check_ajax();
        $data['current'] = $this->main->getQuiz(d_id($this->input->post('p_id')));
        $data['p_id'] = $this->input->post('p_id');
        
        $post = [
            'pay_in'  => $data['current']['pay_in'],
            'exam_id' => d_id($this->input->post('quetion')),
            'points'  => $this->input->post('answer') ? $this->input->post('answer') : 0
        ];
        $this->main->add($post, 'quiz');
		$data['exam'] = $this->main->getQuestions($data['current']['exam_lang'], $data['current']['pay_in']);
        
        die($this->load->view('quiz_ajax', $data, true));
	}

	public function complete_quiz()
	{
        check_ajax();
        $this->main->update(['id' => d_id($this->input->post('p_id'))], ['status' => "Completed"], "payments");
        die();
	}

	public function quiz_details($id)
	{
        $data['current'] = $this->main->getQuiz(d_id($id));
        if ($data['current']) {
            $data['exam'] = $this->main->getQuestions($data['current']['exam_lang'], $data['current']['pay_in']);
            
            $this->template->load('template', 'quiz_details', $data);
        }else
            $this->error_404();
	}

	public function reschedule()
	{
        check_ajax();
        if (!$this->input->post('exam_id') || !$this->input->post('pay_id'))
            die(json_encode(['message' => "Something not going good. Try again.", 'status' => false]));
        if ($this->main->update(['id' => d_id($this->input->post('pay_id'))], ['exam' => d_id($this->input->post('exam_id'))], "payments"))
            $response = [
                'message' => "Exam reschedule succssfull.",
                'status' => true
            ];
        else
            $response = [
                'message' => "Exam reschedule not succssfull. Try again.",
                'status' => false
            ];
		die(json_encode($response));
	}

	public function pay_test()
	{
        $data['title'] = 'Payment';
		$data['data'] = $this->input->post();
		$extra = $this->input->post('extra') ? 60 : 0;
        $data['data']['amount'] = $this->main->get('category', '(price * 1.18 + '.$extra.') price', ['id' => $this->user['exam_cat']])['price'];
        
		if ($data['data'])
			return $this->load->view('pay_test', $data);
		else
			$this->error_404();
	}

	public function update_profile()
	{
        check_ajax();
        $this->form_validation->set_rules($this->profile);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE)
			$response = [
                    'message' => validation_errors(),
                    'status' => false
                ];
		else{
            if ($this->main->check('register', ['mobile' => $this->input->post('mobile'), 'id !=' => $this->user_id], 'id'))
                die(json_encode(['message' => "Mobile already in use.",'status' => false]));
            if ($this->main->check('register', ['email' => $this->input->post('email'), 'id !=' => $this->user_id], 'id'))
                die(json_encode(['message' => "Email already in use.",'status' => false]));
            $post = [
                'name' => $this->input->post('name'),
                'mobile' => $this->input->post('mobile'),
                'email' => $this->input->post('email'),
                'address' => $this->input->post('address')
            ];
            
            if ($this->input->post('password'))
                $post['password'] = my_crypt($this->input->post('password'));
            
            if ($this->main->update(['id' => $this->user_id], $post, "register"))
                $response = [
                    'message' => "Profile update succssfull.",
                    'status' => true
                ];
            else
                $response = [
                    'message' => "Profile update not succssfull. Try again.",
                    'status' => false
                ];
        }
		die(json_encode($response));
	}
	
	public function getRescheduleList()
	{
		check_ajax();
		
		$response = [
			'message' => $this->main->getRescheduleList(),
			'status' => true
		];
		die(json_encode($response));
	}
	
    protected $profile = [
        [
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required|max_length[50]',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|max_length[100]|valid_email',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "Max 100 chars allowed",
                'valid_email' => "%s is not valid"
            ]
		],
        [
            'field' => 'address',
            'label' => 'Address',
            'rules' => 'required|max_length[255]',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "Max 255 chars allowed",
            ]
		],
		[
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|exact_length[10]',
            'errors' => [
                'required' => "%s is Required",
                'exact_length' => "%s is not valid"
            ]
		]
    ];
}