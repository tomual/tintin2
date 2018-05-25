<?php $this->load->view('header') ?>
<h1><?php echo $project->label ?> Tickets</h1>
<a href="<?php echo base_url("project/edit/{$project->project_id}") ?>" class="btn btn-link">Edit Project</a>
<br>
<?php echo $project->description ?>
<?php $this->load->view('tickets/list') ?>
<?php $this->load->view('footer') ?>
