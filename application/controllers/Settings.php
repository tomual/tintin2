<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller {

	public function index()
	{
        $this->check_permission('settings', 1);
        $this->load->view('settings');
	}

    public function edit() {
        $this->load->model('settings_model');
        $this->load->model('team_model');
        $settings = $this->settings_model->get($this->user->team_id);
        $team = $this->team_model->get($this->user->team_id);

        $this->load->view('settings/edit', compact('team', 'settings'));
    }
}
