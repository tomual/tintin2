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

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'Team name', 'required');
            $this->form_validation->set_rules('status_start', 'Start status', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $name = $this->input->post('name');
                $status_start = $this->input->post('status_start');
                $this->team_model->update($this->user->team_id, $name);
                $this->settings_model->update($this->user->team_id, $status_start);
                $this->session->set_flashdata('success', 'Settings have been updated.');
                redirect("settings/edit");
            }
        }

        $this->load->view('settings/edit', compact('team', 'settings'));
    }
}
