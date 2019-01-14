<?php

use yii\helpers\Html;
/* @var $this yii\web\View */
/* @var $users app\models\Users */
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['aut/reset-password','token' => $users->acess_token]);
?>


<div class="password-reset">
    <p>Hello <?= Html::encode($users->login) ?>,</p>
    <p>Follow the link below to reset your password:</p>
    <p><?=(Html::encode($resetLink)) ?></p>
</div>