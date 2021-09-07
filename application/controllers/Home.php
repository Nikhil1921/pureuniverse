<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Public_controller  {

	public function index()
	{
		$data['name'] = 'home';
		$data['title'] = 'home';
		$data['cats'] = $this->main->getall('category', 'cat_name, CONCAT(min_age, " - ", max_age) age, time_duration', ['is_deleted' => 0]);
        
		return $this->template->load('template', 'home', $data);
	}

	public function login()
	{
		check_ajax();
		$post = [
			'email'    => $this->input->post('email'),
			'password' => my_crypt($this->input->post('password'))
		];
		
		if ($user = $this->main->get('register', 'id user_id', $post, "register")){
			$this->session->set_userdata($user);
			$response = [
				'message' => "Login successfull.",
				'status'  => true
			];
		} else
			$response = [
				'message' => 'Invalid credentials.',
				'status'  => false
			];
		die(json_encode($response));
	}
	
	public function forgot_password()
	{
		check_ajax();
		$post = [
			'email' => $this->input->post('email')
		];
		
		if ($user = $this->main->get('register', 'id forgot_id', $post)){
			$check = $this->main->get('otp_check', 'email', $post);
			$post['otp'] = rand(1000, 9999);
			$post['validity'] = date("Y-m-d H:i:s", strtotime('+5 minutes'));
			
			empty($check) ? $this->main->add($post, 'otp_check') : $this->main->update($check, $post, 'otp_check');
			$message = "Your OTP for password reset - ".$post['otp'];
			$subject = 'OTP for password reset.';
			send_email($post['email'], $message, $subject);
			$response = [
				'message' => "OTP sent successfull.",
				'email'   => $this->input->post('email'),
				'status'  => true
			];
		}else
			$response = [
				'message' => 'Email not registered.',
				'status'  => false
			];
		die(json_encode($response));
	}
	
	public function check_otp()
	{
		check_ajax();
		$post = [
			'email' => $this->input->post('email'),
			'otp' => $this->input->post('otp'),
			'validity >= ' => date("Y-m-d H:i:s")
		];
		
		if ($this->main->get('otp_check', 'email', $post)){
			$user = $this->main->get('register', 'id user_id', ['email' => $post['email']], "register");
			$this->main->delete('otp_check', ['email' => $post['email']]);
			$this->session->set_userdata($user);
			$response = [
				'message' => "OTP check successfull. You can change your password now.",
				'status'  => true
			];
		}else
			$response = [
				'message' => 'Invalid OTP.',
				'status'  => false
			];
		die(json_encode($response));
	}
	
	public function register()
	{
		check_ajax();
		$this->form_validation->set_rules($this->register);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE)
			$response = [
                    'message' => validation_errors(),
                    'status' => false
                ];
		else{
			$voucher = $this->input->post('voucher') ? $this->main->check('voucher', ['code' => $this->input->post('voucher'), 'is_deleted' => 0], 'id') : 0;

			$post = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'address' => $this->input->post('address'),
				'country' => d_id($this->input->post('country')),
				'state' => d_id($this->input->post('state')),
				'city' => d_id($this->input->post('city')),
				'dob' => $this->input->post('dob'),
				'mobile' => $this->input->post('mobile'),
				'password' => my_crypt($this->input->post('password')),
				'exam' => d_id($this->input->post('exam_date')),
				'exam_cat' => d_id($this->input->post('exams')),
				'exam_lang' => d_id($this->input->post('exam_lang')),
				'extra' => $this->input->post('extra') ? 60 : 0,
				'voucher' => $voucher ? $voucher : 0,
			];
			
			if ($mobile = $this->main->check('register_temp', ['mobile' => $post['mobile']], 'id')) {
				$this->main->update(['id' => $mobile], $post, "register_temp");
				$id = $mobile;
			}elseif ($email = $this->main->check('register_temp', ['email' => $post['email']], 'id')) {
				$this->main->update(['id' => $email], $post, "register_temp");
				$id = $email;
			}else{
				$id = $this->main->add($post, "register_temp");
			}
			if ($id){
				$this->session->set_userdata('temp_id', $id);
				$response = [
					'message' => "Signup successfull.",
					'status'  => true
				];
			} else
				$response = [
					'message' => "Signup not successfull. Try again.",
					'status'  => false
				];
		}
		
		die(json_encode($response));
	}
	
	public function contact_post()
	{
		check_ajax();
		
		$post = [
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
				'field' => 'comments',
				'label' => 'Comments',
				'rules' => 'required|max_length[500]',
				'errors' => [
					'required' => "%s are Required",
					'max_length' => "Max 500 chars allowed",
				]
			],
			[
				'field' => 'phone',
				'label' => 'Phone',
				'rules' => 'required|exact_length[10]',
				'errors' => [
					'required' => "%s is Required",
					'exact_length' => "%s is not valid"
				]
			]
		];
		
		$this->form_validation->set_rules($post);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE)
			$response = validation_errors();
		else{
			$post = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'comments' => $this->input->post('comments'),
				'mobile' => $this->input->post('phone')
			];
			
			if ($id = $this->main->add($post, "contact_us")){
				$response = '<div class="text-success">Message saved successfull.</div>';
			} else
				$response = '<div class="text-danger">Message saved not successfull. Try again.</div>';
		}
		
		die($response);
	}
	
	public function franchise_post()
	{
		check_ajax();
		
		$post = [
			[
				'field' => 'name',
				'label' => 'Name',
				'rules' => 'required|max_length[50]',
				'errors' => [
					'required' => "%s is Required"
				]
			],
			[
				'field' => 'city',
				'label' => 'City',
				'rules' => 'required|max_length[50]',
				'errors' => [
					'required' => "%s is Required"
				]
			],
			[
				'field' => 'taluka',
				'label' => 'Taluka',
				'rules' => 'required|max_length[50]',
				'errors' => [
					'required' => "%s is Required"
				]
			],
			[
				'field' => 'district',
				'label' => 'District',
				'rules' => 'required|max_length[50]',
				'errors' => [
					'required' => "%s is Required"
				]
			],
			[
				'field' => 'state',
				'label' => 'State',
				'rules' => 'required|max_length[50]',
				'errors' => [
					'required' => "%s is Required"
				]
			],
			[
				'field' => 'pincode',
				'label' => 'Pincode',
				'rules' => 'required|exact_length[6]',
				'errors' => [
					'required' => "%s is Required"
				]
			],
			[
				'field' => 'gender',
				'label' => 'Gender',
				'rules' => 'required',
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
				'field' => 'location',
				'label' => 'Location',
				'rules' => 'required|max_length[255]',
				'errors' => [
					'required' => "%s are Required",
					'max_length' => "Max 255 chars allowed",
				]
			],
			[
				'field' => 'mobile',
				'label' => 'Phone',
				'rules' => 'required|exact_length[10]',
				'errors' => [
					'required' => "%s is Required",
					'exact_length' => "%s is not valid"
				]
			]
		];
		
		$this->form_validation->set_rules($post);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == FALSE)
			$response = validation_errors();
		else{
			$post = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'location' => $this->input->post('location'),
				'gender' => $this->input->post('gender'),
				'city' => $this->input->post('city'),
				'pincode' => $this->input->post('pincode'),
				'taluka' => $this->input->post('taluka'),
				'district' => $this->input->post('district'),
				'state' => $this->input->post('state'),
				'mobile' => $this->input->post('mobile')
			];
			
			if ($id = $this->main->add($post, "franchise")){
				$response = '<div class="text-success">Request saved successfull.</div>';
			} else
				$response = '<div class="text-danger">Request saved not successfull. Try again.</div>';
		}
		
		die($response);
	}
	
	public function career_post()
	{
		check_ajax();
		
		$post = [
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
				'field' => 'gender',
				'label' => 'gender',
				'rules' => 'required',
				'errors' => [
					'required' => "%s are Required"
				]
			],
			[
				'field' => 'mobile',
				'label' => 'Phone',
				'rules' => 'required|exact_length[10]',
				'errors' => [
					'required' => "%s is Required",
					'is_unique' => "%s is already registered",
					'exact_length' => "%s is not valid"
				]
			],
			[
				'field' => 'salary',
				'label' => 'Expected Salary',
				'rules' => 'required|max_length[10]',
				'errors' => [
					'required' => "%s is Required",
					'exact_length' => "%s is not valid"
				]
			]
		];
		
		$this->form_validation->set_rules($post);
		$this->form_validation->set_error_delimiters('', '');
        if ($this->form_validation->run() == FALSE)
			$response = [
                    'message' => validation_errors(),
                    'status' => false
                ];
		else{
			$image = $this->uploadImage("image");
			if ($image['error'])
				$response = [
						'message' => $image['message'],
						'status' => false
					];
			else{
				$post = [
					'name'   => $this->input->post('name'),
					'email'  => $this->input->post('email'),
					'gender' => $this->input->post('gender'),
					'salary' => $this->input->post('salary'),
					'resume' => $image['message'],
					'phone'  => $this->input->post('mobile')
				];
				
				if ($id = $this->main->add($post, "careers")){
					$response = [
						'message' => 'Details saved successfull.',
						'status' => false
					];
				} else
					$response = [
						'message' => 'Details saved not successfull. Try again.',
						'status' => false
					];
			}
		}
		
		die(json_encode($response));
	}

	protected function uploadImage($upload)
    {
        $this->load->library('upload');
        $config = [
                'upload_path'      => 'assets/career/',
                'allowed_types'    => 'jpg|jpeg|png|pdf|doc|docx',
                'file_name'        => time(),
                'file_ext_tolower' => TRUE
            ];

        $this->upload->initialize($config);
        if ($this->upload->do_upload($upload))
			return ['error' => false, 'message' => $this->upload->data("file_name")];
        else
            return ['error' => true, 'message' => strip_tags($this->upload->display_errors())];
    }
	
	public function payment()
	{
		$data['title'] = 'Payment';
		$data['data'] = $this->main->getTempReg();
		if ($data['data']){
			if($data['data']['voucher'])
				$data['discount'] = $this->main->check('voucher', ['id' => ($data['data']['voucher']), 'is_deleted' => 0], 'discount');
			else
				$data['discount'] = 0;
			return $this->load->view('payment', $data);
		}
		else
			$this->error_404();
	}
	
	public function payment_post()
	{
	    $this->load->view('crypto.php');
	    $workingKey = $this->config->item('working_key');
    	$encResponse = $this->input->post('encResp');
    	$rcvdString = decrypt($encResponse, $workingKey);
    	$order_status = "";
    	$decryptValues = explode('&', $rcvdString);
    	$dataSize = sizeof($decryptValues);
    	
    	for($i = 0; $i < $dataSize; $i++)
    	{
    		$information = explode('=',$decryptValues[$i]);
    		$data[reset($information)] = end($information);
    	}

		if (count($data) > 1){
			if($data['order_status'] === "Success"){
				$this->main->register($data);
			}
			
			$this->session->set_userdata('order_status', $data['order_status']);
			return redirect('payment-status');
		} else
			$this->error_404();
	}

	public function payment_test()
	{
        $this->load->view('crypto');
	    $workingKey = $this->config->item('working_key');
    	$encResponse = $this->input->post('encResp');
    	$rcvdString = decrypt($encResponse, $workingKey);
    	$order_status = "";
    	$decryptValues = explode('&', $rcvdString);
    	$dataSize = sizeof($decryptValues);
    	
    	for($i = 0; $i < $dataSize; $i++)
    	{
    		$information = explode('=',$decryptValues[$i]);
    		$data[reset($information)] = end($information);
    	}
		
		if (count($data) > 1){
			if($data['order_status'] === "Success"){
				$payment = [
                    'u_id' => $data['merchant_param3'],
                    'order_id' => $data['order_id'],
                    'tracking_id' => $data['tracking_id'],
                    'bank_ref_no' => $data['bank_ref_no'],
                    'order_status' => $data['order_status'],
                    'amount' => $data['amount'],
                    'exam' => $data['merchant_param1'],
                    'exam_lang' => $data['merchant_param2'],
                    'created_at' => date('Y-m-d H:i:s')
                ];
                $this->main->add($payment, 'payments');
                $this->session->set_userdata('u_id', $data['merchant_param3']);
			}
			
			$this->session->set_flashdata('order_status', $data['order_status']);
			return redirect('payment-status');
		} else
			$this->error_404();
	}

	public function payment_status()
	{
		$data['name'] = 'payment';
		$data['title'] = "Payment ".$this->session->order_status;
		$data['breadcrumb'] = true;
		$data['order_status'] = $this->session->order_status;
		
		return $this->template->load('template', 'payment_post', $data);
	}
	
	public function getMonths()
	{
		check_ajax();
		$response = [
			'message' => $this->main->getMonths(d_id($this->input->get('cat_id'))),
			'status' => true
		];
		die(json_encode($response));
	}
	
	public function getStates()
	{
		check_ajax();
		
		$response = [
			'message' => $this->main->getStates(d_id($this->input->get('country_id'))),
			'status' => true
		];
		die(json_encode($response));
	}
	
	public function getCities()
	{
		check_ajax();
		
		$response = [
			'message' => $this->main->getCities(d_id($this->input->get('state_id'))),
			'status' => true
		];
		die(json_encode($response));
	}
	
	public function getPapers()
	{
		check_ajax();
		
		$papers = array_map(function($arr){
			return ['e_id' => e_id($arr['id']), 'e_date' => $arr['e_date']];
		}, $this->main->getPapers($this->input->get('month'), d_id($this->input->get('cat_id'))));
		
		$response = [
			'message' => $papers,
			'status' => true
		];
		die(json_encode($response));
	}
	
	public function getLang()
	{
		check_ajax();

		$langs = array_map(function($arr){
			return ['lang_id' => e_id($arr['lang_id']), 'language' => $arr['language']];
		}, $this->main->getLang(d_id($this->input->get('e_id'))));
		
		$response = [
			'message' => $langs,
			'status' => true
		];
		die(json_encode($response));
	}
	
	public function checkVoucher()
	{
		check_ajax();

		if($this->input->get('code')){
			$id = $this->main->check('voucher', ['code' => $this->input->get('code'), 'is_deleted' => 0, 'u_id' => 0], 'id');
	
			$response = [
				'message' => ($id) ? '<span class="text-success">Voucher code applied</span>' : '<span class="text-danger">Invalid voucher code or code expired</span>',
				'status' => true
			];
		}else
			$response = [
				'message' => '',
				'status' => true
			];
		
		die(json_encode($response));
	}
	
	public function getCategory()
	{
		check_ajax();

		$langs = array_map(function($arr){
			return ['cat_id' => e_id($arr['id']), 'cat_name' => $arr['cat_name'], 'price' => $arr['price']];
		}, $this->main->getCategory($this->input->get('dob')));
		
		$response = [
			'message' => $langs,
			'status' => true
		];
		die(json_encode($response));
	}

	public function error_404()
	{
		return $this->load->view('error_404');
	}

	public function logout()
	{
		session_destroy();
		return redirect('');
	}

	public function about()
	{
		$data['name'] = 'about';
		$data['title'] = "about us";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'about', $data);
	}

	public function sample_one()
	{
		$data['name'] = 'sample_paper';
		$data['title'] = "Sample Paper";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'sample_one', $data);
	}

	public function sample_two()
	{
		$data['name'] = 'sample_paper';
		$data['title'] = "Sample Paper";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'sample_two', $data);
	}

	public function contact()
	{
		$data['name'] = 'contact';
		$data['title'] = "contact us";
		$data['breadcrumb'] = true;
		if($this->session->user_id)
			$data['user'] = $this->user = $this->main->get('register', 'name, email, mobile', ['id' => $this->session->user_id]);
		else
			$data['user'] = ['name' => '', 'email' => '', 'mobile' => ''];
		return $this->template->load('template', 'contact', $data);
	}

	public function terms()
	{
		$data['name'] = 'terms';
		$data['title'] = "terms & conditions";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'terms', $data);
	}

	public function blog()
	{
		$data['name'] = 'blog';
		$data['title'] = "blog";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'blog', $data);
	}

	public function franchise()
	{
		$data['name'] = 'franchise';
		$data['title'] = "franchise";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'franchise', $data);
	}

	public function privacy()
	{
		$data['name'] = 'privacy';
		$data['title'] = "privacy policy";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'privacy', $data);
	}

	public function disclaimer()
	{
		$data['name'] = 'disclaimer';
		$data['title'] = "disclaimer";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'disclaimer', $data);
	}

	public function faq()
	{
		$data['name'] = 'faq';
		$data['title'] = "faq";
		$data['breadcrumb'] = true;
		$data['faqs'] = $this->main->getall('faq', 'id, question, answer', ['is_deleted' => 0]);
		return $this->template->load('template', 'faq', $data);
	}

	public function career()
	{
		$data['name'] = 'career';
		$data['title'] = "career";
		$data['breadcrumb'] = true;
		if($this->session->user_id)
			$data['user'] = $this->user = $this->main->get('register', 'name, email, mobile', ['id' => $this->session->user_id]);
		else
			$data['user'] = ['name' => '', 'email' => '', 'mobile' => ''];

		return $this->template->load('template', 'career', $data);
	}

	public function gallery()
	{
		$data['name'] = 'gallery';
		$data['title'] = "gallery";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'gallery', $data);
	}

	public function media()
	{
		$data['name'] = 'media';
		$data['title'] = "media";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'media', $data);
	}

	public function discipline()
	{
		$data['name'] = 'discipline';
		$data['title'] = "discipline";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'discipline', $data);
	}

	public function courage()
	{
		$data['name'] = 'courage';
		$data['title'] = "courage";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'courage', $data);
	}

	public function self_resprct()
	{
		$data['name'] = 'self_resprct';
		$data['title'] = "self resprct";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'self_resprct', $data);
	}

	public function honesty()
	{
		$data['name'] = 'media';
		$data['title'] = "honesty";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'honesty', $data);
	}

	public function morals()
	{
		$data['name'] = 'morals';
		$data['title'] = "ETHICS & MORALS";
		$data['breadcrumb'] = true;
		return $this->template->load('template', 'morals', $data);
	}

	public function exam_table()
	{
		$data['name'] = 'exam_table';
		$data['title'] = "exam table";
		$data['breadcrumb'] = true;

		$exams = array_map(function($arr){
			return [
				'cat_name' => $arr['cat_name'],
				'time_duration' => $arr['time_duration'],
				'min_age' => $arr['min_age'],
				'max_age' => $arr['max_age'],
				'price' => $arr['price'],
				'exams' => array_map(function($arr){
					return [
						'e_time' => $arr['e_time'],
						'e_date' => $arr['e_date'],
						'langs' => $this->main->getLang($arr['id'])
					];
				}, $this->main->getall('exam_table', 'id, e_time, e_date', ['cat_id' => $arr['id']]))
			];
		}, $this->main->getall('category', 'id, cat_name, time_duration, min_age, max_age, price', ['is_deleted' => 0]));
		
		$data['exams'] = $exams;
		return $this->template->load('template', 'exam_table', $data);
	}
	
    protected $register = [
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
            'rules' => 'required|max_length[100]|is_unique[register.email]|valid_email',
            'errors' => [
                'required' => "%s is Required",
                'max_length' => "Max 100 chars allowed",
                'is_unique' => "%s is already registered",
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
            'field' => 'dob',
            'label' => 'Date of birth',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
		],
		[
            'field' => 'mobile',
            'label' => 'Mobile',
            'rules' => 'required|exact_length[10]|is_unique[register.mobile]',
            'errors' => [
                'required' => "%s is Required",
                'is_unique' => "%s is already registered",
                'exact_length' => "%s is not valid"
            ]
		],
		[
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
		],
		[
            'field' => 'exams',
            'label' => 'Exam Exam Category',
            'rules' => 'required|is_natural',
            'errors' => [
                'required' => "%s is Required",
                'is_natural' => "%s is not valid"
            ]
		],
		[
			'field' => 'exam_date',
            'label' => 'Exam Paper Date',
            'rules' => 'required|is_natural',
            'errors' => [
				'required' => "%s is Required",
                'is_natural' => "%s is not valid"
				]
		],
		[
			'field' => 'exam_lang',
			'label' => 'Exam Language',
			'rules' => 'required|is_natural',
			'errors' => [
				'required' => "%s is Required",
				'is_natural' => "%s is not valid"
			]
		],
		[
			'field' => 'country',
			'label' => 'Country',
			'rules' => 'required|is_natural',
			'errors' => [
				'required' => "%s is Required",
				'is_natural' => "%s is not valid"
			]
		],
		[
			'field' => 'state',
			'label' => 'State',
			'rules' => 'required|is_natural',
			'errors' => [
				'required' => "%s is Required",
				'is_natural' => "%s is not valid"
			]
		],
		[
			'field' => 'city',
			'label' => 'City',
			'rules' => 'required|is_natural',
			'errors' => [
				'required' => "%s is Required",
				'is_natural' => "%s is not valid"
			]
		]
    ];
}