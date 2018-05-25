<?php $this->load->view('header') ?>
<div class="ticket">
    <h1><?php echo $ticket->title ?></h1>
    <a href="<?php echo base_url("ticket/edit/{$ticket->ticket_id}") ?>" class="btn btn-link">Edit Ticket</a>
    <br>
    <?php echo $ticket->description ?>
    <h2>Details</h2>
    <table>
        <tr>
            <th>Author</th>
            <td><?php echo get_user_first_name($ticket->user_id) ?></td>
        </tr>
        <tr>
            <th>Created at</th>
            <td><?php echo date('M j, Y g:ia', strtotime($ticket->created_at)) ?></td>
        </tr>
        <tr>
            <th>Project</th>
            <td><?php echo get_project_label($ticket->project_id) ?? '-' ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php echo get_status_label($ticket->status_id) ?></td>
        </tr>
        <tr>
            <th>Worker</th>
            <td><?php echo get_user_first_name($ticket->worker_id) ?? '-' ?></td>
        </tr>
        <tr>
            <td></td>
            <td>
            </td>
        </tr>
    </table>
    <hr>
    <style>
    </style>
    <h2>Quick Update</h2>
    <form method="post" action="<?php echo base_url("ticket/quick/{$ticket->ticket_id}") ?>">
        <label for="">Status</label>
        <div class="selectgroup w-100">
            <?php foreach ($this->statuses as $status): ?>
                <label class="selectgroup-item">
                    <input name="status_id" value="<?php echo $status->status_id ?>" <?php echo $ticket->status_id == $status->status_id ? 'checked' : '' ?> class="selectgroup-input" type="radio">
                    <span class="selectgroup-button"><?php echo $status->label ?></span>
                </label>
            <?php endforeach ?>
        </div>

        <label for="comment">Comment</label>
        <textarea name="comment" id="comment" cols="30" rows="3"></textarea><br>
        <input type="submit" value="Update" class="btn btn-primary mt-1">
    </form>
    <h2 class="mt-3">Revisions</h2>
    <ul>
        <?php
        $cursor = $ticket;
        $ignore = array('id', 'comment', 'updated_at', 'updated_by');
        foreach ($revisions as $revision) {
            echo "<li>";
            echo get_user_first_name($revision->updated_by) . " at " . date('M j, Y g:ia', strtotime($revision->updated_at)) . "<br>";
            foreach ($revision as $key => $value) {
                if (!in_array($key, $ignore) && $revision->{$key} != $cursor->{$key}) {
                    switch ($key) {
                        case 'description':
                            echo "Description changed";
                            break;
                        case 'project_id':
                            $before = $this->project_model->get_label($revision->{$key}) ?? 'None';
                            $after = $this->project_model->get_label($cursor->{$key});
                            echo "Project changed from <b>$before</b> to <b>$after</b>";
                            break;
                        case 'status_id':
                            $before = get_status_label($revision->{$key}) ?? 'None';
                            $after = get_status_label($cursor->{$key});
                            echo "Status changed from <b>$before</b> to <b>$after</b>";
                            break;
                        case 'worker_id':
                            $before = get_user_first_name($revision->{$key}) ?? 'Nobody';
                            $after = get_user_first_name($cursor->{$key});
                            echo "Worker changed from <b>$before</b> to <b>$after</b>";
                            break;
                        default:
                            echo ucfirst($key) . " changed from {$revision->{$key}} to {$cursor->{$key}}<br>";
                            break;
                    }
                    echo "<br>";
                }
            }
            echo "<blockquote>" . $revision->comment . "</blockquote><br>";
            $cursor = $revision;
            echo "</li>";
        }
        ?>
    </ul>
</div>
<?php $this->load->view('footer') ?>
