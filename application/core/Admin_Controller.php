<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * 
 */
class Admin_Controller extends MY_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->auth = $this->session->auth;
		if (!$this->auth) 
			return redirect(admin('login'));

		$this->load->model('main_model', 'main');
		$this->redirect = admin($this->redirect);
		$this->user = $this->main->get('admin', '*', ['id' => $this->auth]);
	}

    public function error_404()
    {
        $data['name'] = 'error 404';
        $data['title'] = 'error 404';
        $data['url'] = $this->redirect;
        return $this->template->load('template', 'error_404', $data);
    }
}