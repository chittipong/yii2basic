<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form=ActiveForm::begin(); ?>
<div class="form-group">
<div class="col-lg-offset-2 col-lg-10">
<?= Html::submitButton('Reset',['class'=>'btn btn-primary']) ?>
</div>
</div>

<?php ActiveForm::end(); ?>