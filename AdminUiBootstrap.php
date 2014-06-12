<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace yii\adminUi;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\web\Controller;
use yii\base\Event;

class AdminUiBootstrap implements BootstrapInterface{
    public function bootstrap($app){
        \Yii::$classMap = array_merge(\Yii::$classMap,[
                'yii\grid\CheckboxColumn'=>'@yii/adminUi/widget/CheckboxColumn.php',
                'yii\grid\ActionColumn'=>'@yii/adminUi/widget/ActionColumn.php',
            ]);
        $app->set('view', [
            'class'=>'yii\web\View',
            'theme' => [
                'pathMap' => ['@app/views' => '@app/themes/adminui'],   // for Admin theme which resides on extension/adminui
                'baseUrl' => '@web/themes/adminui',
            ],
        ]);
        
        Event::on(Controller::className(), Controller::EVENT_BEFORE_ACTION, function ($event) {
            if($event->action->id == 'login'){
                $event->sender->layout = '//blank';
                //print_r($event);
            }
        });
    }
}