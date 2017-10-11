<?php

namespace app\controllers;

use Yii;
use app\models\Products;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\ForbiddenHttpException;

use yii\web\UploadedFile;       //สำหรับอัพโหลดไฟล์

/**
 * ProductController implements the CRUD actions for Products model.
 */
class ProductController extends Controller
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
     * Lists all Products models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionEdit() {
        return "aaaaaaaa";
        exit();
    $model = new Products; // your model can be loaded here
    
    // Check if there is an Editable ajax request
    if (isset($_POST['hasEditable'])) {
        // use Yii's response format to encode output as JSON
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        
        // read your posted model attributes
        if ($model->load($_POST)) {
            // read or convert your posted information
            $value = $model->name;
            
            // return JSON encoded output in the below format
            return ['output'=>$value, 'message'=>''];
            
            // alternatively you can return a validation error
            // return ['output'=>'', 'message'=>'Validation error'];
        }
        // else if nothing to do always return an empty JSON encoded output
        else {
            return ['output'=>'', 'message'=>''];
        }
    }
    
    // Else return to rendering a normal view
    return $this->render('view', ['model'=>$model]);
}//End***

    /**
     * Displays a single Products model.
     * @param integer $id
     * @param integer $types_id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if(Yii::$app->user->can('create-product')){
            $model = new Products();

            if ($model->load(Yii::$app->request->post())) {
                $model->file=  UploadedFile::getInstance($model, 'file');
                $upload='';

                //UPLOAD FILE----------------------
                if($model->file){
                    $imgPath='uploads/products/';                       //Set Path
                    $model->photo=$imgPath.$model->file->name;          //Upload
                    $upload=1;
                }

                if($model->save()){
                    if($upload){
                        $model->file->saveAs($model->photo);
                    }
                    return $this->redirect(['view','id'=>$model->id]);      //redirect
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }else{
            throw new ForbiddenHttpException;
        }
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @param integer $types_id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

       if ($model->load(Yii::$app->request->post())) {
            $model->file=  UploadedFile::getInstance($model, 'file');
            $upload='';
            
            //UPLOAD FILE----------------------
            if($model->file){
                $imgPath='uploads/products/';                       //Set Path
                $model->photo=$imgPath.$model->file->name;          //Upload
                $upload=1;
            }
            
            if($model->save()){
                if($upload){
                    $model->file->saveAs($model->photo);
                }
                return $this->redirect(['view','id'=>$model->id]);      //redirect
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionDeleteimage($id,$field){
        $img=$this->findModel($id)->$field;
        if($img){
            if(!unlink($img)){
                return false;
            }
        }
        
        $img=$this->findModel($id);
        $img->$field=null;
        $img->update();
        
        return $this->redirect(['update','id'=>$id]);
    }//end
    
    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param integer $types_id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @param integer $types_id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
