<?php

namespace app\controllers\Secure;


use yii\web\Controller;
use yii;

class SecureController extends Controller
{
    function __construct($id,$module)
    {
        parent::__construct($id, $module);
        if(Yii::$app->user->IsGuest){
               $this->redirect('aut/login');
        }
    }

    /**
     * @return \app\models\Users
     */
    public function ActionLoginName(){
        Yii::$app->user->identity;
    }

}