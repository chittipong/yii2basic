<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Country;
use app\models\Province;
use app\models\City;

use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Food */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="food-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'country_id')->textInput() ?>
    <?php // $form->field($model, 'country_id')->dropDownList(Country::dropdown(),['style'=>'width:300px']); ?>
    
    <?= $form->field($model, 'country_id')->dropDownList(Country::dropdown(),
        [
            'style'=>'width:300px',
            'prompt'=>'--Countries--',
            'onchange'=>'$.get( "'.Yii::$app->urlManager->createUrl(['food/list_province']).'", { id: $(this).val() } )
                   .done(function( data ){
                      $("select#food-province_id").html( data );
                   });
            ']);
    ?>

    <?= $form->field($model, 'province_id')->dropDownList(Province::dropdown(),
        [
            'style'=>'width:300px',
            'prompt'=>'--Countries--',
            'onchange'=>'$.get( "'.Yii::$app->urlManager->createUrl(['food/list_city']).'", { id: $(this).val() } )
                   .done(function( data ){
                      $("select#food-city_id").html( data );
                   });
            ']);
    ?>

    <?php // $form->field($model, 'city_id')->textInput() ?>
    <?= $form->field($model, 'city_id')->dropDownList(City::dropdown(),['style'=>'width:300px']); ?>

    <?= $form->field($model, 'food_name')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
