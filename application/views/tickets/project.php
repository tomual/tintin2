<?php $this->load->view('header') ?>
<h1 class="d-inline"><?php echo $project->label ?>  <small class="text-muted">&middot; Project</small></h1>
<a href="<?php echo base_url("project/edit/{$project->project_id}") ?>" class="btn btn-sm btn-secondary ml-3 align-super">Edit Project</a>
<div class="my-5"><?php echo $project->description ?></div>
<?php $this->load->view('tickets/list') ?>
<?php $this->load->view('footer') ?>
