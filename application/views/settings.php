<?php $this->load->view('header') ?>
<h1>Settings</h1>
<div class="card settings-card"><a href="<?php echo base_url('settings/edit') ?>"><i class="fe fe-settings"></i><span>General</span></a></div>
<div class="card settings-card"><a href="<?php echo base_url('status/all') ?>"><i class="fe fe-tag"></i><span>Statuses</span></a></div>
<div class="card settings-card"><a href="<?php echo base_url('user/all') ?>"><i class="fe fe-user"></i><span>Users</span></a></div>
<div class="card settings-card"><a href="<?php echo base_url('group/all') ?>"><i class="fe fe-users"></i><span>Groups</span></a></div>
<?php $this->load->view('footer') ?>
