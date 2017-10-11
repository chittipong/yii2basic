<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use kartik\editable\Editable;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id, 'types_id' => $model->types_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id, 'types_id' => $model->types_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php
        echo Editable::widget([
            'name'=>'name', 
            'asPopover' => true,
            'value' => $model->name,
            'header' => 'Name',
            'format' => 'button',
            'size'=>'md',
            'options' => ['class'=>'form-control', 'placeholder'=>'Enter person name...'],
            'pluginOptions'=>[
                'url' => Url::to(['/product/edit'])
            ]
        ]);
   ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            //'id',
            //DISPLAY IMAGE--------------------
            [
              'attribute'=>'photo',
              'value'=>Yii::$app->request->BaseUrl.'/'.$model->photo,
              'format'=>['image',['width'=>'100']]                      //Set Image Width
            ],
            'name',
            'detail:ntext',
            'photo',
            'types_id',
        ],
    ]) ?>

</div>
