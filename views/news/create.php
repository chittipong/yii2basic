<?php
use yii\helpers\html;
use yii\widgets\ActiveForm;
?>
<?php $form=ActiveForm::begin() ?>
<?=$form->field($model,'title')?>
<?=$form->field($model,'content')->textarea()?>
<div class="form-group">
    <?=Html::submitButton('บันทึกข้อมูล',['class'=>'btn btn-success'])?>
</div>
<?php ActiveForm::end() ?>