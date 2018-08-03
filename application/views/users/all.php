<?php $this->load->view('header') ?>
<h1>Users</h1>
<br>
<a href="<?php echo base_url('user/new') ?>" class="btn btn-primary">New User</a>
<table class="table table-hover table-vcenter mt-3">
    <thead>
    <tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Created</th>
        <th>Last Login</th>
        <th></th>
    </tr>
    </thead>
    <tbody class="sortable">
        <?php foreach($users as $user): ?>
            <tr>
                <td><a href="<?php echo base_url("user/edit/{$user->user_id}") ?>" class="text-inherit"><?php echo $user->first_name ?></a></td>
                <td><?php echo $user->last_name ?></td>
                <td><?php echo $user->email ?></td>
                <td><?php echo date('F d, Y', strtotime($user->created_at)) ?></td>
                <td><?php echo date('F d, Y g:i A', strtotime($user->created_at)) ?></td>
                <td><a href="<?php echo base_url("ticket/user/{$user->user_id}") ?>" class="btn btn-sm btn-secondary">View Tickets</a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php $this->load->view('footer') ?>
