<?php $this->load->view('header') ?>
<h1>Log In</h1>
<?php echo alerts() ?>
<form method="post" class="form-login">
    <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email') ?>">
        <?php echo form_error('email') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password">
        <?php echo form_error('password') ?>
    </div>
    <input type="submit" value="Log in" class="btn btn-primary">
    <a href="<?php echo base_url('user/signup') ?>" class="d-block small mt-4">Don't have an account? Sign up</a>
</form>
<?php $this->load->view('footer') ?>
