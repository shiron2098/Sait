<?php
namespace app\controllers;

use yii\web\controller;

class CartController extends Controller {

     public function actionIndex()
     {
         $cart->plus($product->id, $quantity);
     }
}