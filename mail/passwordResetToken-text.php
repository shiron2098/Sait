<?php

/* @var $this yii\web\View */
/* @var $users app\models\Users */
$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['aut/reset-password','token' => $users->acess_token]);
?>

    Hello <?= $users->login ?>,
    Follow the link below to reset your password:

<?= $resetLink ?>