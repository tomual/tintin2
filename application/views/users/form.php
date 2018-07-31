<?php $this->load->view('header') ?>
<h1>New User</h1>
<?php if ($this->session->flashdata('error')): ?>
    <div class="error"><?php echo $this->session->flashdata('error') ?></div>
<?php endif ?>
<form method="post" class="form-signup">
    <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email') ?>">
        <?php echo form_error('email') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo set_value('first_name') ?>">
        <?php echo form_error('first_name') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="last_name">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo set_value('last_name') ?>">
        <?php echo form_error('last_name') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" value="<?php echo set_value('password') ?>">
        <?php echo form_error('password') ?>
    </div>

    <input type="submit" value="Create" class="btn btn-primary">
    <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>

</form>
<?php $this->load->view('footer') ?>
