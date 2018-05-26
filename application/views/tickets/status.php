<?php $this->load->view('header') ?>
<h1 class="d-inline"><?php echo $status->label ?> <small class="text-muted">&middot; Status</small></h1>
<a href="<?php echo base_url("status/edit/{$status->status_id}") ?>" class="btn btn-sm btn-secondary ml-3 align-super">Edit Status</a>
<?php $this->load->view('tickets/list') ?>
<?php $this->load->view('footer') ?>
