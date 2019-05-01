<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Восстановления Пароля';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-request-password-reset">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Пожалуйста введите Эмейл что бы восстановить пароль</p>
    <div class="row">
        <div class="col-lg-5">

            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
            <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>
            <div class="form-group">
                <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary']) ?>
                <a href="/aut/index" class="btn btn-danger">Назад</a>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>