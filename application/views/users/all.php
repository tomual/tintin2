<?php $this->load->view('header') ?>
<h1>Users</h1>
<br>
<a href="<?php echo base_url('user/new') ?>" class="btn btn-primary">New User</a>
<table class="table table-hover table-vcenter mt-3">
    <thead>
    <tr>
        <th>Email</th>
        <th></th>
    </tr>
    </thead>
    <tbody class="sortable">
    </tbody>
</table>
<?php $this->load->view('footer') ?>
