<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $detail
 * @property string $photo
 * @property integer $types_id
 *
 * @property Types $types
 */
class Products extends \yii\db\ActiveRecord
{
    public $file;           //for upload file
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['detail'], 'string'],
            [['types_id'], 'required'],
            [['types_id'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['photo'], 'string', 'max' => 50],
            
            //สำหรับอัพโหลดไฟล์---------------
            [['file'],'safe'],
            [['file'],'file','extensions'=>'jpg,png,gif']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัสสินค้า'),
            'name' => Yii::t('app', 'ชื่อสินค้า'),
            'detail' => Yii::t('app', 'รายละเอียด'),
            'file' => Yii::t('app', 'รูปสินค้า'),              //เปลี่ยนจาก photo เป็น file
            'types_id' => Yii::t('app', 'ประเภทสินค้า'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypes()
    {
        return $this->hasOne(Types::className(), ['id' => 'types_id']);
    }
    
    public function getTypeList(){
        $list=Types::find()->orderBy('id')->all();
        return ArrayHelper::map($list,'id','name');
    }
    
    public function getImageUrl(){
        return Url::to(Yii::$app->request->BaseUrl.'/'.$this->photo);
    }
}
