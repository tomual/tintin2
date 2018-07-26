<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {

    public function create($label, $color, $complete, $cancel) {
        $data = array(
            'status_id' => $this->get_next_status_id($this->user->group_id),
            'group_id' => $this->user->group_id,
            'label' => $label,
            'color' => $color,
            'complete' => $complete,
            'cancel' => $cancel,
            'created_by' => $this->user->user_id
        );
        $this->db->insert('statuses', $data);
        return $this->db->insert_id();
    }

    public function update($status_id, $group_id, $data)
    {
        $this->db->set($data);
        $this->db->where('status_id', $status_id);
        $this->db->where('group_id', $group_id);
        $this->db->update('statuses');
        return $this->db->affected_rows();
    }

    public function delete($status_id, $group_id = null)
    {
        if(!$group_id) {
            $group_id = $this->user->group_id;
        }
        $this->db->set('removed', 'Y');
        $this->db->where('status_id', $status_id);
        $this->db->where('group_id', $group_id);
        $this->db->update('statuses');
        return $this->db->affected_rows();
    }

    public function get($status_id, $group_id = null)
    {
        if(!$group_id) {
            $group_id = $this->user->group_id;
        }
        $this->db->where('group_id', $group_id);
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

    public function get_all($group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->from('statuses');
        $this->db->order_by('id', 'asc');
        $statuses = $this->db->get()->result();
        return $statuses;
    }

    public function get_label($status_id, $group_id = null)
    {
        if(!$group_id) {
            $group_id = $this->user->group_id;
        }
        $this->db->where('status_id', $status_id);
        $this->db->where('group_id', $group_id);
        $this->db->from('statuses');
        $status = $this->db->get()->first_row();
        return $status->label ?? null;
    }

    private function get_next_status_id($group_id)
    {
        $this->db->select('id');
        $this->db->where('group_id', $group_id);
        $this->db->from('statuses');
        return $this->db->get()->num_rows() + 1;
    }

}
