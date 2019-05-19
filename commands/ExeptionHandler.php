<?php



function ExeptionHandler($Handler){
    try {
        $model = new exception($Handler);
    } catch (exception $e) {
        echo $e->getMessage();
    }
}