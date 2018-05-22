<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group_model extends CI_Model {

    public function create($owner_id, $name) {
        $data = array(
            'owner_id' => $owner_id,
            'name' => $name
        );
        $this->db->insert('groups', $data);
        return $this->db->insert_id();
    }
}
