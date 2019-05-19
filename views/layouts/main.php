<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage()?>
<?php /*if$id = Yii::$app->user->identity->id*/?>


<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' =>  [
            Yii::$app->user->isGuest ?

                ['label' => 'User Login', 'items' => [

                    ['label' => 'Create an Account', 'url' => '/aut/create-new-user'],
                    ['label' => 'Sign In', 'url' => '/aut/index'],

                ]] :
                /*['label' => 'Home', 'url' => '/tablic2/home'],*/
                ['label' => 'Welcome ('. Yii::$app->user->identity->login . ')','items' => [

                    '<li role="presentation" class="divider"></li>',

                    ['label' => 'Account Settings'],
                    ['label' => 'Home', 'url' => ['/tablic2/home']],
                    ['label' => 'About', 'url' => ['/aut/about']],
                    ['label' => 'Contact', 'url' => ['/aut/contact']],
                    ['label' => 'Settings', 'url' => ['/settings-users/index']],

                    '<li role="presentation" class="divider"></li>',

                    ['label' => 'Logout', 'url' => '/aut/logout'],

                ]]

        ]
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>



<!--Yii::$app->user->isGuest ? (
['label' => 'Login', 'url' => ['/aut/index']]
) : (
'<li>'
    . Html::beginForm(['/aut/logout'], 'post')
    . Html::submitButton(
    'Logout (' . Yii::$app->user->identity->login . ')',
    ['class' => 'btn btn-link logout']
    )
    . Html::endForm()
    . '</li>'
)-->