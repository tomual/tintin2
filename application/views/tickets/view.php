<?php $this->load->view('header') ?>
<div class="ticket">
    <h1><?php echo $ticket->title ?></h1>
    <br>
    <?php echo $ticket->description ?>
    <h2>Details</h2>
    <table>
        <tr>
            <th>Author</th>
            <td><?php echo $ticket->user_id ?></td>
        </tr>
        <tr>
            <th>Created at</th>
            <td><?php echo $ticket->created_at ?></td>
        </tr>
        <tr>
            <th>Project</th>
            <td>tintin2</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>Working</td>
        </tr>
        <tr>
            <td></td>
            <td>
                <a href="<?php echo base_url("ticket/edit/{$ticket->ticket_id}") ?>"><button>Edit Ticket</button></a>
            </td>
        </tr>
    </table>

    <h2>Quick Update</h2>
    <form method="post">
        <table>
            <tr>
                <td><label for="">Status</label></td>
                <td>
                    <select name="status" id="status">
                        <option value="1">Working</option>
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
        <?php $cursor = $ticket ?>
        <?php foreach ($revisions as $revision): ?>
            <li>
                <div><?php echo $revision->updated_by ?> at <?php echo $revision->updated_at ?></div>
                <?php unset($revision->updated_by) ?>
                <?php unset($revision->updated_at) ?>
                <?php unset($revision->id) ?>
                <?php foreach ($revision as $key => $value): ?>
                    <?php if ($revision->{$key} != $cursor->{$key}): ?>
                        <?php if ($key != 'description'): ?>
                        <?php echo ucfirst($key) ?> changed from <?php echo $revision->{$key} ?> to <?php echo $cursor->{$key} ?><br>
                        <?php else: ?>
                            Description changed<br>
                        <?php endif ?>
                    <?php endif ?>
                <?php endforeach ?>
            </li>
            <?php $cursor = $revision ?>
        <?php endforeach ?>
    </ul>
</div>
<?php $this->load->view('footer') ?>
