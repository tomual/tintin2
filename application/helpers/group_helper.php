<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function has_permission($level, $permission)
{
    $CI =& get_instance();

    if (!$status_id) {
        return null;
    }
    
    foreach ($CI->statuses as $status) {
        if ($status->status_id == $status_id) {
            return $status->cancel == 'Y';
        }
    }
    return false;
}