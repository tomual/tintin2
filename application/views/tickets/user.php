<?php $this->load->view('header') ?>
<h1 class="d-inline"><?php echo $user->first_name . ' ' . $user->last_name ?> <small class="text-muted">&middot; Tickets by User</small></h1>
<?php $this->load->view('tickets/list') ?>
<?php $this->load->view('footer') ?>
