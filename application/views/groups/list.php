<?php $this->load->view('header') ?>
<h1>Projects List</h1>
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
            <td><?php echo $project->label ?></td>
            <td>
                <div class="progressbar">
                    <div></div>
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
