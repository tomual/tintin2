<?php $this->load->view('header') ?>
<h1>About</h1>

<div class="row">
	<div class="col-6">
		<p>Tintin is an open source ticketing system. Its main goal is to provide a fast, 
		intuitive way to log tickets through keyboard shortcuts and a clean interface. It
		is in continuous development.</p>
		<p>Those interested in using Tintin can either <a href="<?php echo base_url('user/signup') ?>">sign up</a> to the service here, 
		or host it using a private server by downloading the source files.</p>
	</div>
</div>


<a href="https://github.com/tomual/tintin2" class="btn btn-primary my-5 mr-2"><i class="fe fe-github mr-2"></i>View on GitHub</a>
<a href="https://github.com/tomual/tintin2/archive/master.zip" class="btn btn-secondary my-5"><i class="fe fe-download mr-2"></i>Download</a>

<h3 class="mt-5">Self-hosting Instructions</h3>
<ol>
	<li>Place files in web server running PHP 7 or higher</li>
	<li>Run <i><b>tables.sql</b></i> on your database to create the tables</li>
	<li>Edit <i><b>config/database.php</b></i> to enter database credentials</li>
	<li>Edit <i><b>config/config.php</b></i>'s <i><b>$config['base_url']</b></i> property to the hosted site's URL</li>
</ol>


<?php $this->load->view('footer') ?>
