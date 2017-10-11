<?php
namespace app\controllers;

use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\News;
use yii\web\NotFoundHttpException;
use Yii;

use yii\web\ForbiddenHttpException;

//Link ส่วนที่เกี่ยวข้อเข้ามา************
use app\models\User;
use yii\filters\AccessControl;
use app\component\AccessRule;
use yii\filters\VerbFilter;

class NewsController extends Controller{
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                'ruleConfig'=>[
//                  'class'=>AccessRule::className(),  
//                ],
//                'only' => ['create', 'update', 'delete'],
//                'rules' => [
//                    [
//                        //กำหนด User ที่สามารถทำการ Create ได้
//                        'actions' => ['create'],
//                        'allow' => true,
//                        'roles' => [
//                            User::ROLE_MANAGER,
//                            User::ROLE_ADMIN,
//                        ],
//                    ],
//                    [
//                        //กำหนดสิทธิ์ User ที่สามารถ Update ได้
//                        'actions' => ['update'],
//                        'allow' => true,
//                        'roles' => [
//                            User::ROLE_ADMIN,
//                            User::ROLE_MANAGER,
//                        ],
//                    ],
//                    [
//                        //กำหนดสิทธิ์ User ที่สามารถ Delete ได้
//                        'actions' => ['delete'],
//                        'allow' => true,
//                        'roles' => [
//                            USER::ROLE_ADMIN,
//                        ],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }//end**
    
    public function actionIndex(){
        $query=News::find();
        $data=new ActiveDataProvider([
            'query'=>$query,
        ]);
        return $this->render('index',['data'=>$data]);
    }
    
    //CREATE--------------------------
    public function actionCreate(){
        if(Yii::$app->user->can('create-news')){
            $model=new News();

            $data=\Yii::$app->request->post();                                      //รับข้อมูลจากฟอร์ม

            if($model->load($data) && $model->save()){                              //บันทึกลงฐานข้อมูล
                return $this->redirect(['view','id'=>$model->id]);                  //ถ้าบันทึกเรียบร้อยให้ redirect ไป view และส่ง id ไปด้วย
            }else{
                return $this->render('create',['model'=>$model]);
            }

            return $this->render('create',['model'=>$model]);
        }else{
            throw new ForbiddenHttpException("ขออภัย! คุณไม่มีสิทธิ์เข้าถึงระบบนี้");
        }
    }
    
    //UPDATE-----------------------------
    public function actionUpdate($id){
        if(Yii::$app->user->can('update-news')){
            $model=$this->findModel($id);
            $data=\Yii::$app->request->post();

            if($model->load($data) && $model->save()){
                return $this->redirect(['view','id'=>$model->id]);
            }else{
                return $this->render('update',['model'=>$model]);
            }
        }else{
            throw new ForbiddenHttpException("ขออภัย! คุณไม่มีสิทธิ์เข้าถึงระบบนี้");
        }
    }
    
    
    //VIEW---------------------------
    public function actionView($id){
        $model=new News();
        return $this->render('view',['model'=>$this->findModel($id)]);
    }
    
    
    //LIST---------------------------
    public function actionList(){
        $model=new News();
        return $this->render('list',['model'=>$model]);
    }
    
    //DELETE-------------------------
    public function actionDelete($id){
        if(Yii::$app->user->can('del-news')){
            $this->findModel($id)->delete();
            return $this->redirect('index');
        }else{
            throw new ForbiddenHttpException("ขออภัย! คุณไม่มีสิทธิ์เข้าถึงระบบนี้");
        }
    }
    
    
    //ดักจับข้อมูลด้วยคลาส NotFoundHttpException------------
    protected function findModel($id){
        if(($model=News::findOne($id))!=null){
            return $model;
        }else{
            throw new NotFoundHttpException('ไม่พบข้อมูลที่ต้องการ');
        }
    }
}