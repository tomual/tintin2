<?php $this->load->view('header') ?>
<h1>Log In</h1>
<?php if ($this->session->flashdata('error')): ?>
    <div class="error"><?php echo $this->session->flashdata('error') ?></div>
<?php endif ?>
<form method="post" class="form-login">
    <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email') ?>">
        <?php echo form_error('email') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" value="<?php echo set_value('password') ?>">
        <?php echo form_error('password') ?>
    </div>
    <input type="submit" value="Log in" class="btn btn-primary">
</form>
<?php $this->load->view('footer') ?>
