<?php
use yii\helpers\Html;
use yii\grid\GridView;

$this->title='การสร้างบทความ';
?>
<div class="page-header">
    <h1><?php echo $this->title ?></h1>
</div>

<?= GridView::widget([
    'dataProvider'=>$data,
    'tableOptions'=>[                               //กำหนดรูปแบบตารางได้ด้วย bootstrap *จะไม่ใส่ก็ได้
        'class'=>'table table-hover'
    ],
    'layout'=>"{items}\n{pager}",                   //ตัดสรุป summary ออก (ที่แสดงว่าข้อมูลมีกี่ Record ตอนนี้อยู่ที่หน้าใหน) *จะไม่ใส่ก็ได้
    'columns'=>[
        'id',
        'title',
        'content:ntext',
        ['class'=>'yii\grid\ActionColumn']          //เพิ่มปุ่ม view,edit,delete
    ],
]);
?>
<?=Html::a('สร้างบทความ','news/create',['class'=>'btn btn-primary']); ?>
<?= Html::a(Yii::t('app', 'Create'), ['create'], ['class' => 'btn btn-success']) ?>