<div class="site-index">
    <div class="body-content">
        <div class="row">
            <div class="col-lg-12">
                <a href="/tablic2/index/" class="btn btn-primary">Create new task</a>
                <button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger">Delete</button>
                <table border="1" id="tablic1">
                    <tr>
                        <td>id</td>
                        <td>time</td>
                        <td>date</td>
                        <td>name</td>
                        <td>email</td>
                        <td>password</td>
                        <td>userid</td>
                    </tr>
                    <?php foreach($lol as $user) {?>
                    <tr>
                        <td><?=$user->id?></td>
                        <td><?=$user->time?></td>
                        <td><?=$user->date?></td>
                        <td><?=$user->name?></td>
                        <td><?=$user->email?></td>
                        <td><?=$user->password?></td>
                        <td><?=$user->userid?></td>
                        <td><a href="/tablic2/update?id=<?=$user->id?>" class="btn btn-info">update</a></td>
                        <td><a href="/tablic2/delete?id=<?=$user->id?>" class="btn btn-warning">delete</a></td>
                        <td><input type="checkbox" name="customer_id[]" class="delete_costumer" value="<?php echo$user->id;?>"></td>
                        <?php }?>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>