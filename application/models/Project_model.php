<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

    public function create($label, $description) {
        $data = array(
            'project_id' => $this->get_next_project_id($this->user->group_id),
            'group_id' => $this->user->group_id,
            'label' => $label,
            'description' => $description,
            'created_by' => $this->user->user_id
        );
        $this->db->insert('projects', $data);
        return $this->db->insert_id();
    }

    private function get_next_project_id($group_id)
    {
        $this->db->select('id');
        $this->db->where('group_id', $group_id);
        $this->db->from('projects');
        return $this->db->get()->num_rows() + 1;
    }

    public function get_by_unique_id($id) {
        $this->db->where('id', $id);
        $this->db->from('projects');
        $ticket = $this->db->get()->first_row();
        if($ticket) {
            return $ticket;
        }
        return null;
    }

    public function get($project_id, $group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->where('project_id', $project_id);
        $this->db->from('projects');
        $project = $this->db->get()->first_row();
        return $project;
    }

    public function get_all($group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->from('projects');
        $projects = $this->db->get()->result();
        return $projects;
    }

}
