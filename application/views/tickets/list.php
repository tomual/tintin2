<?php $this->load->view('header') ?>
<h1>Tickets List</h1>
<div class="filter">
    <form>
        <label for="status">Status</label>
        <select name="status_id" id="status_id">
            <option value="">None</option>
            <?php foreach ($this->statuses as $status): ?>
                <option value="<?php echo $status->status_id ?>"><?php echo $status->label ?></option>
            <?php endforeach ?>
        </select>
        <label for="status">Project</label>
        <select name="project_id" id="project_id">
            <option value="">None</option>
            <?php foreach ($this->projects as $project): ?>
                <option value="<?php echo $project->project_id ?>"><?php echo $project->label ?></option>
            <?php endforeach ?>
        </select>
        <input type="submit" value="Filter">
    </form>
</div>
<table border="1">
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
            <td><?php echo $ticket->created_at ?></td>
            <td><?php echo $ticket->updated_at ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php $this->load->view('footer') ?>
