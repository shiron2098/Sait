<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'login')->label('Имя') ?>
<?= $form->field($model, 'password_hash')->passwordInput()->label('Пароль') ?>
<?= $form->field($model, 'rememberMe')->checkbox([
    'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
]) ?>
    <div>
        Что бы востановить пароль нажми <?= Html::a('Жмякай', ['aut/request-password-reset']) ?>.
    </div>
    <div class="form-group">
        <?= Html::submitButton('login', ['class' => 'btn btn-primary']) ?>
        <a href="/aut/create-new-user/" class="btn btn-info">Create New User</a>
    </div>

<?php ActiveForm::end(); ?>