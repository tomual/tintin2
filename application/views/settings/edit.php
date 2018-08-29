<?php $this->load->view('header') ?>
<h1 class="d-inline">Settings</h1>
<?php echo alerts() ?>
<form method="post">
    <div class="form-group">
        <label class="form-label" for="name">Team Name</label>
        <input type="text" class="form-control  <?php if (form_error('name')) echo 'is-invalid' ?>" name="name" id="name" value="<?php echo set_value('name', null) ?? $team->name ?? null ?>">
        <?php echo form_error('name') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="status">Ticket Starting Status</label>
        <select class="form-control  <?php if (form_error('status_start')) echo 'is-invalid' ?>" name="status_start" id="status_start">
            <?php foreach ($this->statuses as $status): ?>
                <option value="<?php echo $status->status_id ?>" <?php echo set_select('status_start', $status->status_id, $settings->status_start == $status->status_id) ?>><?php echo $status->label ?></option>
            <?php endforeach ?>
        </select>
        <?php echo form_error('status_start') ?>
    </div>

    <input type="submit" value="Update" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
</form>
<?php $this->load->view('footer') ?>
