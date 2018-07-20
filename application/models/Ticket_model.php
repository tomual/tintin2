<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ticket_model extends CI_Model {

    private $fields = array(
        'title',
        'description',
        'user_id',
        'status_id',
        'project_id',
        'worker_id',
        'created_at',
        'updated_at'
    );

    public function create($title, $description, $project_id) 
    {
        $data = array(
            'ticket_id' => $this->get_next_ticket_id($this->user->group_id),
            'title' => $title,
            'description' => $description,
            'status_id' => 1,
            'project_id' => $project_id,
            'user_id' => $this->user->user_id,
            'group_id' => $this->user->group_id,
        );
        $this->db->insert('tickets', $data);
        return $this->db->insert_id();
    }

    public function update($ticket_id, $group_id, $data)
    {
        $revision = (array) $this->get($ticket_id, $group_id);

        if($data['status_id'] == 5 && $revision['status_id'] != 4) {
            $data['status_id'] = 4;
            $this->ticket_model->update($ticket_id, $this->user->group_id, $data);
            $data['status_id'] = 5;
        }

        if($data['status_id'] == 4) {
            $data['worker_id'] = $this->user->user_id;
        } elseif($data['status_id'] != 5) {
            $data['worker_id'] = null;
        }

        if($data['status_id'] == 5 && $revision['status_id'] != 4) {
            $this->ticket_model->update($ticket_id, $this->user->group_id, $data);
        }

        $revision['comment'] = $data['comment'];
        unset($data['comment']);

        $this->db->set($data);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->where('group_id', $group_id);
        $this->db->update('tickets');
        if($this->db->affected_rows() || $revision['comment']) {
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
        $this->db->order_by('created_at', 'desc');
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
        if(!empty($query['keywords']))
        {
            $this->db->group_start();
            $this->db->like('title', $query['keywords']);
            $this->db->or_like('description', $query['keywords']);
            $this->db->group_end();
        }
        if(!empty($query['created_from']) && strtotime($query['created_from']))
        {
            $created_from = date('Y-m-d', strtotime($query['created_from']));
            if(strtotime($query['created_to'])) {
                $created_to = date('Y-m-d', strtotime($query['created_to']));
            } else {
                $created_to = date('Y-m-d', strtotime("+1 day", strtotime($query['created_from'])));
            }
            $this->db->where("created_at BETWEEN '$created_from' AND '$created_to'");
        }
        if(!empty($query['updated_from']) && strtotime($query['updated_from']))
        {
            $updated_from = date('Y-m-d', strtotime($query['updated_from']));
            if(strtotime($query['updated_to'])) {
                $updated_to = date('Y-m-d', strtotime($query['updated_to']));
            } else {
                $updated_to = date('Y-m-d', strtotime("+1 day", strtotime($query['updated_from'])));
            }
            $this->db->where("updated_at BETWEEN '$updated_from' AND '$updated_to'");
        }
        $this->db->from('tickets');
        $this->db->order_by('created_at', 'desc');
        $tickets = $this->db->get()->result();
        return $tickets;
    }

    public function get_revisions($ticket_id, $group_id)
    {
        $this->db->where('group_id', $group_id);
        $this->db->where('ticket_id', $ticket_id);
        $this->db->from('revisions');
        $this->db->order_by('updated_at', 'desc');
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

    public function get_updated($limit, $group_id = null)
    {
        if(!$group_id) {
            $group_id = $this->user->group_id;
        }
        $this->db->where('group_id', $group_id);
        $this->db->from('tickets');
        $this->db->limit($limit);
        $this->db->order_by('updated_at', 'desc');
        $tickets = $this->db->get()->result();
        return $tickets;
    }

    public function get_new($limit, $group_id = null)
    {
        if(!$group_id) {
            $group_id = $this->user->group_id;
        }
        $this->db->where('group_id', $group_id);
        $this->db->from('tickets');
        $this->db->limit($limit);
        $this->db->order_by('created_at', 'desc');
        $tickets = $this->db->get()->result();
        return $tickets;
    }

    public function get_counts_by_status($group_id = null)
    {
        if(!$group_id) {
            $group_id = $this->user->group_id;
        }
        $this->db->select('status_id, COUNT(status_id) as count');
        $this->db->where('group_id', $group_id);
        $this->db->from('tickets');
        $this->db->group_by('status_id');
        $counts = $this->db->get()->result();
        return $counts;
    }
}
