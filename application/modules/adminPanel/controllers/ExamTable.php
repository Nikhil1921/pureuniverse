<?php defined('BASEPATH') OR exit('No direct script access allowed');

class ExamTable extends Admin_Controller {

	protected $redirect = 'examTable';
    protected $title = 'Exam Table';
	protected $table = 'exam_table';
    protected $name = 'examTable';

	public function index()
	{
		$data['name'] = $this->name;
		$data['title'] = $this->title;
		$data['url'] = $this->redirect;
        $data['dataTable'] = TRUE;
		return $this->template->load('template', "$this->redirect/home", $data);
	}

    public function get()
    {
        check_ajax();
        $this->load->model('exam_table_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->cat_name;
            $sub_array[] = date('d-m-Y', strtotime($row->e_date));
            $sub_array[] = date('h:i A', strtotime($row->e_time));

            $action = '<div style="display: inline-flex;" class="icon-btn">';
            $action .= form_button(['content' => '<i class="fa fa-pencil" ></i>', 'type'  => 'button', 'data-url' => base_url($this->redirect.'/update/'.e_id($row->id)),
                        'data-title' => "Update $this->title", 'onclick' => "getModalData(this)", 'class' => 'btn btn-primary btn-outline-primary btn-icon mr-2']);

            $action .= form_open($this->redirect.'/delete', 'id="'.e_id($row->id).'"', ['id' => e_id($row->id)]).
            form_button([ 'content' => '<i class="fa fa-trash"></i>',
                'type'  => 'button',
                'class' => 'btn btn-danger btn-outline-danger btn-icon', 
                'onclick' => "script.delete(".e_id($row->id)."); return false;"]).
            form_close();

            $action .= '</div>';
            $sub_array[] = $action;

            $data[] = $sub_array;  
            $sr++;
        }

        $output = [
            "draw"              => intval($_POST["draw"]),  
            "recordsTotal"      => $this->data->count(),
            "recordsFiltered"   => $this->data->get_filtered_data(),
            "data"              => $data
        ];
        
        echo json_encode($output);
    }

    public function add()
    {
        check_ajax();
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['operation'] = 'add';
            $data['url'] = $this->redirect;
            $data['cats'] = $this->main->getall('category', 'id, cat_name', ['is_deleted' => 0]);
            $data['langs'] = $this->main->getall('language', 'id, language', ['is_deleted' => 0]);
            
            return $this->load->view("$this->redirect/add", $data);
        }else{
            $this->form_validation->set_rules($this->validate);
            if ($this->form_validation->run() == FALSE)
            $response = [
                    'message' => str_replace("*", "", strip_tags(validation_errors('','<br>'))),
                    'status' => false
                ];
            else{
                $this->load->model('exam_table_model', 'exam');
                if ($this->exam->add_exam_table())
                    $response = [
                        'message' => "$this->title added.",
                        'status' => true
                    ];
                else
                    $response = [
                        'message' => "$this->title not added. Try again.",
                        'status' => false
                    ];
            }
            echo json_encode($response);
        }
    }

    public function update($id)
    {
        check_ajax();
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['operation'] = 'update';
            $data['url'] = $this->redirect;
            $data['id'] = $id;
            $data['cats'] = $this->main->getall('category', 'id, cat_name', ['is_deleted' => 0]);
            $data['langs'] = $this->main->getall('language', 'id, language', ['is_deleted' => 0]);
            $data['data'] = $this->main->get($this->table, 'cat_id, e_time, e_date', ['id' => d_id($id)]);
            
            $data['data']['langs'] = array_map(function($ar){
                return $ar['lang_id'];
            }, $this->main->getall('exam_lang', 'lang_id', ['et_id' => d_id($id)]));
            
            return $this->load->view("$this->redirect/update", $data);
        }else{
            $this->form_validation->set_rules($this->validate);
            if ($this->form_validation->run() == FALSE)
            $response = [
                    'message' => str_replace("*", "", strip_tags(validation_errors('','<br>'))),
                    'status' => false
                ];
            else{
                $this->load->model('exam_table_model', 'exam');
                if ($this->exam->update_exam_table(d_id($id)))
                    $response = [
                        'message' => "$this->title updated.",
                        'status' => true
                    ];
                else
                    $response = [
                        'message' => "$this->title not updated. Try again.",
                        'status' => false
                    ];
            }
            echo json_encode($response);
        }
    }

    public function delete()
    {
        check_ajax();
        $this->form_validation->set_rules('id', 'id', 'required|numeric');
        if ($this->form_validation->run() == FALSE)
            $response = [
                        'message' => "Some required fields are missing.",
                        'message' => validation_errors(),
                        'status' => false
                    ];
        else
            if ($this->main->update(['id' => d_id($this->input->post('id'))], ['is_deleted' => 1], $this->table))
                $response = [
                    'message' => "$this->title deleted.",
                    'status' => true
                ];
            else
                $response = [
                    'message' => "$this->title not deleted. Try again.",
                    'status' => false
                ];
        echo json_encode($response);
    }

    protected $validate = [
        [
            'field' => 'cat_id',
            'label' => 'Category',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => "Select %s"
            ]
        ],
        [
            'field' => 'e_date',
            'label' => 'Date',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'e_time',
            'label' => 'Time',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'language[]',
            'label' => 'Language',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ]
    ];
}