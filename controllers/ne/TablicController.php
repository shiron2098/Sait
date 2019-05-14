<?php
namespace app\controllers;


use app\controllers\AutController;
use app\models\Users;
use app\models\Yifraem;
use Psr\Log\InvalidArgumentException;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class TablicController extends AutController
{
    public function actionIndex()
    {

        $this->render('Tab1');

    }

    public function actionBazDan($dan1, $dan2, $dan3, $userid)
    {
        if (!empty ($dan1) && ($dan2) && ($dan3) && ($userid))
            $taska = Yifraem::find()
                ->where(['userid' => $userid])
                ->one();
        if (!$taska) {
            $newlogin = new Yifraem();
            $newlogin->time = date('H:i:s');
            $newlogin->date = date('d.m.Y');
            $newlogin->name = $dan1;
            $newlogin->email = $dan2;
            $newlogin->password = $dan3;
            $newlogin->userid = $userid;
            if (!$newlogin->save()) {
                print_r($newlogin->errors);
                exit();
            }
            $task = Users::find()->
            where('id=:id', [':id' => $userid])->one()->getYifraems()->all();
            return $this->render('Tab', [
                'lol' => $task
            ]);
        }
        if ($taska) {
            $task = Users::find()->
            where('id=:id', [':id' => $userid])->one()->getYifraems()->all();

            if (!$task) {
                throw new InvalidArgumentException('no user');
            }
            foreach ($task as $taske) {
                if ($dan1 === $taske['name'] || $dan2 === $taske['email']) {
                    return $this->render('Tab', [
                        'lol' => $task
                    ]);
                    break;
                }
            }

            if ($dan1 !== $taske['name'] || $dan2 !== $taske['email']) {
                $newlogin = new Yifraem();
                $newlogin->time = date('H:i:s');
                $newlogin->date = date('d.m.Y');
                $newlogin->name = $dan1;
                $newlogin->email = $dan2;
                $newlogin->password = $dan3;
                $newlogin->userid = $userid;
                if (!$newlogin->save()) {
                    print_r($newlogin->errors);
                    exit();
                }
                $task = Users::find()->
                where('id=:id', [':id' => $userid])->one()->getYifraems()->all();
                foreach ($task as $taske) {
                    return $this->render('Tab', [
                        'lol' => $task
                    ]);
                }

            } else {
                $task = Users::find()->
                where('id=:id', [':id' => $userid])->one()->getYifraems()->all();
                $this->render('Tab', [
                    'lol' => $task
                ]);
            }
        }
    }
}

            /*    $task = Auti::find()->
                where('id=:id', [':id' => $userid])->one()->getYifraems()->all();

                if (!$task) {
                    throw new InvalidArgumentException('no user');
                }
                foreach ($task as $taske) {
                    if ($dan1 === $taske['name'] || $dan2 === $taske['email']) {
                        return $this->render('Tab', [
                            'lol' => $task
                        ]);
                        break;
                    }
                }
                if ($dan1 !== $taske['name'] || $dan2 !== $taske['email']) {
                        $newlogin = new Yifraem();
                        $newlogin->time = date('H:i:s');
                        $newlogin->date = date('d.m.Y');
                        $newlogin->name = $dan1;
                        $newlogin->email = $dan2;
                        $newlogin->password = $dan3;
                        $newlogin->userid = $userid;
                        if(!$newlogin->save()){
                        print_r($newlogin->errors);
                        exit();
                    }
                    $task = Auti::find()->
                    where('id=:id', [':id' => $userid])->one()->getYifraems()->all();
                    foreach ($task as $taske) {
                        return $this->render('Tab', [
                            'lol' => $task
                        ]);
                    }
                }
                }*/














            <div class="site-index">
    <div class="body-content">
        <div class="row">
           <?$userid = $_SESSION['id'];?>

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
                <?foreach($lol as $user){?>
                  <tr>
                      <td><?=$user['id']?></td>
                      <td><?=$user['time']?></td>
                      <td><?=$user['date']?></td>
                      <td><?=$user['name']?></td>
                      <td><?=$user['email']?></td>
                      <td><?=$user['password']?></td>
                      <td><?=$user['userid']?></td>
                      <td><a href="/tablic2/update?id=<?=$user['id']?>" class="btn btn-info">update</a></td>
                      <td><a href="/tablic2/delete?id=<?=$user['id']?>" class="btn btn-warning">delete</a></td>
                      <td><input type="checkbox" name="customer_id[]" class="delete_costumer" value="<?php echo$user['id'];?>"></td>
                      <?}?>
                  </tr>
              </table>
            </div>
        </div>

    </div>
</div>
