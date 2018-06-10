<?php $this->load->view('header') ?>
<h1 class="mb-3">Tintin</h1>
<h4 class="text-muted mb-7">Ticket management system</h4>
<p class="mb-7">Welcome to Tintin, an open source ticketing software. <br>
Create tickets, assign them to projects and track progress by updating ticket statuses.</p>

<a href="<?php echo base_url('user/signup') ?>" class="btn btn-primary">Get Started</a>
<a href="<?php echo base_url('features') ?>" class="btn btn-secondary ml-1">Learn More</a>

<a href="<?php echo base_url('images/ticket.png') ?>" class="lightbox d-block">
	<img class="w-50 mt-7 mb-3" src="<?php echo base_url('images/ticket.png') ?>"><br>
	<i class="text-muted d-block">Screenshot of single ticket view</i>
</a>

<?php $this->load->view('footer') ?>
