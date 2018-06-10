<?php $this->load->view('header') ?>
<h1>Features</h1>
<p>Here are some of the features of Tintin:</p>

<div class="row gutters-xl features">
	<div class="col-xl-3 col-lg-6">
		<i class="text-muted fe fe-home"></i>
		<h4 class="text-center">Home Dashboard</h4>
		<p>Your team's home dashoard gives you a summary of tickets in each status. The dashboard also has a list of the most recently created tickets.</p>
	</div>
	<div class="col-xl-3 col-lg-6">
		<i class="text-muted fe fe-file"></i>
		<h4 class="text-center">Ticket View Tools</h4>
		<p>On each ticket view is the ticket details, a quick update form and the revision history. The quick update form can be used to add a comment or change status. Changes made to the ticket is reflected in the revision history.</p>
		</div>
	<div class="col-xl-3 col-lg-6">
		<i class="text-muted fe fe-terminal"></i>
		<h4 class="text-center">Keyboard Shortcuts</h4>
		<p>Press Q and W at any time on Tintin to go to the new ticket page. More keyboard shortcuts will be added soon, such as a quicksearch and shortcuts to various pages.</p>
	</div>
	<div class="col-xl-3 d-lg-none d-xl-block">
	</div>
	<div class="col-xl-3 col-lg-6">
		<i class="text-muted fe fe-package"></i>
		<h4 class="text-center">Projects</h4>
		<p>Keep track of grouped tickets with projects. Each ticket can be assigned a project, and each project's completion progress can be seen in the projects page. Progress is based on how many tickets in the project have a completed status.</p>
	</div>
	<div class="col-xl-3 col-lg-6">
		<i class="text-muted fe fe-search"></i>
		<h4 class="text-center">Search</h4>
		<p>Perform queries for tickets through the search page - search by keywords in the title or description, by project, by status, or creation and modification date ranges.</p>
	</div>
	<div class="col-xl-3 col-lg-6">
		<i class="text-muted fe fe-thumbs-up"></i>
		<h4 class="text-center">Updates</h4>
		<p>Tintin is under continuous development, with plenty of new features to come. View progress or make suggestions at the project's Github page.</p>
	</div>
</div>
<?php $this->load->view('footer') ?>
