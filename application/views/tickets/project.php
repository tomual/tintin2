<?php $this->load->view('header') ?>
<h1><?php echo $project->label ?> Tickets</h1>
<?php echo $project->description ?>
<?php $this->load->view('tickets/list') ?>
<?php $this->load->view('footer') ?>
