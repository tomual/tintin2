<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('home');
    }

    public function view($project_id)
    {
        $project = $this->project_model->get($project_id, $this->user->group_id);
        $this->load->view('projects/view', compact('project'));
    }

    public function all()
    {
        $projects = $this->project_model->get_all($this->user->group_id);
        $this->load->view('projects/all', compact('projects'));
    }

    public function new()
    {
        $this->load->helper(array('form', 'url'));

        $projects = $this->project_model->get_all($this->user->group_id);

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('label', 'Label', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $label = $this->input->post('label');
                $description = $this->input->post('description');
                $id = $this->project_model->create($label, $description);
                if ($id) {
                    $project = $this->project_model->get_by_unique_id($id);
                    if ($id) {
                        redirect("project/list");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error getting your project.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'There was an unknown error creating your project.');
                }
            }
        }
        $this->load->view('projects/new', compact('projects'));
    }

    public function edit($project_id)
    {
        $this->load->helper(array('form', 'url'));

        $project = $this->project_model->get($project_id, $this->user->group_id);
        $statuses = $this->status_model->get_all($this->user->group_id);

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('label', 'Label', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('status_id', 'Status', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $data = array(
                    'label' => $this->input->post('label'),
                    'description' => $this->input->post('description'),
                    'status_id' => $this->input->post('status_id'),
                );
                $has_difference = false;
                foreach ($data as $key => $value) {
                    if ($data[$key] != $project->{$key}) {
                        $has_difference = true;
                    }
                }
                if ($has_difference) {
                    $updated = $this->project_model->update($project_id, $this->user->group_id, $data);
                    if ($updated) {
                        redirect("project/view/{$project_id}");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error updating your project.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'No changes detected.');
                }
            }
        }
        $this->load->view('projects/edit', compact('project', 'statuses'));
    }
}
