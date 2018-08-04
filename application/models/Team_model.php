<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model {

    public function create($owner_id, $name) {
        $data = array(
            'owner_id' => $owner_id,
            'name' => $name
        );
        $this->db->insert('teams', $data);

        $team_id = $this->db->insert_id();

        $statuses = array(
            array(
                'status_id' => 1,
                'team_id' => $team_id,
                'label' => 'Backlog',
                'color' => 'purple'
            ),
            array(
                'status_id' => 2,
                'team_id' => $team_id,
                'label' => 'Input',
                'color' => 'blue'
            ),
            array(
                'status_id' => 3,
                'team_id' => $team_id,
                'label' => 'On Hold',
                'color' => 'azure'
            ),
            array(
                'status_id' => 4,
                'team_id' => $team_id,
                'label' => 'Working',
                'color' => 'lime'
            ),
            array(
                'status_id' => 5,
                'team_id' => $team_id,
                'label' => 'Complete',
                'color' => 'cyan'
            ),
            array(
                'status_id' => 6,
                'team_id' => $team_id,
                'label' => 'Cancelled',
                'color' => 'orange'
            ),
        );

        foreach ($statuses as $status) {
            $this->db->insert('statuses', $status);
        }

        return $team_id;
    }
}
