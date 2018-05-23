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
                'label' => 'Backlog'
            ),
            array(
                'status_id' => 2,
                'group_id' => $group_id,
                'label' => 'Input'
            ),
            array(
                'status_id' => 3,
                'group_id' => $group_id,
                'label' => 'On Hold'
            ),
            array(
                'status_id' => 4,
                'group_id' => $group_id,
                'label' => 'Working'
            ),
            array(
                'status_id' => 5,
                'group_id' => $group_id,
                'label' => 'Complete'
            ),
            array(
                'status_id' => 6,
                'group_id' => $group_id,
                'label' => 'Cancelled'
            ),
        );

        foreach ($statuses as $status) {
            $this->db->insert('statuses', $status);
        }

        return $group_id;
    }
}
