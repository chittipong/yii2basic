<?php
namespace app\controllers;
use yii\web\Controller;
use app\models\Post;

class PostController extends Controller{
    public function actionIndex(){
        return $this->render('index');
    }
    public function actionCreate(){
        $model= new Post();
        
        $postData=\Yii::$app->request->post();
        if($model->load($postData) && $model->validate()){
            return $this->render('view',['model'=>$model]);
        }else{
            return $this->render('create',['model'=>$model]);
        }
    }
}

