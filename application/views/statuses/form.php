<form method="post">
    <div class="form-group">
        <label class="form-label" for="label">Label</label>
        <input type="text" class="form-control <?php if(form_error('label')) echo 'is-invalid' ?>" name="label" id="label" value="<?php echo set_value('label', null) ?? $status->label ?? null ?>">
        <?php echo form_error('label') ?>
    </div>
    
    <div class="form-group">
        <label class="form-label">Color Input</label>
        <div class="row gutters-xs">
            <div class="col-auto">
                <label class="colorinput">
                    <input name="color" value="azure" class="colorinput-input" type="radio" <?php echo set_radio('color', 'azure', $status->color == 'azure' ?? true) ?>>
                    <span class="colorinput-color bg-azure"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input name="color" value="indigo" class="colorinput-input" type="radio" <?php echo set_radio('color', 'indigo', $status->color == 'indigo') ?>>
                    <span class="colorinput-color bg-indigo"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input name="color" value="purple" class="colorinput-input" type="radio" <?php echo set_radio('color', 'purple', $status->color == 'purple') ?>>
                    <span class="colorinput-color bg-purple"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input name="color" value="pink" class="colorinput-input" type="radio" <?php echo set_radio('color', 'pink', $status->color == 'pink') ?>>
                    <span class="colorinput-color bg-pink"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input name="color" value="red" class="colorinput-input" type="radio" <?php echo set_radio('color', 'red', $status->color == 'red') ?>>
                    <span class="colorinput-color bg-red"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input name="color" value="orange" class="colorinput-input" type="radio" <?php echo set_radio('color', 'orange', $status->color == 'orange') ?>>
                    <span class="colorinput-color bg-orange"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input name="color" value="yellow" class="colorinput-input" type="radio" <?php echo set_radio('color', 'yellow', $status->color == 'yellow') ?>>
                    <span class="colorinput-color bg-yellow"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input name="color" value="lime" class="colorinput-input" type="radio" <?php echo set_radio('color', 'lime', $status->color == 'lime') ?>>
                    <span class="colorinput-color bg-lime"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input name="color" value="green" class="colorinput-input" type="radio" <?php echo set_radio('color', 'green', $status->color == 'green') ?>>
                    <span class="colorinput-color bg-green"></span>
                </label>
            </div>
            <div class="col-auto">
                <label class="colorinput">
                    <input name="color" value="teal" class="colorinput-input" type="radio" <?php echo set_radio('color', 'teal', $status->color == 'teal') ?>>
                    <span class="colorinput-color bg-teal"></span>
                </label>
            </div>
        </div>
        <?php echo form_error('color') ?>
    </div>

    <div class="form-group">
        <div class="form-label">Status options</div>
        <div class="custom-controls-stacked">
                <label class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="complete" value="Y" type="checkbox" <?php echo set_checkbox('complete', 'Y', $status->complete ?? null == 'Y') ?>>
                    <span class="custom-control-label">Completed status</span>
                </label>

                <label class="custom-control custom-checkbox">
                    <input class="custom-control-input" name="cancel" value="Y" type="checkbox" <?php echo set_checkbox('cancel', 'Y', $status->cancel ?? null == 'Y') ?>>
                    <span class="custom-control-label">Cancelled status</span>
                </label>
        </div>
    </div>

    <?php if ($this->router->fetch_method() != 'new'): ?>
        <input type="submit" value="Update" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
    <?php else: ?>
        <input type="submit" value="Create" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
    <?php endif ?>
</form>

<?php if ($this->router->fetch_method() != 'new'): ?>
    <form action="<?php echo base_url("status/delete/{$status->status_id}") ?>" method="post">
        <input type="submit" value="Delete Status" onclick="return confirm('Delete this status?')" class="btn btn-link mt-3">
    </form>
<?php endif ?>