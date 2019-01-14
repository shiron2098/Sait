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
<?= $form->field($model, 'email')->label('Эмейл') ?>

    <div class="form-group">
        <?= Html::submitButton('login', ['class' => 'btn btn-primary']) ?>
        <a href="/aut/index" class="btn btn-danger">back</a>
    </div>

<?php ActiveForm::end(); ?>