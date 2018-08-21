<?php echo alerts() ?>
<form method="post" class="form-signup">
    <div class="form-group">
        <label class="form-label" for="email">Email</label>
        <input type="text" class="form-control <?php if(form_error('email')) echo 'is-invalid' ?>" name="email" id="email" value="<?php echo set_value('email', $user->email ?? null) ?>">
        <?php echo form_error('email') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="first_name">First Name</label>
        <input type="text" class="form-control <?php if(form_error('first_name')) echo 'is-invalid' ?>" name="first_name" id="first_name" value="<?php echo set_value('first_name', $user->first_name ?? null) ?>">
        <?php echo form_error('first_name') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="last_name">Last Name</label>
        <input type="text" class="form-control <?php if(form_error('last_name')) echo 'is-invalid' ?>" name="last_name" id="last_name" value="<?php echo set_value('last_name', $user->last_name ?? null) ?>">
        <?php echo form_error('last_name') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="project_id">Group</label>
        <select class="selectize form-control  <?php if (form_error('group_id')) echo 'is-invalid' ?>" name="group_id" id="group_id">
            <option value="">No group</option>
            <?php foreach ($groups as $group): ?>
                <option value="<?php echo $group->group_id ?>" <?php echo set_select('group_id', $group->group_id, ($user->group_id ?? null) == $group->group_id) ?>><?php echo $group->label ?></option>
            <?php endforeach ?>
        </select>
        <?php echo form_error('group_id') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="password">Password</label>
        <input type="password" class="form-control <?php if(form_error('password')) echo 'is-invalid' ?>" name="password" id="password" value="">
        <?php echo form_error('password') ?>
    </div>

    <?php if ($this->router->fetch_method() != 'new'): ?>
        <input type="submit" value="Update" class="btn btn-primary"> <a href="<?php echo base_url('user/all') ?>" class="btn btn-secondary">Cancel</a>
    <?php else: ?>
        <input type="submit" value="Create" class="btn btn-primary"> <a href="<?php echo base_url('user/all') ?>" class="btn btn-secondary">Cancel</a>
    <?php endif ?>
</form>
