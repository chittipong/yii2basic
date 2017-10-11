<?php
use yii\helpers\Html;
use yii\widgets\DetailView;

$this->title=$model->title;
?>
<h1><?=$model->title?></h1>
<hr/>
<?=DetailView::widget([
   'model'=>$model,
    'attributes'=>[
        'title',
        'content:ntext'
    ]
]);
?>

<?=Html::a('back','index',['class'=>'btn btn-default']);?>