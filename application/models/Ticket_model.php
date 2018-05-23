<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_model extends CI_Model {

    private $fields = array(
        'title',
        'description',
        'user_id',
        'status_id',
        'worker_id',
        'created_at',
        'updated_at'
    );

    public function create($title, $description) {
        $data = array(
            'ticket_id' => $this->get_next_ticket_id($this->user->group_id),
            'title' => $title,
            'description' => $description,
            'status_id' => 1,
            'user_id' => $this->user->user_id,
            'group_id' => $this->user->group_id,
        );
        $this->db->insert('tickets', $data);
        return $this->db->insert_id();
    }

    public function update($ticket_id, $group_id, $data)
    {
        $revision = (array) $this->get($ticket_id, $group_id);

        if($data['status_id'] == 4) {
            $data['worker_id'] = $this->user->user_id;
        }

        $this->db->set($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->where('group_id', $group_id);
        $this->db->update('tickets');
        if($this->db->affected_rows()) {
            $revision['updated_by'] = $this->user->user_id;
            unset($revision['id']);
            $this->db->insert('revisions', $revision);
            return $this->db->insert_id();
        }
        return null;
    }

    public function get($ticket_id, $group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->from('tickets');
        $ticket = $this->db->get()->first_row();
        return $ticket;
    }

    public function get_all($group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->from('tickets');
        $tickets = $this->db->get()->result();
        return $tickets;
    }

    public function query($group_id, $query)
    {
        $this->db->where('group_id', $group_id);
        foreach ($this->fields as $field) {
            if(!empty($query[$field])) {
                $this->db->where($field, $query[$field]);
            }
        }
        $this->db->from('tickets');
        $tickets = $this->db->get()->result();
        return $tickets;
    }

    public function get_revisions($ticket_id, $group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->from('revisions');
        $revisions = $this->db->get()->result();
        return $revisions;
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
