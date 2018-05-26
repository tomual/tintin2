<?php $this->load->view('header') ?>
<h1>Sign Up</h1>
<?php if($this->session->flashdata('error')): ?>
    <div class="error"><?php echo $this->session->flashdata('error') ?></div>
<?php endif ?>
<form method="post">
    <table>
        <tr>
            <td><label class="form-label" for="name">Group Name</label></td>
            <td>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo set_value('name') ?>">
                <?php echo form_error('name') ?>
            </td>
        </tr>
        <tr>
            <td><label class="form-label" for="email">Email</label></td>
            <td>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo set_value('email') ?>">
                <?php echo form_error('email') ?>
            </td>
        </tr>
        <tr>
            <td><label class="form-label" for="first_name">First Name</label></td>
            <td>
                <input type="text" class="form-control" name="first_name" id="first_name" value="<?php echo set_value('first_name') ?>">
                <?php echo form_error('first_name') ?>
            </td>
        </tr>
        <tr>
            <td><label class="form-label" for="last_name">Last Name</label></td>
            <td>
                <input type="text" class="form-control" name="last_name" id="last_name" value="<?php echo set_value('last_name') ?>">
                <?php echo form_error('last_name') ?>
            </td>
        </tr>
        <tr>
            <td><label class="form-label" for="password">Password</label></td>
            <td>
                <input type="password" name="password" id="password" value="<?php echo set_value('password') ?>">
                <?php echo form_error('password') ?>
            </td>
        </tr>
        <tr>
            <td><label class="form-label" for="password2">Password (again)</label></td>
            <td>
                <input type="password" name="password2" id="password2" value="<?php echo set_value('password2') ?>">
                <?php echo form_error('password2') ?>
            </td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Start"></td>
        </tr>
    </table>
</form>
<?php $this->load->view('footer') ?>
