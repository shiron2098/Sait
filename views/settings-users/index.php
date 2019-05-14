<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use \kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;
use \kartik\datecontrol\DateControl;
use \yiidreamteam\widgets\timezone\Picker;
use borales\extensions\phoneInput\PhoneInput;
?>
<!--<div class="fileUpload btn btn-warning">
    <span>Update Avatar</span>
    <input type="file" accept="image/*" onchange="loadFile(event)" class="upload"/>
</div>-->
<?php
$accountStatus = array('Мужской'=>'Мужской', 'Женский'=>'Женский');
$form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>
<div class="fileUpload btn btn-warning">
    <?php if($model->ImageName && $model->ImagePath){?>
        <img src="<?=$model->ImagePath . $model->ImageName?>" alt="">
    <?php }?>
    <?= $form->field($model, 'ImagePath')->fileInput()->label('Update Avatar')?>
</div>
<?= $form->field($model, 'Name')->label('Имя')?>
<?= $form->field($model, 'Famiglia')->label('Фамилия') ?>
<?= $form->field($model, 'Nickname')->label('Псевдоним') ?>
<?= $form->field($model, 'DateBrithday')->widget(DateControl::class, [
        'type' => DateControl::FORMAT_DATE,
    'language' => 'ru',
    //'dateFormat' => 'yyyy-MM-dd',

])->label('Дата рождения') ?>
<?= $form->field($model, 'Floor')->radioList($accountStatus)?>
<div class="Checkbox_div_Timezone">
<?= $form->field($model, 'City')->label('Город') ?>
</div>
<div class="Checkbox_div_Timezone">
<?= $form->field($model, 'CityTime')->widget(Picker::className(), [
    'options' => ['class' => 'form-control'],
])?>
</div>
<?=$form->field($model, 'CityCheckboxAutoTimeZone')->checkbox([ 'class'=>'Checkbox-timezone','value' => '1'])->label('Автоматическая выставления таймзоны');?>
<?=$form->field($model, 'Telephone')->widget(PhoneInput::className(), [
'jsOptions' => [
'preferredCountries' => ['no', 'pl', 'ua'],
]
]);?>
        <?= Html::submitButton('Войти', ['class' => 'btn btn-primary']) ?>

<?php ActiveForm::end(); ?>


<!--
--><?php /*= Html::img(Yii::getAlias('@web'). '/' . $model->path . $model->name);*/?>
<?php /*= $form->field($model, 'DateBrithday')->widget(DateTimePicker::className(),[
    'name' => 'dp_1',
    'type' => DateTimePicker::TYPE_INPUT,
    'options' => ['placeholder' => 'Ввод даты/времени...'],
    'convertFormat' => true,
    'value'=> date("d.m.Y",(integer) $model->DateBrithday),
    'pluginOptions' => [
        'format' => 'dd.MM.yyyy',
        'autoclose'=>true,
        'weekStart'=>1, //неделя начинается с понедельника
        'startDate' => '01.05.2015', //самая ранняя возможная дата
        'todayBtn'=>true, //снизу кнопка "сегодня"
    ]
]); */?>

