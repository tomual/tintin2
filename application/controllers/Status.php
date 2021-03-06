<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->all();
    }

    public function view($status_id)
    {
        $status = $this->status_model->get($status_id, $this->user->team_id);
        set_title($status->label);
        $this->load->view('statuses/view', compact('status'));
    }

    public function all()
    {
        $statuses = $this->status_model->get_all($this->user->team_id, true);
        set_title('Statuses');
        $this->load->view('statuses/all', compact('statuses'));
    }

    public function new()
    {
        $this->check_permission('settings', 3);
        $this->load->helper(array('form', 'url'));

        $statuses = $this->status_model->get_all($this->user->team_id);

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('label', 'Label', 'required');
            $this->form_validation->set_rules('color', 'Color', 'required');
            $this->form_validation->set_rules('complete', 'complete', 'alpha');
            $this->form_validation->set_rules('cancel', 'cancel', 'alpha');

            if ($this->form_validation->run() !== FALSE) {
                $label = $this->input->post('label');
                $color = $this->input->post('color');
                $cancel = $this->input->post('cancel') ?? 'N';
                $complete = $this->input->post('complete') ?? 'N';
                $id = $this->status_model->create($label, $color, $cancel, $complete);
                if ($id) {
                    $status = $this->status_model->get_by_unique_id($id);
                    if ($id) {
                        redirect("status/all");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error getting your status.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'There was an unknown error creating your status.');
                }
            }
        }
        set_title('New Status');
        $this->load->view('statuses/new', compact('statuses'));
    }

    public function edit($status_id)
    {
        $this->check_permission('settings', 3);
        $this->load->helper(array('form', 'url'));

        $status = $this->status_model->get($status_id, $this->user->team_id);

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('label', 'Label', 'required');
            $this->form_validation->set_rules('color', 'color', 'required');
            $this->form_validation->set_rules('complete', 'complete', 'alpha');
            $this->form_validation->set_rules('cancel', 'cancel', 'alpha');

            if ($this->form_validation->run() !== FALSE) {
                $data = array(
                    'label' => $this->input->post('label'),
                    'color' => $this->input->post('color'),
                    'cancel' => $this->input->post('cancel'),
                    'complete' => $this->input->post('complete'),
                );
                $has_difference = false;
                foreach ($data as $key => $value) {
                    if ($data[$key] != $status->{$key}) {
                        $has_difference = true;
                    }
                }
                if ($has_difference) {
                    $updated = $this->status_model->update($status_id, $this->user->team_id, $data);
                    if ($updated) {
                        redirect("ticket/status/{$status_id}");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error updating your status.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'No changes detected.');
                }
            }
        }
        set_title('Edit Status');
        $this->load->view('statuses/edit', compact('status', 'statuses'));
    }

    public function delete($status_id)
    {
        $this->check_permission('settings', 3);
        if ($this->input->method() == 'post') {
            $deleted = $this->status_model->delete($status_id);
            if ($deleted) {
                redirect("status/all");
            } else {
                $this->session->set_flashdata('error', 'There was an unknown error deleting your status.');
            }
        }
    }

    public function ajax_set_order() {
        $this->check_permission('settings', 3);
        if ($this->input->method() == 'post') {
            $data = $this->input->post('data');
            $updated = $this->status_model->set_order($data);
            echo $updated;
        }
    }
}
