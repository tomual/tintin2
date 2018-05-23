<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

    public function get($status_id, $group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->where('status_id', $status_id);
        $this->db->from('statuses');
        $status = $this->db->get()->first_row();
        return $status;
    }

    public function get_all($group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->from('statuses');
        $statuses = $this->db->get()->result();
        return $statuses;
    }

}
