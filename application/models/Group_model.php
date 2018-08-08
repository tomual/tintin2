<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model {

    public function create($label, $ticket, $project, $user, $settings) {
        $data = array(
            'group_id' => $this->get_next_group_id($this->user->team_id),
            'team_id' => $this->user->team_id,
            'label' => $label,
            'ticket' => $ticket,
            'project' => $project,
            'user' => $user,
            'settings' => $settings,
            'created_by' => $this->user->user_id
        );
        $this->db->insert('groups', $data);
        return $this->db->insert_id();
    }

    private function get_next_group_id($team_id)
    {
        $this->db->select('id');
        $this->db->where('team_id', $team_id);
        $this->db->from('groups');
        return $this->db->get()->num_rows() + 1;
    }

    public function get_by_unique_id($id) {
        $this->db->where('id', $id);
        $this->db->from('groups');
        $ticket = $this->db->get()->first_row();
        if($ticket) {
            return $ticket;
        }
        return null;
    }

    public function update($group_id, $team_id, $data)
    {
        $this->db->set($data);
        $this->db->where('group_id', $group_id);
        $this->db->where('team_id', $team_id);
        $this->db->update('groups');
        return $this->db->affected_rows();
    }

    public function delete($group_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->set('removed', 'Y');
        $this->db->where('group_id', $group_id);
        $this->db->where('team_id', $team_id);
        $this->db->update('groups');
        return $this->db->affected_rows();
    }

    public function get($group_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('team_id', $team_id);
        $this->db->where('group_id', $group_id);
        $this->db->from('groups');
        $group = $this->db->get()->first_row();
        return $group;
    }

    public function get_all($team_id, $active = false)
    {
        $this->db->where('team_id', $team_id);
        if($active) {
            $this->db->where('removed', 'N');
        }
        $this->db->from('groups');
        $groups = $this->db->get()->result();
        return $groups;
    }


    public function get_label($group_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('group_id', $group_id);
        $this->db->where('team_id', $team_id);
        $this->db->from('groups');
        $group = $this->db->get()->first_row();
        return $group->label ?? null;
    }
}
