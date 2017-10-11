<?php

namespace app\controllers;

use Yii;
use app\models\Food;
use app\models\FoodSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Country;
use app\models\Province;
use app\models\City;

/**
 * FoodController implements the CRUD actions for Food model.
 */
class FoodController extends Controller
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
     * Lists all Food models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FoodSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Food model.
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
     * Creates a new Food model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Food();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Food model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Food model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    //List Province====================================
    public function actionList_province($id){
        //count---------------
        $count=  Province::find()->where(['country_id'=>$id])->count();
        $province=  Province::find()->where(['country_id'=>$id])->orderBy('id DESC')->all();

        if($count > 0){
            foreach($province as $result) echo "<option value='".$result->id."'>".$result->province."</option>";
        }else{
            echo "<option>-</option>";
        }
    }
    
    //List City====================================
    public function actionList_city($id){
        //count---------------
        $count=  City::find()->where(['province_id'=>$id])->count();
        $city=  City::find()->where(['province_id'=>$id])->orderBy('id DESC')->all();

        if($count > 0){
            foreach($city as $result) echo "<option value='".$result->id."'>".$result->city."</option>";
        }else{
            echo "<option>-</option>";
        }
    }

    /**
     * Finds the Food model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Food the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Food::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
