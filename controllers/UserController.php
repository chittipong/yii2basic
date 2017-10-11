<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        if(Yii::$app->user->can('create-user')){
            $searchModel = new UserSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }else{
            throw new ForbiddenHttpException("ขออภัย! คุณไม่มีสิทธิ์เข้าถึงระบบนี้");
        }
    }

    public function actionChange_password(){
        $user=Yii::$app->user->identity;
        $loadedPost=$user->load(Yii::$app->request->post());

        //Validate for normal request-------------
        if($loadedPost && $user->validate()){
            $user->password=$user->newPassword;

            //Save, Set Message, and Refresh page---------------
            $user->save(false);

            Yii::$app->session->setFlash('success','You have successfully change your password');
            return $this->refresh();
        }

        return $this->render("change_password",[
            'user'=>$user,
        ]);
    }

    public function actionReset_password(){
        $user=Yii::$app->user->identity;
        $loadedPost=$user->load(Yii::$app->request->post());

        if($loadedPost && $user->validate()){  //Code Error ตรง validate() 
            $user->password='999999';           //New password
            //$user->setPassword($user->password);
            $user->save(false);

            Yii::$app->session->setFlash('seccess','You have successfully changed your password.');
            return $this->refresh();
        }

        return $this->render("reset_password",[
            'user'=>$user,
        ]);
    }

   /* public function actionShow_password(){
        $user=Yii::$app->user->identity;
        //$chk= Yii::$app->security->validatePassword('zodiac', $user->password_hash);
        //$chk=$user->validatePassword('zodiac');
        $dbpassword=$user->password_hash;
        $chk= Yii::$app->security

        //echo $user->username;
        //echo "<br/>";
        //echo $chk;
        //echo Yii::$app->security->('zodiac', $user->password_hash);
       // echo $dbpassword;
    }*/


    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('create-user')){
           // $model = new User();
            //$model->scenarios='register';

            $user = new User(['scenario' => 'signup']);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            throw new ForbiddenHttpException("ขออภัย! คุณไม่มีสิทธิ์เข้าถึงระบบนี้");
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        if(Yii::$app->user->can('update-user')){
            $model = $this->findModel($id);

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }else{
            throw new ForbiddenHttpException("ขออภัย! คุณไม่มีสิทธิ์เข้าถึงระบบนี้");
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        if(Yii::$app->user->can('del-user')){
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }else{
            throw new ForbiddenHttpException("ขออภัย! คุณไม่มีสิทธิ์เข้าถึงระบบนี้");
        }
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
