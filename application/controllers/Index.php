<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Index_model');
	}

	public function index(){
		$data['empleados'] = $this->Index_model->getDatosEmpleados();
		$this->load->view('index_view', $data);
	}
}