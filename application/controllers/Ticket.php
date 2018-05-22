<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ticket_model');
    }

    public function index()
    {
        $this->load->view('home');
    }

    public function view($ticket_id)
    {
        $ticket = $this->ticket_model->get($this->user->group_id, $ticket_id);
        $this->load->view('tickets/view', compact('ticket'));
    }

    public function list()
    {
        $this->load->view('tickets/list');
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
                $id = $this->ticket_model->create($title, $description);
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
}
