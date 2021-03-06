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
        $this->all();
    }

    public function view($project_id)
    {
        $project = $this->project_model->get($project_id, $this->user->team_id);
        set_title($project->label);
        $this->load->view('projects/view', compact('project'));
    }

    public function all()
    {
        $projects = $this->project_model->get_all_with_ticket_count($this->user->team_id, true);
        set_title('Projects');
        $this->load->view('projects/all', compact('projects'));
    }

    public function new()
    {
        $this->check_permission('project', 2);
        $projects = $this->project_model->get_all($this->user->team_id);

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
                        redirect("project/all");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error getting your project.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'There was an unknown error creating your project.');
                }
            }
        }
        set_title('New Project');
        $this->load->view('projects/new', compact('projects'));
    }

    public function edit($project_id)
    {
        $this->check_permission('project', 3);
        $project = $this->project_model->get($project_id, $this->user->team_id);

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
                    if ($data[$key] != $project->{$key}) {
                        $has_difference = true;
                    }
                }
                if ($has_difference) {
                    $updated = $this->project_model->update($project_id, $this->user->team_id, $data);
                    if ($updated) {
                        redirect("ticket/project/{$project_id}");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error updating your project.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'No changes detected.');
                }
            }
        }
        set_title('Edit Project');
        $this->load->view('projects/edit', compact('project', 'statuses'));
    }

    public function delete($project_id)
    {
        $this->check_permission('project', 3);
        if ($this->input->method() == 'post') {
            $deleted = $this->project_model->delete($project_id);
            if ($deleted) {
                $this->session->set_flashdata('success', 'Project has been deleted.');
            } else {
                $this->session->set_flashdata('error', 'There was an unknown error deleting your project.');
            }
            redirect("project/all");
        }
    }
}
