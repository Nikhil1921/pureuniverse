<?php defined('BASEPATH') OR exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Exam extends Admin_Controller {

	protected $redirect = 'exam';
    protected $title = 'Exam';
	protected $table = 'exam';
    protected $name = 'exam';

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
        $this->load->model('exam_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = $row->cat_name;
            $sub_array[] = $row->language;
            $sub_array[] = $row->exam_type;
            $sub_array[] = $row->e_code;
            $sub_array[] = $row->duration;

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
                $post = [
                    'cat_id' 		=> d_id($this->input->post('cat_id')),
                    'lang_id' 		=> d_id($this->input->post('language')),
                    'exam_type'     => $this->input->post('exam_type'),
                    'question' 		=> $this->input->post('question'),
                    'e_code' 		=> $this->input->post('e_code'),
                    'duration' 		=> $this->input->post('duration'),
                    'options' 		=> json_encode(['option' => $this->input->post('option'), 'point' => $this->input->post('point')])
                ];
                
                if ($this->main->add($post, $this->table))
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
            $data['data'] = $this->main->get($this->table, 'exam_type, question, options, e_code, duration, cat_id, lang_id', ['id' => d_id($id)]);
            
            return $this->load->view("$this->redirect/update", $data);
        }else{
            $this->form_validation->set_rules($this->validate);
            if ($this->form_validation->run() == FALSE)
            $response = [
                    'message' => str_replace("*", "", strip_tags(validation_errors('','<br>'))),
                    'status' => false
                ];
            else{
                $post = [
                    'cat_id' 		=> d_id($this->input->post('cat_id')),
                    'lang_id' 		=> d_id($this->input->post('language')),
                    'exam_type'     => $this->input->post('exam_type'),
                    'question' 		=> $this->input->post('question'),
                    'e_code' 		=> $this->input->post('e_code'),
                    'duration' 		=> $this->input->post('duration'),
                    'options' 		=> json_encode(['option' => $this->input->post('option'), 'point' => $this->input->post('point')])
                ];
                
                if ($this->main->update(['id' => d_id($id)], $post, $this->table))
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

    public function import()
    {
        check_ajax();
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['operation'] = 'import';
            $data['url'] = $this->redirect;
            $data['cats'] = $this->main->getall('category', 'id, cat_name', ['is_deleted' => 0]);
            $data['langs'] = $this->main->getall('language', 'id, language', ['is_deleted' => 0]);
            
            return $this->load->view("$this->redirect/import", $data);
        }else{
            $this->form_validation->set_rules('cat_id', 'Category', 'required|numeric', ['required' => "Select %s"]);
            $this->form_validation->set_rules('language', 'Language', 'required|numeric', ['required' => "Select %s"]);
            $this->form_validation->set_rules('e_code', 'Exam Code', 'required', ['required' => "Select %s"]);
            if ($this->form_validation->run() == FALSE)
            $response = [
                    'message' => str_replace("*", "", strip_tags(validation_errors('','<br>'))),
                    'status' => false
                ];
            else{
                if(!empty($_FILES["import"]["name"])):
                    $type = explode('.', $_FILES["import"]["type"]);
                    set_time_limit(0);
                    $object = \PhpOffice\PhpSpreadsheet\IOFactory::load($_FILES["import"]["tmp_name"]);

                    foreach($object->getWorksheetIterator() as $worksheet):
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        for($row=2; $row <= $highestRow; $row++):
                            $options = [
                                'option' => [
                                    "A" => $worksheet->getCellByColumnAndRow(2, $row)->getValue(),
                                    "B" => $worksheet->getCellByColumnAndRow(3, $row)->getValue(),
                                    "C" => $worksheet->getCellByColumnAndRow(4, $row)->getValue(),
                                    "D" => $worksheet->getCellByColumnAndRow(5, $row)->getValue()
                                ],
                                'point' => [
                                    "A" => $worksheet->getCellByColumnAndRow(6, $row)->getValue(),
                                    "B" => $worksheet->getCellByColumnAndRow(7, $row)->getValue(),
                                    "C" => $worksheet->getCellByColumnAndRow(8, $row)->getValue(),
                                    "D" => $worksheet->getCellByColumnAndRow(9, $row)->getValue()
                                ]
                            ];
                            $post[] = [
                                'cat_id' 		=> d_id($this->input->post('cat_id')),
                                'lang_id' 		=> d_id($this->input->post('language')),
                                'exam_type'     => $worksheet->getCellByColumnAndRow(10, $row)->getValue(),
                                'question' 		=> $worksheet->getCellByColumnAndRow(1, $row)->getValue(),
                                'e_code' 		=> $this->input->post('e_code'),
                                'duration' 		=> $worksheet->getCellByColumnAndRow(11, $row)->getValue(),
                                'options' 		=> json_encode($options)
                            ];
                        endfor;
                    endforeach;
                    
                    if ($post && $this->main->insert_batch($post, $this->table))
                        $response = [
                            'message' => "$this->title added.",
                            'status' => true
                        ];
                    else
                        $response = [
                            'message' => "$this->title not added. Try again.",
                            'status' => false
                        ];
                else:
                    $response = [
                            'message' => "Select excel file to upload.",
                            'status' => false
                        ];
                endif;
            }
            echo json_encode($response);
        }
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
            'field' => 'exam_type',
            'label' => 'Exam Type',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'e_code',
            'label' => 'Exam Code',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'language',
            'label' => 'Language',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'duration',
            'label' => 'Question Duration',
            'rules' => 'required|numeric',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'question',
            'label' => 'Question',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'option[]',
            'label' => 'Option',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
        [
            'field' => 'point[]',
            'label' => 'Point',
            'rules' => 'required',
            'errors' => [
                'required' => "%s is Required"
            ]
        ],
    ];
}