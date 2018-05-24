<?php $this->load->view('header') ?>
<h1>Projects List</h1>
<br>
<a href="<?php echo base_url('project/new') ?>"><button>New Project</button></a>
<table border="1">
    <thead>
    <tr>
        <th>Project</th>
        <th>Description</th>
        <th>Created</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($projects as $project): ?>
        <tr>
            <td><?php echo $project->label ?></td>
            <td><?php echo $project->description ?></td>
            <td><?php echo $project->created_at ?></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
<?php $this->load->view('footer') ?>
