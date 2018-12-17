<?php
namespace app\controllers;


use app\controllers\AutController;
use app\models\Auti;
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
            $task = Auti::find()->
            where('id=:id', [':id' => $userid])->one()->getYifraems()->all();
            return $this->render('Tab', [
                'lol' => $task
            ]);
        }
        if ($taska) {
            $task = Auti::find()->
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
                $task = Auti::find()->
                where('id=:id', [':id' => $userid])->one()->getYifraems()->all();
                foreach ($task as $taske) {
                    return $this->render('Tab', [
                        'lol' => $task
                    ]);
                }

            } else {
                $task = Auti::find()->
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