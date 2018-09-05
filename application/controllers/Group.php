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
        $this->all();
    }

    public function view($group_id)
    {
        $group = $this->group_model->get($group_id, $this->user->team_id);
        set_title($group->label);
        $this->load->view('groups/view', compact('group'));
    }

    public function all()
    {
        $groups = $this->group_model->get_all($this->user->team_id, true);
        set_title('Groups');
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
                $settings = $this->input->post('settings');
                $id = $this->group_model->create($label, $ticket, $project, $settings);
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
        set_title('New Group');
        $this->load->view('groups/new', compact('groups'));
    }

    public function edit($group_id)
    {
        $group = $this->group_model->get($group_id, $this->user->team_id);

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('label', 'Label', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $label = $this->input->post('label');
                $ticket = $this->input->post('ticket');
                $project = $this->input->post('project');
                $settings = $this->input->post('settings');
                $this->group_model->update($group_id, $this->user->team_id, $label, $ticket, $project, $settings);
                $this->session->set_flashdata('success', 'Group has been updated.');
                redirect("group/all");
            }
        }
        set_title('Edit Group');
        $this->load->view('groups/edit', compact('group'));
    }

    public function delete($group_id)
    {
        if ($this->input->method() == 'post') {
            $deleted = $this->group_model->delete($group_id);
            if ($deleted) {
                $this->session->set_flashdata('success', 'Group has been deleted.');
            } else {
                $this->session->set_flashdata('error', 'There was an unknown error deleting your group.');
            }
            redirect("group/all");
        }
    }

    public function users($group_id)
    {
        $groups = $this->group_model->get_all($this->user->team_id);
        $users = $this->user_model->get_by_group_id($group_id);
        $this->load->view('groups/users', compact('group_id', 'users', 'groups'));
    }
}
