<?php $this->load->view('header') ?>
<h1>Welcome to tintin</h1>
<p>Tintin is a ticketing system. It aims to be intuitive and essentialist - that is, it only has the necessities.</p>
<h2>Get Started</h2>
<form action="<?php echo base_url('user/signup') ?>" method="post">
    <table>
        <tr>
            <td><label for="email">Email</label></td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
        <tr>
            <td><label for="password">Password</label></td>
            <td><input type="text" name="password" id="password"></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Start" class="btn btn-primary"></td>
        </tr>
    </table>
</form>
<?php $this->load->view('footer') ?>
