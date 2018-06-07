<?php $this->load->view('header') ?>
<h1>Query</h1>
<div class="row">
    <div class="col-4">
        <fieldset class="form-fieldset">
            <form>
                <div class="form-group">
                    <label for="keywords" class="form-label">Keywords</label>
                    <input type="text" class="form-control" name="keywords" value="<?php echo $this->input->get('keywords') ?>">
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </fieldset>
    </div>
</div>

<?php $this->load->view('tickets/list') ?>
<?php $this->load->view('footer') ?>
