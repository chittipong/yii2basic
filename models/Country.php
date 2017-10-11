<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "country".
 *
 * @property integer $id
 * @property string $country
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
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
                $dropdown[$model->id]=$model->country;
            }
            
            return $dropdown;
        }
    }//end***
}
