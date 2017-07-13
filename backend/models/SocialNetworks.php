<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "social_networks".
 *
 * @property integer $id
 * @property string $name
 *
 * @property SocialOptions[] $socialOptions
 */
class SocialNetworks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_networks';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 155],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocialOptions()
    {
        return $this->hasMany(SocialOptions::className(), ['social_id' => 'id']);
    }
}
