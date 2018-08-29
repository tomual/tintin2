<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Settings_model extends CI_Model
{

    public function get($team_id = null)
    {
        if (!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('team_id', $team_id);
        $this->db->from('settings');
        $group = $this->db->get()->first_row();
        return $group;
    }

    public function update($team_id, $status_start)
    {
        $data = array(
            'status_start' => $status_start,
        );
        $this->db->set($data);
        $this->db->where('team_id', $team_id);
        $this->db->update('settings');
        return $this->db->affected_rows();
    }
}
