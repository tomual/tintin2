<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('home');
    }

    public function view($group_id)
    {
        $group = $this->group_model->get($group_id, $this->user->team_id);
        $this->load->view('groups/view', compact('group'));
    }

    public function all()
    {
        $groups = $this->group_model->get_all($this->user->team_id);
        $this->load->view('groups/all', compact('groups'));
    }

    public function new()
    {
        $groups = $this->group_model->get_all($this->user->team_id);

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('label', 'Label', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $label = $this->input->post('label');
                $ticket = $this->input->post('ticket');
                $project = $this->input->post('project');
                $user = $this->input->post('user');
                $settings = $this->input->post('settings');
                $id = $this->group_model->create($label, $ticket, $project, $user, $settings);
                if ($id) {
                    $group = $this->group_model->get_by_unique_id($id);
                    if ($id) {
                        redirect("group/all");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error getting your group.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'There was an unknown error creating your group.');
                }
            }
        }
        $this->load->view('groups/new', compact('groups'));
    }

    public function edit($group_id)
    {
        $group = $this->group_model->get($group_id, $this->user->team_id);

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('label', 'Label', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $data = array(
                    'label' => $this->input->post('label'),
                    'description' => $this->input->post('description'),
                );
                $has_difference = false;
                foreach ($data as $key => $value) {
                    if ($data[$key] != $group->{$key}) {
                        $has_difference = true;
                    }
                }
                if ($has_difference) {
                    $updated = $this->group_model->update($group_id, $this->user->team_id, $data);
                    if ($updated) {
                        redirect("ticket/group/{$group_id}");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error updating your group.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'No changes detected.');
                }
            }
        }
        $this->load->view('groups/edit', compact('group', 'statuses'));
    }

    public function delete($group_id)
    {
        if ($this->input->method() == 'post') {
            $deleted = $this->group_model->delete($group_id);
            if ($deleted) {
                redirect("group/all");
            } else {
                $this->session->set_flashdata('error', 'There was an unknown error deleting your group.');
            }
        }
    }
}
