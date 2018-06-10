<?php $this->load->view('header') ?>
<h1>Screenshots</h1>
<p>Screenshots of various pages on Tintin</p>

<div class="row gutters-xl text-center">
	<div class="col">
		<a href="<?php echo base_url('images/home.png') ?>" class="lightbox">
			<img class="w-50 mt-7 mb-3" src="<?php echo base_url('images/home.png') ?>"><br>
			<i class="text-muted d-block">Dashboard page upon logging into Tintin</i>
		</a>
		<a href="<?php echo base_url('images/ticket.png') ?>" class="lightbox">
			<img class="w-50 mt-7 mb-3" src="<?php echo base_url('images/ticket.png') ?>"><br>
			<i class="text-muted d-block">Single ticket view</i>
		</a>
		<a href="<?php echo base_url('images/projects.png') ?>" class="lightbox">
			<img class="w-50 mt-7 mb-3" src="<?php echo base_url('images/projects.png') ?>"><br>
			<i class="text-muted d-block">Project list with progress information</i>
		</a>
		<a href="<?php echo base_url('images/list.png') ?>" class="lightbox">
			<img class="w-50 mt-7 mb-3" src="<?php echo base_url('images/list.png') ?>"><br>
			<i class="text-muted d-block">List view of all tickets</i>
		</a>
	</div>
</div>

<?php $this->load->view('footer') ?>
