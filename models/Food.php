<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "food".
 *
 * @property integer $id
 * @property integer $country_id
 * @property integer $province_id
 * @property integer $city_id
 * @property string $food_name
 */
class Food extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'food';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country_id', 'province_id', 'city_id'], 'integer'],
            [['food_name'], 'string', 'max' => 50]
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
            'city_id' => 'City ID',
            'food_name' => 'Food Name',
        ];
    }
}
