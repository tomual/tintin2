<?php $this->load->view('header') ?>
<h1>Edit Ticket</h1>
<?php $this->load->view('tickets/form', compact('ticket', 'statuses')) ?>
<?php $this->load->view('footer') ?>
