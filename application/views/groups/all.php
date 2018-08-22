<?php $this->load->view('header') ?>
<h1>Groups</h1>
<?php echo alerts() ?>
<br>
<a href="<?php echo base_url('group/new') ?>" class="btn btn-primary">New Group</a>
<table class="table table-hover table-vcenter mt-3">
    <thead>
    <tr>
        <th>Group</th>
        <th>Tickets</th>
        <th>Projects</th>
        <th>Users</th>
        <th>Settings</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <?php foreach($groups as $group): ?>
            <tr>
                <td><a href="<?php echo base_url("group/edit/{$group->group_id}") ?>" class="text-inherit"><?php echo $group->label ?></a></td>
                <td><small><?php echo get_permission_label('ticket', $group->ticket)?></small></td>
                <td><small><?php echo get_permission_label('project', $group->project)?></small></td>
                <td><small><?php echo get_permission_label('user', $group->user)?></small></td>
                <td><small><?php echo get_permission_label('settings', $group->settings)?></small></td>
                <td><a href="<?php echo base_url("group/users/{$group->group_id}") ?>" class="btn btn-sm btn-secondary">View Users</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php $this->load->view('footer') ?>
