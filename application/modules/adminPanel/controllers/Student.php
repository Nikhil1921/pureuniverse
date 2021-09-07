<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Student extends Admin_Controller {

	protected $redirect = 'student';
    protected $title = 'Student';
	protected $table = 'register';
    protected $name = 'student';

	public function index()
	{
		$data['name'] = $this->name;
		$data['title'] = $this->title;
		$data['url'] = $this->redirect;
        $data['dataTable'] = TRUE;
        $data['cats'] = $this->main->getall('category', 'id, cat_name', ['is_deleted' => 0]);

		return $this->template->load('template', "$this->redirect/home", $data);
	}

    public function get()
    {
        check_ajax();
        $this->load->model('student_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {  
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = ucwords($row->name);
            $sub_array[] = $row->email;
            $sub_array[] = $row->mobile;
            $sub_array[] = date('d-m-Y h:i A', strtotime($row->e_date));
            $sub_array[] = $row->cat_name;
            $sub_array[] = $row->amount;
            $sub_array[] = $row->hard_copy;
            
            $action = '<div style="display: inline-flex;" class="icon-btn">';
            
            /* $action .= form_button(['content' => '<i class="fa fa-pencil" ></i>', 'type'  => 'button', 'data-url' => base_url($this->redirect.'/view/'.e_id($row->id)),
                        'data-title' => "View $this->title", 'onclick' => "getModalData(this)", 'class' => 'btn btn-primary btn-outline-primary btn-icon mr-2']); */

            $action .= '</div>';
            // $sub_array[] = $action;

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

    public function view($id)
    {
        check_ajax();
        if ($this->input->server('REQUEST_METHOD') === 'GET') {
            $data['name'] = $this->name;
            $data['title'] = $this->title;
            $data['operation'] = 'view';
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
}