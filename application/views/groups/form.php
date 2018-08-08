<form method="post">
    <div class="form-group">
        <label class="form-label" for="label">Label</label>
        <input type="text" class="form-control <?php if(form_error('label')) echo 'is-invalid' ?>" name="label" id="label" value="<?php echo set_value('label', null) ?? $group->label ?? null ?>">
        <?php echo form_error('label') ?>
    </div>

    <hr>

    <h3>Permissions</h3>

    <div class="form-group">
        <label class="form-label" for="ticket">Ticket</label>
        <select class="form-control" name="ticket">
            <option value="none">View tickets</option>
            <option value="comment">Comment on tickets</option>
            <option value="create">Create tickets & edit own</option>
            <option value="edit">Edit tickets</option>
        </select>
        <?php echo form_error('ticket') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="project">Project</label>
        <select class="form-control" name="project">
            <option value="none">View projects</option>
            <option value="create">Create projects & edit own</option>
            <option value="edit">Edit projects</option>
        </select>
        <?php echo form_error('project') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="user">User</label>
        <select class="form-control" name="user">
            <option value="none">View users</option>
            <option value="edit">Edit tickets</option>
        </select>
        <?php echo form_error('user') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="settings">Settings</label>
        <select class="form-control" name="settings">
            <option value="none">None</option>
            <option value="view">View</option>
            <option value="edit">Edit</option>
        </select>
        <?php echo form_error('settings') ?>
        <div class="small text-muted">Groups, statuses</div>
    </div>


    <?php if ($this->router->fetch_method() != 'new'): ?>
        <input type="submit" value="Update" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
    <?php else: ?>
        <input type="submit" value="Create" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
    <?php endif ?>
</form>

<?php if ($this->router->fetch_method() != 'new'): ?>
    <form action="<?php echo base_url("group/delete/{$group->group_id}") ?>" method="post">
        <input type="submit" value="Delete Group" onclick="return confirm('Delete this group?')" class="btn btn-link mt-3">
    </form>
<?php endif ?>