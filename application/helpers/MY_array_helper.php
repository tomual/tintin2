<?php
defined('BASEPATH') OR exit('No direct script access allowed');
function find_key_get_value($needle_key, $haystack, $find_value, $return_key)
{
    foreach ($haystack as $index => $element) {
        if ($element->{$needle_key} == $find_value) {
            return $haystack[$index]->{$return_key};
        }
    }
    return null;
}

function get_status_label($status_id)
{
    $CI =& get_instance();
    if (!$status_id) {
        return null;
    }
    foreach ($CI->statuses as $status) {
        if ($status->status_id == $status_id) {
            return $status->label;
        }
    }
    return 'Unknown';
}

function get_status_label_html($status_id)
{
    $CI =& get_instance();
    if (!$status_id) {
        return null;
    }
    foreach ($CI->statuses as $status) {
        if ($status->status_id == $status_id) {
            $html = '<span class="badge bg-' . $status->color . '">' . $status->label . '</span>';
            return $html;
        }
    }
    return 'Unknown';
}

function get_project_label($project_id)
{
    $CI =& get_instance();
    if (!$project_id) {
        return null;
    }
    foreach ($CI->projects as $project) {
        if ($project->project_id == $project_id) {
            return $project->label;
        }
    }
    return 'Unknown';
}

function get_group_label($groups, $group_id)
{
    if (!$group_id) {
        return null;
    }
    foreach ($groups as $group) {
        if ($group->group_id == $group_id) {
            return $group->label;
        }
    }
    return 'Unknown';
}

function get_permission_label($permission, $level)
{
    $levels_default = array(
        '0' => 'None',
        '1' => 'View', 
        '2' => 'Create',
        '3' => 'Edit' 
    );

    $levels_ticket = array(
        '0' => 'Comment',
        '1' => 'View', 
        '2' => 'Create',
        '3' => 'Edit' 
    );

    if ($permission == 'ticket') {
        return $levels_ticket[$level] ?? '-';
    }
    return $levels_default[$level] ?? '-';
}

function get_user_first_name($user_id)
{
    $CI =& get_instance();
    if (!$user_id) {
        return null;
    }
    foreach ($CI->users as $user) {
        if ($user->user_id == $user_id) {
            return $user->first_name;
        }
    }
    return 'Unknown';
}