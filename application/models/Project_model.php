<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

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
