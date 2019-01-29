<?php
namespace app\Components;

use yii\base\widget;

class FirstWidget extends widget{

    public $a;
    public $b;

    public function init(){
        parent::init();
        if($this->a === null){
            $this->a=0;
        }
        if($this->b === null){
            $this->b = 0;
            }
        }
    public function run(){
        $c=$this->a + $this->b;
        return $this->render('first',[
            'c' => $c
            ]
        );
    }
}

