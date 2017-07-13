<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "social_options".
 *
 * @property integer $id
 * @property integer $social_id
 * @property string $value
 * @property integer $status
 *
 * @property SocialNetworks $social
 */
class SocialOptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'social_options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['social_id', 'value', 'status'], 'required'],
            [['social_id', 'status'], 'integer'],
            [['value'], 'string', 'max' => 200],
            [['social_id'], 'exist', 'skipOnError' => true, 'targetClass' => SocialNetworks::className(), 'targetAttribute' => ['social_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'social.name' => Yii::t('app', 'نام شبکه اجتماعی'),
            'value' => Yii::t('app', 'لینک شبکه اجتماعی'),
            'status' => Yii::t('app', 'وضعیت'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSocial()
    {
        return $this->hasOne(SocialNetworks::className(), ['id' => 'social_id']);
    }
}
