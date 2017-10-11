<?php

use yii\helpers\Html;
//use yii\grid\GridView;

//use kartik\grid\GridView;
 use app\modules\kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Products'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'panel'=>[
            'before'=>' '
        ],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=>'รูปภาพ',                                           //title
                'format' => ['image',['width'=>'100','height'=>'100']],         //Set width,height
                'value' => function($model){
                    return $model->getImageUrl();                               //Get function in product model
                }
            ],
            'name',
            'detail:ntext',
            'photo',
            'types.name',

            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
