<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

    public function create($label, $color, $complete, $cancel) {
        $data = array(
            'status_id' => $this->get_next_status_id($this->user->team_id),
            'team_id' => $this->user->team_id,
            'label' => $label,
            'color' => $color,
            'complete' => $complete,
            'cancel' => $cancel,
            'created_by' => $this->user->user_id
        );
        $this->db->insert('statuses', $data);
        return $this->db->insert_id();
    }

    public function update($status_id, $team_id, $data)
    {
        $this->db->set($data);
        $this->db->where('status_id', $status_id);
        $this->db->where('team_id', $team_id);
        $this->db->update('statuses');
        return $this->db->affected_rows();
    }

    public function delete($status_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->set('removed', 'Y');
        $this->db->where('status_id', $status_id);
        $this->db->where('team_id', $team_id);
        $this->db->update('statuses');
        return $this->db->affected_rows();
    }

    public function get($status_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('team_id', $team_id);
        $this->db->where('status_id', $status_id);
        $this->db->from('statuses');
        $status = $this->db->get()->first_row();
        return $status;
    }

    public function get_by_unique_id($id) {
        $this->db->where('id', $id);
        $this->db->from('statuses');
        $status = $this->db->get()->first_row();
        if($status) {
            return $status;
        }
        return null;
    }

    public function get_all($team_id, $active = false)
    {
        $this->db->where('team_id', $team_id);
        if($active) {
            $this->db->where('removed', 'N');
        }
        $this->db->from('statuses');
        $this->db->order_by('order', 'asc');
        $statuses = $this->db->get()->result();
        return $statuses;
    }

    public function get_label($status_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('status_id', $status_id);
        $this->db->where('team_id', $team_id);
        $this->db->from('statuses');
        $status = $this->db->get()->first_row();
        return $status->label ?? null;
    }

    private function get_next_status_id($team_id)
    {
        $this->db->select('id');
        $this->db->where('team_id', $team_id);
        $this->db->from('statuses');
        return $this->db->get()->num_rows() + 1;
    }

    public function set_order($data, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $affected_rows = 0;
        foreach ($data as $index => $status_id) {
            if($status_id) {
                $this->db->set('order', $index);
                $this->db->where('status_id', $status_id);
                $this->db->where('team_id', $team_id);
                $this->db->update('statuses');
                $affected_rows += $this->db->affected_rows();
            }
        }
        return $affected_rows;
    }

}
