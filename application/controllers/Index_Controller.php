<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index_Controller extends CI_Controller{
	public function index(){
		$this->load->view('index_view');
	}
}