<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project_model extends CI_Model {

    public function create($label, $description) {
        $data = array(
            'project_id' => $this->get_next_project_id($this->user->team_id),
            'team_id' => $this->user->team_id,
            'label' => $label,
            'description' => $description,
            'created_by' => $this->user->user_id
        );
        $this->db->insert('projects', $data);
        return $this->db->insert_id();
    }

    private function get_next_project_id($team_id)
    {
        $this->db->select('id');
        $this->db->where('team_id', $team_id);
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

    public function update($project_id, $team_id, $data)
    {
        $this->db->set($data);
        $this->db->where('project_id', $project_id);
        $this->db->where('team_id', $team_id);
        $this->db->update('projects');
        return $this->db->affected_rows();
    }

    public function delete($project_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->set('removed', 'Y');
        $this->db->where('project_id', $project_id);
        $this->db->where('team_id', $team_id);
        $this->db->update('projects');
        return $this->db->affected_rows();
    }

    public function get($project_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('team_id', $team_id);
        $this->db->where('project_id', $project_id);
        $this->db->from('projects');
        $project = $this->db->get()->first_row();
        return $project;
    }

    public function get_all($team_id, $active = false)
    {
        $this->db->where('team_id', $team_id);
        if($active) {
            $this->db->where('removed', 'N');
        }
        $this->db->from('projects');
        $projects = $this->db->get()->result();
        return $projects;
    }

    public function get_all_with_ticket_count($team_id, $active = false)
    {
        $this->db->select('projects.*, COUNT(*) as tickets, complete.count as complete');
        $this->db->where('projects.team_id', $team_id);
        if($active) {
            $this->db->where('removed', 'N');
        }
        $this->db->from("projects");
        $this->db->join("(SELECT * FROM tickets WHERE status_id != 6) tickets", "tickets.project_id = projects.project_id AND tickets.team_id = projects.team_id", "left");
        $this->db->join("(SELECT project_id, team_id, COUNT(*) AS count FROM tickets WHERE status_id = 5 AND team_id = $team_id GROUP BY project_id) complete", "complete.project_id = projects.project_id AND complete.team_id = projects.team_id", 'left');
        $this->db->group_by('project_id');
        $projects = $this->db->get()->result();
        return $projects;
    }


    public function get_label($project_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('project_id', $project_id);
        $this->db->where('team_id', $team_id);
        $this->db->from('projects');
        $project = $this->db->get()->first_row();
        return $project->label ?? null;
    }
}
