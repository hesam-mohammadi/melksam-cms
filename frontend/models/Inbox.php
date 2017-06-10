<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
/**
 * This is the model class for table "inbox".
 *
 * @property integer $id
 * @property string $name
 * @property string $section
 * @property integer $property_id
 * @property string $message
 * @property integer $phone_number
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

    public function behaviors()
    {
        return [
          'timestamp' => [
              'class' => TimestampBehavior::className(),
              'attributes' => [
                  ActiveRecord::EVENT_BEFORE_INSERT => 'created_at',
                  // ActiveRecord::EVENT_BEFORE_UPDATE => '',
              ],
              'value' => function() { return date('U'); },
          ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'message', 'phone_number'], 'required'],
            [['property_id', 'phone_number', 'created_at', 'status'], 'integer'],
            [['message'], 'string'],
            [['name'], 'string', 'max' => 200],
            [['section'], 'string', 'max' => 100],
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
            'name' => Yii::t('app', 'نام'),
            'section' => Yii::t('app', 'Section'),
            'property_id' => Yii::t('app', 'Property ID'),
            'message' => Yii::t('app', 'متن پیام'),
            'phone_number' => Yii::t('app', 'شماره تماس'),
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
