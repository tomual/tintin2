<?php $this->load->view('header') ?>
<div class="ticket">
    <h1><?php echo $ticket->title ?></h1>
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
            <td><?php echo $ticket->created_at ?></td>
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
                <a href="<?php echo base_url("ticket/edit/{$ticket->ticket_id}") ?>">
                    <button>Edit Ticket</button>
                </a>
            </td>
        </tr>
    </table>

    <h2>Quick Update</h2>
    <form method="post">
        <table>
            <tr>
                <td><label for="">Status</label></td>
                <td>
                    <select name="status_id" id="status_id">
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?php echo $status->status_id ?>"><?php echo $status->label ?></option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="comment">Comment</label></td>
                <td><textarea name="comment" id="comment" cols="30" rows="3"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Update"></td>
            </tr>
        </table>
    </form>
    <h2>Revisions</h2>
    <ul>
        <li>
            <div>
                <?php
                $cursor = $ticket;
                $ignore = array('id', 'updated_at', 'updated_by');
                foreach ($revisions as $revision) {
                    echo get_user_first_name($revision->updated_by) . " at " . $revision->updated_at . "<br>";
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
                    $cursor = $revision;
                }
                ?>
            </div>
        </li>
    </ul>
</div>
<?php $this->load->view('footer') ?>
