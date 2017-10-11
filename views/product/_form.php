<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;

use mihaildev\ckeditor\CKEditor;


/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="products-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); //Set Option for upload ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'detail')->textarea(['rows' => 6]) ?>
    
    <!--Call TinyMCE Text Editor -->
    <?php /*  $form->field($model, 'detail')->widget(letyii\tinymce\Tinymce::className(), [
    'options' => [
        'class' => 'your_class',
    ],
            'configs' => [ // Read more: http://www.tinymce.com/wiki.php/Configuration
                //'toolbar'=>[ 'undo redo | styleselect | bold italic | link image'],       //Customize Toolbar
                'link_list' => [
                    [
                        'title' => 'My page 1',
                        'value' => 'http://www.tinymce.com',
                    ],
                    [
                        'title' => 'My page 2',
                        'value' => 'http://www.tinymce.com',
                    ],
                ],
            ],
        ]);*/
    ?>
    
    <!--==========Call CKE Editor================-->
    <?= $form->field($model, 'detail')->widget(CKEditor::className(),[
            'editorOptions' => [
                'preset' => 'full', //basic, standard, full
                'inline' => false, 
            ],
        ]);
    ?>

    <?= $form->field($model, 'types_id')->dropDownList($model->getTypeList()) ?>
    
    <?= $form->field($model, 'file')->fileInput() ?>
    
    <!-- ตรวจสอบว่ามีรูปภาพหรือไม่ถ้ามีให้ดึงออกมาโชว์และมีปุ่ม delete -->
    <?php if($model->photo): ?>
    <?= Html::img(Url::to(Yii::$app->request->BaseUrl.'/'.$model->photo),['class'=>'thumbnail']) //แสดงรูปภาพ ?>
    <?= Html::a(
            '<i class="glyphicon glyphicon-trash"></i>',
            ['deleteimage','id'=>$model->id,'field'=>'photo'],
            ['class'=>'btn btn-danger']
        )//แสดงปุ่ม delete
    ?>
    <?php endif; ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
