<form method="post">
    <div class="form-group">
        <label class="form-label" for="label">Label</label>
        <input type="text" class="form-control <?php if(form_error('label')) echo 'is-invalid' ?>" name="label" id="label" value="<?php echo set_value('label', null) ?? $status->label ?? null ?>">
        <?php echo form_error('label') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="color">Color</label>
        <input type="text" class="form-control <?php if(form_error('color')) echo 'is-invalid' ?>" name="color" id="color" value="<?php echo set_value('color', null) ?? $status->color ?? null ?>">
        <?php echo form_error('color') ?>
    </div>

    <div class="form-group">
        <div class="form-label">Status options</div>
        <div class="custom-controls-stacked">
                <label class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="completed" value="Y" type="checkbox">
                    <span class="custom-control-label">Completed status</span>
                </label>

                <label class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="cancelled" value="Y" type="checkbox">
                    <span class="custom-control-label">Cancelled status</span>
                </label>
        </div>
    </div>

    <?php if ($this->router->fetch_method() != 'new'): ?>
        <input type="submit" value="Update" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-link">Cancel</a>
    <?php else: ?>
        <input type="submit" value="Create" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-link">Cancel</a>
    <?php endif ?>
</form>

<?php if ($this->router->fetch_method() != 'new'): ?>
    <form action="<?php echo base_url("status/delete/{$status->status_id}") ?>" method="post">
        <input type="submit" value="Delete Status" onclick="return confirm('Delete this status?')" class="btn btn-secondary mt-3">
    </form>
<?php endif ?>