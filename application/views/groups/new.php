<?php $this->load->view('header') ?>
<h1>New Group</h1>
<?php if($this->session->flashdata('error')): ?>
    <div class="error"><?php echo $this->session->flashdata('error') ?></div>
<?php endif ?>
<?php $this->load->view('groups/form') ?>
<?php $this->load->view('footer') ?>
