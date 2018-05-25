<table border="1" class="mt-2">
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
    <?php foreach ($tickets as $ticket): ?>
        <tr>
            <td><a href="<?php echo base_url("ticket/view/{$ticket->ticket_id}") ?>"><?php echo $ticket->title ?></a></td>
            <td><?php echo get_status_label($ticket->status_id) ?></td>
            <td><?php echo get_project_label($ticket->project_id) ?? '-' ?></td>
            <td><?php echo date('M j, Y', strtotime($ticket->created_at)) ?></td>
            <td><?php echo date('M j, Y', strtotime($ticket->updated_at)) ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>