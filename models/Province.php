<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "province".
 *
 * @property integer $id
 * @property string $province
 */
class Province extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'province';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id'], 'Integer'],
            [['province'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id'=>'Country ID',
            'province' => 'Province',
        ];
    }
    
    //function for list dropdown----------------
    public static function dropdown(){
        //get and cache data
        static $dropdown;
        if($dropdown==null){
            //get all records from database and generate
            $models=static::find()->all();
            foreach($models as $model){
                $dropdown[$model->id]=$model->province;
            }
            
            return $dropdown;
        }
    }//end***
}
