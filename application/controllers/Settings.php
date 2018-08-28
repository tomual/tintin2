<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function index()
	{
        $this->check_permission('settings', 1);
        $this->load->view('settings');
	}
}
