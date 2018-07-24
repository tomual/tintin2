<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model {

    public function create($owner_id, $name) {
        $data = array(
            'owner_id' => $owner_id,
            'name' => $name
        );
        $this->db->insert('groups', $data);

        $group_id = $this->db->insert_id();

        $statuses = array(
            array(
                'status_id' => 1,
                'group_id' => $group_id,
                'label' => 'Backlog',
                'color' => 'purple'
            ),
            array(
                'status_id' => 2,
                'group_id' => $group_id,
                'label' => 'Input',
                'color' => 'blue'
            ),
            array(
                'status_id' => 3,
                'group_id' => $group_id,
                'label' => 'On Hold',
                'color' => 'azure'
            ),
            array(
                'status_id' => 4,
                'group_id' => $group_id,
                'label' => 'Working',
                'color' => 'lime'
            ),
            array(
                'status_id' => 5,
                'group_id' => $group_id,
                'label' => 'Complete',
                'color' => 'cyan'
            ),
            array(
                'status_id' => 6,
                'group_id' => $group_id,
                'label' => 'Cancelled',
                'color' => 'orange'
            ),
        );

        foreach ($statuses as $status) {
            $this->db->insert('statuses', $status);
        }

        return $group_id;
    }
}
