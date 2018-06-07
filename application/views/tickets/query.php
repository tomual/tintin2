<?php $this->load->view('header') ?>
<h1>Query</h1>
<div class="row">
    <div class="col-xl-6">
        <fieldset class="form-fieldset">
            <form>
                <div class="form-group">
                    <label for="keywords" class="form-label">Keywords</label>
                    <input type="text" class="form-control" name="keywords" value="<?php echo $this->input->get('keywords') ?>">
                </div>
                <div class="form-group">
                    <label class="form-label" for="project_id">Project</label>
                    <select class="form-control" name="project_id" id="project_id">
                        <option value="">-</option>
                        <?php foreach ($this->projects as $project): ?>
                            <option value="<?php echo $project->project_id ?>" <?php echo $this->input->get('project_id') == $project->project_id ? 'selected' : '' ?>><?php echo $project->label ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label" for="status">Status</label>
                    <select class="form-control" name="status_id" id="status_id">
                        <option value="">-</option>
                        <?php foreach ($this->statuses as $status): ?>
                            <option value="<?php echo $status->status_id ?>" <?php echo $this->input->get('status_id') == $status->status_id ? 'selected' : '' ?>><?php echo $status->label ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                <!--
                <div class="form-group">
                    <label class="form-label" for="status">Worker</label>
                    <select class="form-control" name="worker_id" id="worker_id">
                        <option value="">-</option>
                        <?php foreach ($this->users as $user): ?>
                            <option value="<?php echo $user->user_id ?>" <?php echo $this->input->get('worker_id') == $user->user_id ? 'selected' : '' ?>><?php echo $user->first_name ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
                -->
                <div class="form-group">
                    <div class="form-group">
                        <label class="form-label">Created between &hellip; </label>
                        <div class="row gutters-xs">
                            <div class="col-5">
                                <input type="text" class="form-control datepicker" name="created_from" value="<?php echo $this->input->get('created_from') ?>">
                            </div>
                            <div class="col-1 text-small text-muted text-center pt-1">
                                and
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control datepicker" name="created_to" value="<?php echo $this->input->get('created_to') ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="form-group">
                        <label class="form-label">Updated between &hellip; </label>
                        <div class="row gutters-xs">
                            <div class="col-5">
                                <input type="text" class="form-control datepicker" name="updated_from" value="<?php echo $this->input->get('updated_from') ?>">
                            </div>
                            <div class="col-1 text-small text-muted text-center pt-1">
                                and
                            </div>
                            <div class="col-5">
                                <input type="text" class="form-control datepicker" name="updated_to" value="<?php echo $this->input->get('updated_to') ?>">
                            </div>
                        </div>
                    </div>
                </div>
                <input type="submit" class="btn btn-primary" value="Submit">
            </form>
        </fieldset>
    </div>
</div>

<?php $this->load->view('tickets/list') ?>
<?php $this->load->view('footer') ?>
