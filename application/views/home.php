<?php $this->load->view('header') ?>
<h1>Welcome back, <?php echo $this->user->first_name ?></h1>
<p>Tintin is an open source ticketing system - last updated June 9th, 2018.</p>
<?php if($summary): ?>
<h3 class="mt-7">Tickets Summary</h3>
<div class="row row-cards">
    <?php foreach ($summary as $count): ?>
        <div class="summary">
            <div class="card pt-3">
                <div class="card-body p-3 text-center">
                    <div class="h1 m-0"><a href="<?php echo base_url("ticket/status/{$count->status_id}") ?>" class="text-inherit"><?php echo $count->count ?></a></div>
                    <div class="text-muted mb-4"><a href="<?php echo base_url("ticket/status/{$count->status_id}") ?>" class="text-inherit"><?php echo get_status_label($count->status_id) ?></a></div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>
<h3 class="mt-5">Newest Tickets</h3>
<table class="table table-hover mt-6">
    <thead>
    <tr>
        <th>Ticket</th>
        <th>Status</th>
        <th>Project</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($new as $ticket): ?>
        <tr>
            <td><a href="<?php echo base_url("ticket/view/{$ticket->ticket_id}") ?>"><?php echo $ticket->title ?></a></td>
            <td><?php echo get_status_label_html($ticket->status_id) ?></td>
            <td><?php echo get_project_label($ticket->project_id) ?? '-' ?></td>
            <td><?php echo date('M j, Y', strtotime($ticket->created_at)) ?></td>
            <td><?php echo date('M j, Y', strtotime($ticket->updated_at)) ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php else: ?>
    <a href="<?php echo base_url('ticket/new') ?>" class="btn btn-primary mt-4">Create your first ticket</a>
<?php endif ?>
<?php $this->load->view('footer') ?>
