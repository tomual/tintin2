<form method="post">
    <table>
        <tr>
            <td><label for="label">Label</label></td>
            <td>
                <input type="text" name="label" id="label" value="<?php echo set_value('label', null) ?? $ticket->label ?? null ?>">
                <?php echo form_error('label') ?>
            </td>
        </tr>
        <tr>
            <td><label for="description">Description</label></td>
            <td>
                <textarea name="description" id="description" cols="30" rows="5"><?php echo set_value('description', null) ?? $ticket->description ?? null ?></textarea>
                <?php echo form_error('description') ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Create" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-link">Cancel</a></td>
        </tr>
    </table>
</form>
