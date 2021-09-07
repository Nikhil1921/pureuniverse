<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Career extends Admin_Controller {

	protected $redirect = 'career';
    protected $title = 'Career';
	protected $table = 'careers';
    protected $name = 'career';

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
        $this->load->model('career_model', 'data');
        $fetch_data = $this->data->make_datatables();
        $sr = $_POST['start'] + 1;
        $data = [];
        foreach($fetch_data as $row)
        {   
            $sub_array = [];
            $sub_array[] = $sr;
            $sub_array[] = ucwords($row->name);
            $sub_array[] = $row->phone;
            $sub_array[] = $row->email;
            $sub_array[] = $row->gender;
            $sub_array[] = $row->salary;
            $action = '<div style="display: inline-flex;" class="icon-btn">';
            
            $action .= anchor('assets/career/'.$row->resume, '<i class="fa fa-download" ></i>', ['class' => 'btn btn-primary btn-outline-primary btn-icon mr-2', 'download' => 'download']);

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
}