<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->load->view('home');
    }

    public function view($ticket_id)
    {
        $ticket = $this->ticket_model->get($ticket_id, $this->user->group_id);
        $revisions = $this->ticket_model->get_revisions($ticket_id, $this->user->group_id);
        $this->load->view('tickets/view', compact('ticket', 'revisions'));
    }

    public function all()
    {
        if($this->input->get()) {
            $tickets = $this->ticket_model->query($this->user->group_id, $this->input->get());
        } else {
            $tickets = $this->ticket_model->get_all($this->user->group_id);
        }
        $this->load->view('tickets/all', compact('tickets'));
    }

    public function project($project_id)
    {
        $project = $this->project_model->get($project_id);
        $tickets = $this->ticket_model->query($this->user->group_id, compact($project_id));
        $this->load->view('tickets/all', compact('tickets', 'project'));
    }

    public function new()
    {
        $this->load->helper(array('form', 'url'));

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $title = $this->input->post('title');
                $description = $this->input->post('description');
                $project_id = $this->input->post('project_id');
                $id = $this->ticket_model->create($title, $description, $project_id);
                if ($id) {
                    $ticket = $this->ticket_model->get_by_unique_id($id);
                    if ($id) {
                        redirect("ticket/view/{$ticket->ticket_id}");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error getting your ticket.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'There was an unknown error creating your ticket.');
                }
            }
        }
        $this->load->view('tickets/new');
    }

    public function edit($ticket_id)
    {
        $this->load->helper(array('form', 'url'));

        $ticket = $this->ticket_model->get($ticket_id, $this->user->group_id);

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('status_id', 'Status', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $data = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'comment' => $this->input->post('comment'),
                    'status_id' => $this->input->post('status_id'),
                    'project_id' => $this->input->post('project_id')
                );
                $has_difference = false;
                foreach($data as $key => $value) {
                    if(!empty($ticket->{$key}) && $data[$key] != $ticket->{$key}) {
                        $has_difference = true;
                    }
                }
                if($has_difference || $data['comment']) {
                    $updated = $this->ticket_model->update($ticket_id, $this->user->group_id, $data);
                    if ($updated) {
                        redirect("ticket/view/{$ticket_id}");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error updating your ticket.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'No changes detected.');
                }
            }
        }
        $this->load->view('tickets/edit', compact('ticket'));
    }

    public function quick($ticket_id)
    {
        $this->load->helper(array('form', 'url'));

        $ticket = $this->ticket_model->get($ticket_id, $this->user->group_id);

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('status_id', 'Status', 'required');

            if ($this->form_validation->run() !== FALSE) {
                $data = array(
                    'status_id' => $this->input->post('status_id'),
                    'comment' => $this->input->post('comment'),
                );
                $has_difference = false;
                foreach($data as $key => $value) {
                    if($data[$key] != $ticket->{$key}) {
                        $has_difference = true;
                    }
                }
                if($has_difference || $data['comment']) {
                    $updated = $this->ticket_model->update($ticket_id, $this->user->group_id, $data);
                    if ($updated) {
                        redirect("ticket/view/{$ticket_id}");
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown error updating your ticket.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'No changes detected.');
                }
            }
        }
        redirect("ticket/view/{$ticket_id}");
    }
}
