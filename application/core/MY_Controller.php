<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->user = null;
        if ($this->session->userdata('user_id')) {
            $this->user = $this->session->userdata('user');
        }
        if($this->user) {
            if (empty($this->statuses)) {
                $this->statuses = $this->status_model->get_all($this->user->group_id);
            }
            if (empty($this->users)) {
                $this->users = $this->user_model->get_all($this->user->group_id);
            }
            if (empty($this->projects)) {
                $this->projects = $this->project_model->get_all($this->user->group_id);
            }
            if (empty($this->updated)) {
                $this->updated = $this->ticket_model->get_updated(5);
            }
        }
    }
}
