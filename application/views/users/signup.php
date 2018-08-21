<?php $this->load->view('header') ?>
<h1>Sign Up</h1>
<?php echo alerts() ?>
<form method="post" class="form-signup">
    <div class="form-group">
        <label class="form-label" for="name">Group Name</label>
        <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name') ?>">
        <?php echo form_error('name') ?>
    </div>

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

    <div class="form-group">
        <label class="form-label" for="password2">Password (again)</label>
        <input type="password" class="form-control" name="password2" id="password2" value="<?php echo set_value('password2') ?>">
        <?php echo form_error('password2') ?>
    </div>

    <input type="submit" value="Sign up" class="btn btn-primary">
    <a href="<?php echo base_url('user/login') ?>" class="d-block small mt-4">Already have an account? Log in</a>

</form>
<?php $this->load->view('footer') ?>
