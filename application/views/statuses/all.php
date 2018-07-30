<?php $this->load->view('header') ?>
<h1>Statuses</h1>
<br>
<a href="<?php echo base_url('status/new') ?>" class="btn btn-primary">New Status</a>
<table class="table table-hover table-vcenter mt-3">
    <thead>
    <tr>
        <th>Status</th>
        <th>Color</th>
        <th class="text-center">Completed</th>
        <th class="text-center">Cancelled</th>
        <th></th>
    </tr>
    </thead>
    <tbody class="sortable">
    <?php foreach ($statuses as $status): ?>
        <tr data-id="<?php echo $status->status_id ?>" class="status-row">
            <td><a href="<?php echo base_url("status/edit/{$status->status_id}") ?>" class="text-inherit"><?php echo $status->label ?></a></td>
            <td><span class="status-icon bg-<?php echo $status->color ?>"></span><?php echo ucfirst($status->color) ?></td>
            <td class="text-center"><?php echo $status->complete == 'Y' ? '<i class="fe fe-check"></i>' : '' ?></td>
            <td class="text-center"><?php echo $status->cancel == 'Y' ? '<i class="fe fe-check"></i>' : '' ?></td>
            <td><a href="<?php echo base_url("ticket/status/{$status->status_id}") ?>" class="btn btn-sm btn-secondary">View Tickets</a></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php $this->load->view('footer') ?>
