<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'name') ?>
<?= $form->field($model, 'email') ?>
<?= $form->field($model, 'password') ?>

    <div class="form-group">
        <?= Html::submitButton('Create Task', ['class' => 'btn btn-primary']) ?>
        <a href="/tablic2/home/" class="btn btn-danger">Back</a>
    </div>

<?php ActiveForm::end(); ?>