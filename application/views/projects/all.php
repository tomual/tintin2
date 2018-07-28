<?php $this->load->view('header') ?>
<h1>Projects</h1>
<br>
<a href="<?php echo base_url('project/new') ?>" class="btn btn-primary">New Project</a>
<table class="table table-hover table-vcenter mt-3">
    <thead>
    <tr>
        <th width="40%">Project</th>
        <th class="text-center">Tickets</th>
        <th>Progress</th>
        <th></th>
<!--        <th width="120">Started</th>-->
<!--        <th width="120">Completed</th>-->
    </tr>
    </thead>
    <tbody>
    <?php foreach ($projects as $project): ?>
        <tr>
            <td>
                <div><a href="<?php echo base_url("ticket/project/{$project->project_id}") ?>" class="text-inherit"><?php echo $project->label ?></a></div>
                <div class="small text-muted"><?php echo $project->description ?></div>
            </td>
            <td class="text-center"><a href="<?php echo base_url("ticket/project/{$project->project_id}") ?>" class="text-inherit"><?php echo $project->tickets ?></a></td>
            <td>
                <div class="clearfix">
                    <div class="float-left">
                        <strong><?php echo floor($project->complete / $project->tickets * 100) ?>%</strong>
                    </div>
                    <div class="float-right">
                        <small class="text-muted"></small>
                    </div>
                </div>
                <div class="progress progress-xs">
                    <div class="progress-bar bg-blue" role="progressbar" style="width: <?php echo floor($project->complete / $project->tickets * 100) ?>%" aria-valuenow="<?php echo floor($project->complete / $project->tickets * 100) ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </td>
            <td><a href="<?php echo base_url("project/edit/{$project->project_id}") ?>" class="btn btn-sm btn-secondary">Edit</a></td>
<!--            <td>--><?php //echo date('M j, Y', strtotime($project->created_at)) ?><!--</td>-->
<!--            <td>--><?php //echo date('M j, Y', strtotime($project->created_at)) ?><!--</td>-->
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php $this->load->view('footer') ?>
