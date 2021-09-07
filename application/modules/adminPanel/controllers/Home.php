<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Admin_Controller {

	protected $redirect = '';
	protected $table = 'admin';

	public function index()
	{
		$data['name'] = 'dashboard';
		$data['title'] = 'dashboard';
		$data['dataTable'] = TRUE;
        $data['refresh'] = TRUE;
        $data['url'] = $this->redirect.'orders';
        $this->load->model('student_model', 'students');
        $this->load->model('exam_table_model', 'exams');
        $this->load->model('faq_model', 'faqs');
        $this->load->model('career_model', 'careers');
        $data['students'] = array_map(function($arr) {
            return [
                'cat_name' => $arr['cat_name'],
                'total' => $this->students->count_cat($arr['id']),
            ];
        }, $this->main->getall('category', 'id, cat_name', ['is_deleted' => 0]));
        
        $data['exams'] = $this->exams->count();
        $data['faqs'] = $this->faqs->count();
        $data['careers'] = $this->careers->count();
        $data['payment'] = $this->main->payment();
        
		return $this->template->load('template', 'dashboard', $data);
	}

	public function profile()
	{
        if (!$this->input->is_ajax_request()) {
            $data['name'] = 'profile';
            $data['title'] = 'profile';
            $data['url'] = $this->redirect;

            return $this->template->load('template', 'profile', $data);
        }else{
    		$this->form_validation->set_rules($this->validate);
            if ($this->form_validation->run() == FALSE)
                $response = [
                    'message' => "Some required fields are missing.",
                    'status' => false
                ];
            else{
            	$post = [
                    'name'        => $this->input->post('name'),
                    'mobile'      => $this->input->post('mobile'),
                    'email'       => $this->input->post('email')
                ];

                if ($this->input->post('password'))
                    $post['password'] = my_crypt($this->input->post('password'));
            	
            	if ($this->main->update(['id' => $this->auth], $post, $this->table))
                	$response = [
                        'message' => "Profile updated successfully.",
                        'status' => true
                    ];
                else
                    $response = [
                        'message' => "Profile not updated. Try again.",
                        'status' => false
                    ];
            }
            echo json_encode($response);
        }
	}

    public function logout()
    {
        $this->session->sess_destroy();
        return redirect(admin('login'));
    }

	public function database()
	{
		// Load the DB utility class
        $this->load->dbutil();
        
        // Backup your entire database and assign it to a variable
        $backup = $this->dbutil->backup();

        // Load the download helper and send the file to your desktop
        $this->load->helper('file');
        write_file('db/'.date('dmY').'.zip', $backup);

        return redirect(admin());
	}

    public function mobile_check($str)
    {   
        if ($this->main->check($this->table, ['mobile' => $str, 'id != ' => $this->auth], 'id'))
        {
            $this->form_validation->set_message('mobile_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    public function email_check($str)
    {   
        if ($this->main->check($this->table, ['email' => $str, 'id != ' => $this->auth], 'id'))
        {
            $this->form_validation->set_message('email_check', 'The %s is already in use');
            return FALSE;
        } else
            return TRUE;
    }

    protected $validate = [
        [
            'field' => 'name',
            'label' => 'User Name',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|callback_email_check',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'mobile',
            'label' => 'Mobile No.',
            'rules' => 'required|exact_length[10]|callback_mobile_check|numeric',
            'errors' => [
                'required' => "%s is Required",
                'numeric' => "%s is Invalid",
                'exact_length' => "%s is Invalid",
            ]
        ]
    ];
}