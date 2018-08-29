<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Team_model extends CI_Model
{

    public function create($owner_id, $name)
    {
        $data = array(
            'owner_id' => $owner_id,
            'name' => $name,
        );
        $this->db->insert('teams', $data);

        $team_id = $this->db->insert_id();

        $statuses = array(
            array(
                'status_id' => 1,
                'team_id' => $team_id,
                'label' => 'Backlog',
                'color' => 'purple',
            ),
            array(
                'status_id' => 2,
                'team_id' => $team_id,
                'label' => 'Input',
                'color' => 'blue',
            ),
            array(
                'status_id' => 3,
                'team_id' => $team_id,
                'label' => 'On Hold',
                'color' => 'azure',
            ),
            array(
                'status_id' => 4,
                'team_id' => $team_id,
                'label' => 'Working',
                'color' => 'lime',
            ),
            array(
                'status_id' => 5,
                'team_id' => $team_id,
                'label' => 'Complete',
                'color' => 'cyan',
            ),
            array(
                'status_id' => 6,
                'team_id' => $team_id,
                'label' => 'Cancelled',
                'color' => 'orange',
            ),
        );

        foreach ($statuses as $status) {
            $this->db->insert('statuses', $status);
        }

        $groups = array(
            array(
                'group_id' => 1,
                'team_id' => $team_id,
                'label' => 'Admin',
                'ticket' => 3,
                'project' => 3,
                'settings' => 3,
                'removed' => 'N',
            ),
            array(
                'group_id' => 2,
                'team_id' => $team_id,
                'label' => 'User',
                'ticket' => 2,
                'project' => 1,
                'settings' => 1,
                'removed' => 'N',
            ),
        );

        foreach ($groups as $group) {
            $this->db->insert('groups', $group);
        }

        return $team_id;
    }

    public function get($team_id = null)
    {
        if (!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('id', $team_id);
        $this->db->from('teams');
        $group = $this->db->get()->first_row();
        return $group;
    }

    public function update($team_id, $name)
    {
        $data = array(
            'name' => $name,
        );
        $this->db->set($data);
        $this->db->where('id', $team_id);
        $this->db->update('teams');
        return $this->db->affected_rows();
    }
}
