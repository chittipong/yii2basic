<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property integer $country_id
 * @property integer $province_id
 * @property string $city
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'province_id'], 'integer'],
            [['city'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country_id' => 'Country ID',
            'province_id' => 'Province ID',
            'city' => 'City',
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
                $dropdown[$model->id]=$model->city;
            }
            
            return $dropdown;
        }
    }//end***
}
