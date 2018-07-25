<?php $this->load->view('header') ?>
<h1>Statuses</h1>
<br>
<a href="<?php echo base_url('status/new') ?>" class="btn btn-primary">New status</a>
<table class="table table-hover table-vcenter mt-3">
    <thead>
    <tr>
        <th>Status</th>
        <th>Color</th>
        <th>Completed</th>
        <th>Cancelled</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($statuses as $status): ?>
        <tr>
            <td><?php echo $status->label ?></td>
            <td><?php echo $status->color ?></td>
            <td><?php echo $status->completed ?></td>
            <td><?php echo $status->cancelled ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php $this->load->view('footer') ?>
