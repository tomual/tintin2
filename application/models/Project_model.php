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

    public function update($project_id, $group_id, $data)
    {
        $this->db->set($data);
        $this->db->where('project_id', $project_id);
        $this->db->where('group_id', $group_id);
        $this->db->update('projects');
        return $this->db->affected_rows();
    }

    public function delete($project_id, $group_id = null)
    {
        if(!$group_id) {
            $group_id = $this->user->group_id;
        }
        $this->db->set('removed', 'Y');
        $this->db->where('project_id', $project_id);
        $this->db->where('group_id', $group_id);
        $this->db->update('projects');
        return $this->db->affected_rows();
    }

    public function get($project_id, $group_id = null)
    {
        if(!$group_id) {
            $group_id = $this->user->group_id;
        }
        $this->db->where('group_id', $group_id);
        $this->db->where('project_id', $project_id);
        $this->db->from('projects');
        $project = $this->db->get()->first_row();
        return $project;
    }

    public function get_all($group_id, $active = false)
    {
        $this->db->where('group_id', $group_id);
        if($active) {
            $this->db->where('removed', 'N');
        }
        $this->db->from('projects');
        $projects = $this->db->get()->result();
        return $projects;
    }

    public function get_all_with_ticket_count($group_id, $active = false)
    {
        $this->db->select('projects.*, COUNT(*) as tickets, complete.count as complete');
        $this->db->where('projects.group_id', $group_id);
        if($active) {
            $this->db->where('removed', 'N');
        }
        $this->db->from("projects");
        $this->db->join("(SELECT * FROM tickets WHERE status_id != 6) tickets", "tickets.project_id = projects.project_id AND tickets.group_id = projects.group_id", "left");
        $this->db->join("(SELECT project_id, group_id, COUNT(*) AS count FROM tickets WHERE status_id = 5 AND group_id = $group_id GROUP BY project_id) complete", "complete.project_id = projects.project_id AND complete.group_id = projects.group_id", 'left');
        $this->db->group_by('project_id');
        $projects = $this->db->get()->result();
        return $projects;
    }


    public function get_label($project_id, $group_id = null)
    {
        if(!$group_id) {
            $group_id = $this->user->group_id;
        }
        $this->db->where('project_id', $project_id);
        $this->db->where('group_id', $group_id);
        $this->db->from('projects');
        $project = $this->db->get()->first_row();
        return $project->label ?? null;
    }
}
