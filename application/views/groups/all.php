<?php $this->load->view('header') ?>
<h1>Groups</h1>
<br>
<a href="<?php echo base_url('group/new') ?>" class="btn btn-primary">New Group</a>
<table class="table table-hover table-vcenter mt-3">
    <thead>
    <tr>
        <th>Group</th>
        <th></th>
    </tr>
    </thead>
    <tbody class="sortable">
        <?php foreach($groups as $group): ?>
            <tr>
                <td><a href="<?php echo base_url("group/edit/{$group->group_id}") ?>" class="text-inherit"><?php echo $group->label ?></a></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php $this->load->view('footer') ?>
