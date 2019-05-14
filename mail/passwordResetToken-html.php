<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $users app\models\Users */
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['aut/reset-password','token' => $users->acess_token]);
?>


<div class="password-reset">
    <p>Здравствуйте,<?= Html::encode($users->login) ?>,</p>
    <p>Что бы восстановить пароль нажмите на сылку</p>
    <p><?=(Html::encode($resetLink)) ?></p>
</div>