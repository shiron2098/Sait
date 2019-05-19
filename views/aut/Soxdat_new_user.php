<?php

/* @var $this yii\web\View */

?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use kartik\datecontrol\DateControl;
$this->title = 'Регистрация нового пользователя';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'login')->label('Имя') ?>
<?= $form->field($model, 'password_hash')->passwordInput()->label('Пароль') ?>
<?= $form->field($model, 'email')->label('Эмейл') ?>
    <div class="form-group">
        <?= Html::submitButton('Создать', ['class' => 'btn btn-primary']) ?>
        <a href="/aut/index" class="btn btn-danger">Назад</a>
    </div>
<?php ActiveForm::end(); ?>


<!--$form->field($model, 'time')->label('Время')->widget(DatePicker::className(), ['clientOptions' => ['defaultDate' => '2019-04-06']])-->