<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "inbox".
 *
 * @property integer $id
 * @property string $name
 * @property string $section
 * @property integer $property_id
 * @property string $message
 * @property string $phone_number
 * @property integer $created_at
 * @property integer $status
 *
 * @property Property $property
 */
class Inbox extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inbox';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'section', 'property_id', 'message', 'phone_number', 'created_at', 'status'], 'required'],
            [['property_id', 'created_at', 'status'], 'integer'],
            [['message'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['section'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 15],
            [['property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['property_id' => 'id']],
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
            'section' => Yii::t('app', 'Section'),
            'property_id' => Yii::t('app', 'Property ID'),
            'message' => Yii::t('app', 'Message'),
            'phone_number' => Yii::t('app', 'Phone Number'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'property_id']);
    }
}
