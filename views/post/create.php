<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
<?php $form=ActiveForm::begin() ?>
<?php echo $form->field($model,'title')->textInput() ?>
<?php echo $form->field($model,'content')->textarea() ?>

<div class="form-group">
    <?php echo Html::submitButton('ส่งข้อมูล',['class'=>'btn btn-primary']) ?>
</div>
<?php ActiveForm::end() ?>