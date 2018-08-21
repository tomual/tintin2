<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends MY_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('cookie');
        $this->load->model('user_model');
        $this->load->model('team_model');
    }

    public function index()
	{
		$this->load->view('home');
	}

    public function signup()
    {
        if($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('name', 'team Name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|matches[password]');

            if ($this->form_validation->run() !== FALSE)
            {
                $data = array(
                    'user_id' => 1,
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                );
                $user_unique_id = $this->user_model->create($data);
                if($user_unique_id) {
                    $user = $this->user_model->log_in($data['email'], $data['password']);
                    if($user) {
                        $this->session->set_userdata('user_id', $user->user_id);
                        $this->session->set_userdata('user', $user);
                        $team_id = $this->team_model->create($user_unique_id, $this->input->post('name'));
                        if($team_id) {
                            $user->team_id = $team_id;
                            $this->user_model->update($user);
                            redirect('/');
                        } else {
                            $this->session->set_flashdata('error', 'There was an unknown issue creating your team.');
                        }
                    } else {
                        $this->session->set_flashdata('error', 'There was an unknown issue logging you in.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'There was an unknown issue signing you up.');
                }
            }
        }
        $this->load->view('users/signup');
    }

    public function login()
    {
        if($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            if ($this->form_validation->run() !== FALSE)
            {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $user = $this->user_model->log_in($email, $password);
                if($user) {
                    $this->session->set_userdata('user_id', $user->user_id);
                    $this->session->set_userdata('user', $user);
                    redirect('/');
                } else {
                    $this->session->set_flashdata('error', 'Invalid login.');
                }
            }
        }
        $this->load->view('users/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }

    public function all()
    {
        $groups = $this->group_model->get_all($this->user->team_id);
        $users = $this->user_model->get_all($this->user->team_id);
        $this->load->view('users/all', compact('users', 'groups'));
    }

    public function new()
    {
        if($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');
            $this->form_validation->set_rules('group_id', 'Group', 'required');

            if ($this->form_validation->run() !== FALSE)
            {
                $data = array(
                    'team_id' => $this->user->team_id,
                    'group_id' => $this->input->post('group_id'),
                    'email' => $this->input->post('email'),
                    'password' => $this->input->post('password'),
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                );
                $user_unique_id = $this->user_model->create($data);
                if($user_unique_id) {
                    redirect('/');
                } else {
                    $this->session->set_flashdata('error', 'There was an unknown issue creating the user.');
                }
            }
        }
        $groups = $this->group_model->get_all($this->user->team_id);
        $this->load->view('users/new', compact('groups'));
    }

    public function edit($user_id)
    {
        $user = $this->user_model->get($user_id, $this->user->team_id);
        if($this->input->method() == 'post') {
            $this->load->library('form_validation');

            $email = $this->input->post('email');
            if ($email != $user->email) {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
            } else {
                $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
            }
            $this->form_validation->set_rules('first_name', 'First Name', 'required');
            $this->form_validation->set_rules('last_name', 'Last Name', 'required');
            $this->form_validation->set_rules('group_id', 'Group', 'required');

            if ($this->form_validation->run() !== FALSE)
            {
                $user->team_id = $this->user->team_id;
                $user->group_id = $this->input->post('group_id');
                $user->email = $email;
                $user->first_name = $this->input->post('first_name');
                $user->last_name = $this->input->post('last_name');
                if($password = $this->input->post('password')) {
                    $user->password = password_hash($password, PASSWORD_DEFAULT);
                }
                $updated = $this->user_model->update($user);
                if(!$updated) {
                    $this->session->set_flashdata('error', 'No changes were made.');
                } else {
                    $this->session->set_flashdata('success', 'User has been updated.');
                }
                redirect("user/edit/$user_id");
            }
        }
        $groups = $this->group_model->get_all($this->user->team_id);
        $this->load->view('users/edit', compact('user', 'groups'));
    }
}
