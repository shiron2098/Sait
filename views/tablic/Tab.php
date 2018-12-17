<div class="site-index">
    <div class="body-content">
        <div class="row">
           <?$userid = $_SESSION['id'];?>
            <div class="col-lg-12">
                <form action="/tablic/baz-dan">
                    <input id="are" name="dan1" type="text" autocomplete="off">
                    <input id="are2" name="dan2" type="text" autocomplete="off">
                    <input id="are3" name="dan3" type="text" autocomplete="off">
                    <input id="are4" name="userid" type="hidden" value="<?=$userid?>">
                    <button type="submit" id="are3">pert</button>
                </form>
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
                  <?foreach($lol as $user)  {?>
                  <tr>
                      <td><?=$user['id'];?></td>
                      <td><?=$user['time']?></td>
                      <td><?=$user['date']?></td>
                      <td><?=$user['name']?></td>
                      <td><?=$user['email']?></td>
                      <td><?=$user['password']?></td>
                      <td><?=$user['userid']?></td>
                  </tr>
                  <?}?>
              </table>
            </div>
        </div>

    </div>
</div>
