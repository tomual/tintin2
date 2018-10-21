<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
        $ticket = $this->ticket_model->get($ticket_id, $this->user->team_id);
        $revisions = $this->ticket_model->get_revisions($ticket_id, $this->user->team_id);

        set_title($ticket->title);
        $this->load->view('tickets/view', compact('ticket', 'revisions'));
    }

    public function all()
    {
        if ($this->input->get()) {
            $tickets = $this->ticket_model->query($this->user->team_id, $this->input->get());
        } else {
            $tickets = $this->ticket_model->get_all($this->user->team_id);
        }

        set_title('All Tickets');
        $this->load->view('tickets/all', compact('tickets'));
    }

    public function project($project_id)
    {
        $project = $this->project_model->get($project_id);
        $tickets = $this->ticket_model->query($this->user->team_id, compact('project_id'));

        set_title($project->label);
        $this->load->view('tickets/project', compact('tickets', 'project'));
    }

    public function status($status_id)
    {
        $status = $this->status_model->get($status_id);
        $tickets = $this->ticket_model->query($this->user->team_id, compact('status_id'));

        set_title($status->label);
        $this->load->view('tickets/status', compact('tickets', 'status'));
    }

    public function user($user_id)
    {
        $data = array(
            'created_by' => $this->user->id
        );

        $user = $this->user_model->get($user_id);
        $tickets = $this->ticket_model->query($this->user->team_id, $data);

        set_title($user->first_name . ' ' . $user->last_name);
        $this->load->view('tickets/user', compact('tickets', 'user'));
    }

    function new() {
        $this->check_permission('ticket', 2);
        $this->load->helper(array('form', 'url'));

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');

            if ($this->form_validation->run() !== false) {
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

        set_title('New Ticket');
        $this->load->view('tickets/new');
    }

    public function edit($ticket_id)
    {
        $this->load->helper(array('form', 'url'));

        $ticket = $this->ticket_model->get($ticket_id, $this->user->team_id);
        if (!$this->is_author($ticket->created_by, $this->user->id)) {
            $this->check_permission('ticket', 3);
        }

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('title', 'Title', 'required');
            $this->form_validation->set_rules('description', 'Description', 'required');
            $this->form_validation->set_rules('status_id', 'Status', 'required');

            if ($this->form_validation->run() !== false) {
                $data = array(
                    'title' => $this->input->post('title'),
                    'description' => $this->input->post('description'),
                    'comment' => $this->input->post('comment'),
                    'status_id' => $this->input->post('status_id'),
                    'project_id' => $this->input->post('project_id'),
                );
                $has_difference = false;
                foreach ($data as $key => $value) {
                    if (!empty($ticket->{$key}) && $data[$key] != $ticket->{$key}) {
                        $has_difference = true;
                    }
                }
                if ($has_difference || $data['comment']) {
                    $updated = $this->ticket_model->update($ticket_id, $this->user->team_id, $data);
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

        set_title('Edit Ticket');
        $this->load->view('tickets/edit', compact('ticket'));
    }

    public function quick($ticket_id)
    {
        $this->load->helper(array('form', 'url'));

        $ticket = $this->ticket_model->get($ticket_id, $this->user->team_id);
        if (!$this->is_author($ticket->created_by, $this->user->id)) {
            $this->check_permission('ticket', 3);
        }

        if ($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('status_id', 'Status', 'required');

            if ($this->form_validation->run() !== false) {
                $data = array(
                    'status_id' => $this->input->post('status_id'),
                    'comment' => $this->input->post('comment'),
                );
                $has_difference = false;
                if ($data['status_id'] != $ticket->status_id) {
                    $has_difference = true;
                }
                if ($has_difference || $data['comment']) {
                    if ($has_difference && !$this->is_author($ticket->created_by, $this->user->id)) {
                        $this->check_permission('ticket', 3);
                    } else {
                        $this->check_permission('ticket', 2);
                    }
                    $updated = $this->ticket_model->update($ticket_id, $this->user->team_id, $data);
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

    public function query()
    {
        $tickets = $this->ticket_model->query($this->user->team_id, $this->input->get());

        set_title('Search');
        $this->load->view('tickets/query', compact('tickets'));
    }

    public function ajax_search()
    {
        $tickets = $this->ticket_model->query($this->user->team_id, $this->input->post());
        foreach ($tickets as $key => $ticket) {
            $tickets[$key]->created_at = date('M j, Y', strtotime($ticket->created_at));
            $tickets[$key]->status_label = get_status_label($ticket->status_id);
        }
        header('Content-Type: application/json');
        echo json_encode($tickets);
    }

    private function is_author($created_by, $user_id) {
        return $created_by == $user_id;
    }
}
