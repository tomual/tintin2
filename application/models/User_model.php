<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function create($data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $this->db->insert('users', $data);
        return $this->db->insert_id();
    }

    public function update($user) {
        $this->db->set('team_id', $user->team_id);
        $this->db->set('group_id', $user->group_id);
        $this->db->set('email', $user->email);
        $this->db->set('password', $user->password);
        $this->db->set('first_name', $user->first_name);
        $this->db->set('last_name', $user->last_name);
        $this->db->where('id', $user->id);
        $this->db->update('users');
        return $this->db->affected_rows();
    }

    public function log_in($email, $password) {
        $this->db->where('email', $email);
        $this->db->from('users');
        $user = $this->db->get()->first_row();
        if($user) {
            if(password_verify($password, $user->password)) {
                return $user;
            }
        }
        return null;
    }

    public function get_first_name($user_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('user_id', $user_id);
        $this->db->where('team_id', $team_id);
        $this->db->from('users');
        $user = $this->db->get()->first_row();
        return $user->first_name ?? null;
    }

    public function get_all($team_id)
    {
        $this->db->where('team_id', $team_id);
        $this->db->from('users');
        $users = $this->db->get()->result();
        return $users;
    }

    public function get($user_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('team_id', $team_id);
        $this->db->where('user_id', $user_id);
        $this->db->from('users');
        $project = $this->db->get()->first_row();
        return $project;
    }

    public function get_by_group_id($group_id, $team_id = null)
    {
        if(!$team_id) {
            $team_id = $this->user->team_id;
        }
        $this->db->where('team_id', $team_id);
        $this->db->where('group_id', $group_id);
        $this->db->from('users');
        $users = $this->db->get()->result();

        return $users;
    }
}
