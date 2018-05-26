<form method="post">
    <table>
        <tr>
            <td width="110"><label class="form-label" for="label">Label</label></td>
            <td>
                <input type="text" class="form-control" name="label" id="label" value="<?php echo set_value('label', null) ?? $project->label ?? null ?>">
                <?php echo form_error('label') ?>
            </td>
        </tr>
        <tr>
            <td><label class="form-label" for="description">Description</label></td>
            <td>
                <textarea class="form-control" name="description" id="description" cols="30" rows="5"><?php echo set_value('description', null) ?? $project->description ?? null ?></textarea>
                <?php echo form_error('description') ?>
            </td>
        </tr>
        <?php if ($this->router->fetch_method() != 'new'): ?>
            <tr>
                <td></td>
                <td><input type="submit" value="Update" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-link">Cancel</a></td>
            </tr>
        <?php else: ?>
            <tr>
                <td></td>
                <td><input type="submit" value="Create" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-link">Cancel</a></td>
            </tr>
        <?php endif ?>
    </table>
</form>

<?php if ($this->router->fetch_method() != 'new'): ?>
    <table>
        <tr>
            <td width="110"></td>
            <td>
                <form action="<?php echo base_url("project/delete/{$project->project_id}") ?>" method="post">
                    <input type="submit" value="Delete Project" onclick="return confirm('Delete this project?')" class="btn btn-secondary">
                </form>
            </td>
        </tr>
    </table>
<?php endif ?>