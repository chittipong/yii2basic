<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php //$form->field($model, 'status')->textInput() ?>
    
    <?=$form->field($model,'status')->dropDownList([
            User::STATUS_DELETED=>$model->getStatus(User::STATUS_DELETED),
            User::STATUS_ACTIVE=>$model->getStatus(User::STATUS_ACTIVE)
        ]); 
    ?>

    <?php // $form->field($model, 'roles')->textInput() ?>
    
    <?=$form->field($model,'roles')->dropDownList([
            User::ROLE_USER=>$model->getRoles(User::ROLE_USER),
            User::ROLE_MANAGER=>$model->getRoles(User::ROLE_MANAGER),
            User::ROLE_ADMIN=>$model->getRoles(User::ROLE_ADMIN)
        ])
    ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
