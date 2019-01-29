<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'login')->label('Имя') ?>
<?= $form->field($model, 'password_hash')->passwordInput()->label('Пароль') ?>
<?= $form->field($model, 'email')->label('Эмейл') ?>
<?= $form->field($model, 'time')->label('Время')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '2019-04-06']]) ?>
    <div class="form-group">
        <?= Html::submitButton('login', ['class' => 'btn btn-primary']) ?>
        <a href="/aut/index" class="btn btn-danger">back</a>
    </div>

<?php ActiveForm::end(); ?>


