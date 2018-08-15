<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    private $auth_methods = ['login', 'signup'];
    public function __construct()
    {
        parent::__construct();
        $this->user = null;
        if ($this->session->userdata('user_id')) {
            $this->user = $this->session->userdata('user');
        } elseif($this->router->fetch_class() != 'home' && !in_array($this->router->fetch_method(), $this->auth_methods)) {
            redirect('user/login');
        }
        if($this->user) {
            if (empty($this->statuses)) {
                $this->statuses = $this->status_model->get_all($this->user->team_id, true);
            }
            if (empty($this->users)) {
                $this->users = $this->user_model->get_all($this->user->team_id);
            }
            if (empty($this->projects)) {
                $this->projects = $this->project_model->get_all($this->user->team_id);
            }
            if (empty($this->groups)) {
                $this->groups = $this->group_model->get_all($this->user->team_id);
            }
            if (empty($this->updated)) {
                $this->updated = $this->ticket_model->get_updated(5);
            }
        }
    }

    public function check_permission($permission, $level) {
        if (!$this->group_model->has_permission($permission, $level)) {
            $this->session->set_flashdata('error', 'You do not have permission to perform this operation.');
            redirect('/');
        }
    }
}
