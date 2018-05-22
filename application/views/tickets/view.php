<?php $this->load->view('header') ?>
<div class="ticket">
    <h1><?php echo $ticket->title ?></h1>
    <br>
    <?php echo $ticket->description ?>
    <h2>Details</h2>
    <table>
        <tr>
            <th>Author</th>
            <td><?php echo $ticket->user_id ?></td>
        </tr>
        <tr>
            <th>Created at</th>
            <td><?php echo $ticket->created_at ?></td>
        </tr>
        <tr>
            <th>Project</th>
            <td>tintin2</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>Working</td>
        </tr>
        <tr>
            <td></td>
            <td><button>Edit Ticket</button></td>
        </tr>
    </table>

    <h2>Quick Update</h2>
    <form method="post">
        <table>
            <tr>
                <td><label for="">Status</label></td>
                <td>
                    <select name="status" id="status">
                        <option value="1">Working</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="comment">Comment</label></td>
                <td><textarea name="comment" id="comment" cols="30" rows="3"></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Update"></td>
            </tr>
        </table>
    </form>
    <h2>Revisions</h2>
    <ul>
        <li>Status from <a href="">Input</a> to <a href="">Working</a>
            <br>by <a href="">tom3</a> at 12/05/2018 12:00PM
        </li>
    </ul>
</div>
<?php $this->load->view('footer') ?>
