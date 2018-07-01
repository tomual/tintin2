<table class="table table-hover mt-2">
    <thead>
    <tr>
        <th>Ticket</th>
        <th class="text-center">Status</th>
        <th>Project</th>
        <th>Created</th>
        <th>Modified</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($tickets as $ticket): ?>
        <tr class="<?php echo is_terminal($ticket->status_id) ? 'tr-terminal' : '' ?>">
            <td><a href="<?php echo base_url("ticket/view/{$ticket->ticket_id}") ?>"><?php echo $ticket->title ?></a></td>
            <td class="text-center"><a href="<?php echo base_url("ticket/status/{$ticket->status_id}") ?>"><?php echo get_status_label_html($ticket->status_id) ?></a></td>
            <td><a href="<?php echo base_url("ticket/project/{$ticket->project_id}") ?>" class="text-inherit"><?php echo get_project_label($ticket->project_id) ?? '-' ?></a></td>
            <td><?php echo date('M j, Y', strtotime($ticket->created_at)) ?></td>
            <td><?php echo date('M j, Y', strtotime($ticket->updated_at)) ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>