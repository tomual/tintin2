<?php $this->load->view('header') ?>
<h1>Projects</h1>
<br>
<a href="<?php echo base_url('project/new') ?>" class="btn btn-primary">New Project</a>
<table border="1" class="mt-1">
    <thead>
    <tr>
        <th>Project</th>
        <th>Progress</th>
        <th>Description</th>
        <th>Started</th>
        <th>Completed</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($projects as $project): ?>
        <tr>
            <td><a href="<?php echo base_url("ticket/project/{$project->project_id}") ?>"><?php echo $project->label ?></a></td>
            <td>
                <div class="progressbar">
                    <div style="width:<?php echo $project->complete / $project->tickets * 100 ?>%"></div>
                </div>
            </td>
            <td><?php echo $project->description ?></td>
            <td><?php echo date('M j, Y', strtotime($project->created_at)) ?></td>
            <td><?php echo date('M j, Y', strtotime($project->created_at)) ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php $this->load->view('footer') ?>
