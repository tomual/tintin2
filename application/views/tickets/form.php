<form method="post">
    <div class="form-group">
        <label class="form-label" for="title">Title</label>
        <input type="text" class="form-control  <?php if(form_error('title')) echo 'is-invalid' ?>" name="title" id="title" value="<?php echo set_value('title', null) ?? $ticket->title ?? null ?>">
        <?php echo form_error('title') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="description">Description</label>
        <textarea class="form-control  <?php if(form_error('description')) echo 'is-invalid' ?>" name="description" id="description" cols="30" rows="5"><?php echo set_value('description', null) ?? $ticket->description ?? null ?></textarea>
        <?php echo form_error('description') ?>
    </div>

    <div class="form-group">
        <label class="form-label" for="project_id">Project</label>
        <?php if (!empty($this->projects)): ?>
        <select class="form-control  <?php if(form_error('project_id')) echo 'is-invalid' ?>" name="project_id" id="project_id">
            <option value="">No project</option>
            <?php foreach ($this->projects as $project): ?>
                <option value="<?php echo $project->project_id ?>" <?php echo set_select('project_id', $project->project_id, ($ticket->project_id ?? null) == $project->project_id) ?>><?php echo $project->label ?></option>
            <?php endforeach ?>
        </select>
        <?php echo form_error('project_id') ?>
    </div>
    <?php else: ?>
        No projects set - <a href="<?php echo base_url('project/list') ?>">Manage projects</a>
    <?php endif ?>

    <?php if ($this->router->fetch_method() != 'new'): ?>
        <div class="form-group">
            <label class="form-label" for="status">Status</label>
            <select class="form-control  <?php if(form_error('status_id')) echo 'is-invalid' ?>" name="status_id" id="status_id">
                <?php foreach ($this->statuses as $status): ?>
                    <option value="<?php echo $status->status_id ?>" <?php echo set_select('status_id', $status->status_id, $ticket->status_id == $status->status_id) ?>><?php echo $status->label ?></option>
                <?php endforeach ?>
            </select>
            <?php echo form_error('status_id') ?>
        </div>

        <div class="form-group">
            <label class="form-label" for="comment">Comment</label>
            <textarea class="form-control  <?php if(form_error('comment')) echo 'is-invalid' ?>" name="comment" id="comment" rows="3"></textarea>
            <?php echo form_error('comment') ?>
        </div>

        <input type="submit" value="Update" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-link">Cancel</a>
    <?php else: ?>
        <input type="submit" value="Create" class="btn btn-primary"> <a href="javascript:history.back()" class="btn btn-link">Cancel</a>
    <?php endif ?>
</form>
