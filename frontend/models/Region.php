<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "region".
 *
 * @property integer $id
 * @property integer $city_id
 * @property string $name
 *
 * @property Property[] $properties
 */
class Region extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'region';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['city_id', 'name'], 'required'],
            [['city_id'], 'integer'],
            [['name'], 'string', 'max' => 75],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'city_id' => Yii::t('app', 'City ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['region_id' => 'id']);
    }
}
