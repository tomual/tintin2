<?php echo alerts() ?>
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
        <div class="selectgroup">
            <label class="selectgroup-item">
                <input name="ticket" value="0" class="selectgroup-input" type="radio" <?php echo set_radio('ticket', '0', ($group->ticket ?? null) == '0' || empty($group->ticket)) ?>>
                <span class="selectgroup-button">View</span>
            </label>
            <label class="selectgroup-item">
                <input name="ticket" value="1" class="selectgroup-input" type="radio" <?php echo set_radio('ticket', '1', ($group->ticket ?? null) == '1') ?>>
                <span class="selectgroup-button">Comment</span>
            </label>
            <label class="selectgroup-item">
                <input name="ticket" value="2" class="selectgroup-input" type="radio" <?php echo set_radio('ticket', '2', ($group->ticket ?? null) == '2') ?>>
                <span class="selectgroup-button">Create</span>
            </label>
            <label class="selectgroup-item">
                <input name="ticket" value="3" class="selectgroup-input" type="radio" <?php echo set_radio('ticket', '3', ($group->ticket ?? null) == '3') ?>>
                <span class="selectgroup-button">Edit</span>
            </label>
        </div>
        <?php echo form_error('ticket') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="project">Project</label>
        <div class="selectgroup">
            <label class="selectgroup-item">
                <input name="project" value="1" class="selectgroup-input" type="radio" <?php echo set_radio('project', '0', ($group->project ?? null) == '0' || empty($group->project)) ?>>
                <span class="selectgroup-button">View</span>
            </label>
            <label class="selectgroup-item">
                <input name="project" value="2" class="selectgroup-input" type="radio" <?php echo set_radio('project', '2', ($group->project ?? null) == '2') ?>>
                <span class="selectgroup-button">Create</span>
            </label>
            <label class="selectgroup-item">
                <input name="project" value="3" class="selectgroup-input" type="radio" <?php echo set_radio('project', '3', ($group->project ?? null) == '3') ?>>
                <span class="selectgroup-button">Edit</span>
            </label>
        </div>
        <?php echo form_error('project') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="settings">Settings</label>
        <div class="selectgroup">
            <label class="selectgroup-item">
                <input name="settings" value="0" class="selectgroup-input" type="radio" <?php echo set_radio('settings', '0', ($group->settings ?? null) == '0' || empty($group->settings)) ?>>
                <span class="selectgroup-button">None</span>
            </label>
            <label class="selectgroup-item">
                <input name="settings" value="1" class="selectgroup-input" type="radio" <?php echo set_radio('settings', '1', ($group->settings ?? null) == '1') ?>>
                <span class="selectgroup-button">View</span>
            </label>
            <label class="selectgroup-item">
                <input name="settings" value="2" class="selectgroup-input" type="radio" <?php echo set_radio('settings', '2', ($group->settings ?? null) == '2') ?>>
                <span class="selectgroup-button">Create</span>
            </label>
            <label class="selectgroup-item">
                <input name="settings" value="3" class="selectgroup-input" type="radio" <?php echo set_radio('settings', '3', ($group->settings ?? null) == '3') ?>>
                <span class="selectgroup-button">Edit</span>
            </label>
        </div>
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