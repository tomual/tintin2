<?php $this->load->view('header') ?>
<h1>Edit Ticket</h1>
<?php if($this->session->flashdata('error')): ?>
    <div class="error"><?php echo $this->session->flashdata('error') ?></div>
<?php endif ?>
<?php $this->load->view('tickets/form', compact('ticket', 'statuses')) ?>
<?php $this->load->view('footer') ?>
