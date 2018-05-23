<form method="post">
    <table>
        <tr>
            <td><label for="title">Title</label></td>
            <td>
                <input type="text" name="title" id="title" value="<?php echo set_value('title', null) ?? $ticket->title ?? null ?>">
                <?php echo form_error('title') ?>
            </td>
        </tr>
        <tr>
            <td><label for="description">Description</label></td>
            <td>
                <textarea name="description" id="description" cols="30" rows="5"><?php echo set_value('description', null) ?? $ticket->description ?? null?></textarea>
                <?php echo form_error('description') ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Create"></td>
        </tr>
    </table>
</form>
