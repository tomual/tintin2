<?php echo alerts() ?>
<form method="post">
    <div class="form-group">
        <label class="form-label" for="label">Label</label>
        <input type="text" class="form-control <?php if(form_error('label')) echo 'is-invalid' ?>" name="label" id="label" value="<?php echo set_value('label', null) ?? $project->label ?? null ?>" autofocus>
        <?php echo form_error('label') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control <?php if(form_error('description')) echo 'is-invalid' ?>" name="description" id="description" cols="30" rows="5"><?php echo set_value('description', null) ?? $project->description ?? null ?></textarea>
        <?php echo form_error('description') ?>
    </div>

    <?php if ($this->router->fetch_method() != 'new'): ?>
        <input type="submit" value="Update" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
    <?php else: ?>
        <input type="submit" value="Create" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
    <?php endif ?>
</form>

<?php if ($this->router->fetch_method() != 'new'): ?>
    <form action="<?php echo base_url("project/delete/{$project->project_id}") ?>" method="post">
        <input type="submit" value="Delete Project" onclick="return confirm('Delete this project?')" class="btn btn-link mt-3">
    </form>
<?php endif ?>