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
use dosamigos\fileupload\FileUploadUI;
use \kato\DropZone;
use limion\jqueryfileupload\JQueryFileUpload;
?>
<?php  echo DropZone::widget([
    'options' => [
        'maxFilesize' => '2',
    ],
    'clientEvents' => [
        'complete' => "function(file){console.log(file)}",
        'removedfile' => "function(file){alert(file.name + ' is removed')}"
    ],
]);
?>