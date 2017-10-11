<?php
namespace app\models;
use yii\db\ActiveRecord;

class News extends ActiveRecord{
    public static function tableName() {
        return 'news';
    }
    
    public function rules() {
        return[
           ['title','required'],
            ['content','string']
        ];
    }
    
    public function attributeLabels() {
        return[
            'title'=>'ชื่อเรื่อง',
            'content'=>'เนื้อหา'
        ];
    }
}