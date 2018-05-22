<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_model extends CI_Model {

    public function create($title, $description) {
        $data = array(
            'ticket_id' => $this->get_next_ticket_id($this->user->group_id),
            'title' => $title,
            'description' => $description,
            'user_id' => $this->user->user_id,
            'group_id' => $this->user->group_id,
        );
        $this->db->insert('tickets', $data);
        return $this->db->insert_id();
    }

    public function get($group_id, $ticket_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->from('tickets');
        $ticket = $this->db->get()->first_row();
        return $ticket;
    }

    public function get_by_unique_id($id) {
        $this->db->where('id', $id);
        $this->db->from('tickets');
        $ticket = $this->db->get()->first_row();
        if($ticket) {
            return $ticket;
        }
        return null;
    }

    private function get_next_ticket_id($group_id)
    {
        $this->db->select('id');
        $this->db->where('group_id', $group_id);
        $this->db->from('tickets');
        return $this->db->get()->num_rows() + 1;
    }
}
