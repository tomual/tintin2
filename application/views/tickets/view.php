<?php $this->load->view('header') ?>
<div class="ticket">
    <h1 class="d-inline"><small class="text-muted">#<?php echo $ticket->ticket_id ?></small> <?php echo $ticket->title ?></h1>
    <a href="<?php echo base_url("ticket/edit/{$ticket->ticket_id}") ?>" class="btn btn-sm btn-secondary ml-3 align-super">Edit Ticket</a>
    <table class="table mt-5 w-25">
        <tr>
            <th width="120">Author</th>
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
        <!--
        <tr>
            <th>Worker</th>
            <td><?php echo get_user_first_name($ticket->worker_id) ?? '-' ?></td>
        </tr>
        -->
    </table>
    <div class="description p-5"><?php echo $ticket->description ?></div>

    <hr>
    <style>
    </style>
    <h3>Quick Update</h3>
    <form method="post" action="<?php echo base_url("ticket/quick/{$ticket->ticket_id}") ?>">
        <div class="form-group">
            <label class="form-label" for="">Status</label>
            <div class="selectgroup w-100">
                <?php foreach ($this->statuses as $status): ?>
                    <label class="selectgroup-item">
                        <input name="status_id" value="<?php echo $status->status_id ?>" <?php echo $ticket->status_id == $status->status_id ? 'checked' : '' ?> class="selectgroup-input" type="radio">
                        <span class="selectgroup-button"><?php echo $status->label ?></span>
                    </label>
                <?php endforeach ?>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label" for="comment">Comment</label>
            <textarea class="ckeditor ckeditor-small form-control" name="comment" id="comment"></textarea>
        </div>
        <input type="submit" value="Update" class="btn btn-primary mt-1">
    </form>    <hr>

    <h3 class="mt-3">Revisions</h3>
    <?php if(!$revisions): ?>
    <p class="text-muted">No changes have been made to this ticket.</p>
    <?php endif ?>
    <?php
    $cursor = $ticket;
    $ignore = array('id', 'comment', 'updated_at', 'updated_by');
    foreach ($revisions as $revision) {
        echo "<div class=\"card card-revision\">
        <div class=\"card-body\">
            <small class=\"float-right text-muted\">" . date('M j, Y g:ia', strtotime($revision->updated_at)) . "</small>
            <b class=\"m-0\">" . get_user_first_name($revision->updated_by) . "</b>";
        foreach ($revision as $key => $value) {
            if (!in_array($key, $ignore) && $revision->{$key} != $cursor->{$key}) {
                switch ($key) {
                    case 'description':
                        echo " changed description";
                        break;
                    case 'project_id':
                        $before = $this->project_model->get_label($revision->{$key}) ?? 'None';
                        $after = $this->project_model->get_label($cursor->{$key});
                        echo "<p class=\"text-muted mb-0\">Project changed from <b>$before</b> to <b>$after</b></p>";
                        break;
                    case 'status_id':
                        $before = get_status_label($revision->{$key}) ?? 'None';
                        $after = get_status_label($cursor->{$key});
                        echo "<p class=\"text-muted mb-0\">Status changed from <b>$before</b> to <b>$after</b></p>";
                        break;
                    case 'worker_id':
                        break;
                        $before = get_user_first_name($revision->{$key}) ?? 'Nobody';
                        $after = get_user_first_name($cursor->{$key});
                        echo "<p class=\"text-muted mb-0\">Worker changed from <b>$before</b> to <b>$after</b></p>";
                    default:
                        echo "<p class=\"text-muted mb-0\">" . ucfirst($key) . " changed from <b>{$revision->{$key}}</b> to <b>{$cursor->{$key}}</b></p>";
                        break;
                }
            }
        }
        if(!empty($revision->comment)) {
            echo "<blockquote class='py-5 mt-3'>" . $revision->comment . "</blockquote>";
        }
        $cursor = $revision;
        echo "
        </div>
    </div>";
    }
    ?>
</div>
<?php $this->load->view('footer') ?>
