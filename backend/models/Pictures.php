<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "pictures".
 *
 * @property integer $id
 * @property string $src
 * @property integer $user_id
 * @property integer $agahi_id
 * @property integer $date
 */
class Pictures extends \yii\db\ActiveRecord
{
    public $file;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'pictures';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['date'],
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
            [['src', 'user_id'], 'required'],
            // [['src'], 'string'],
            [['user_id', 'agahi_id', 'date'], 'integer'],
            [['file'], 'file', 'maxFiles' => 5], // <--- here!
            [['file'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'src' => Yii::t('app', 'Src'),
            'user_id' => Yii::t('app', 'User ID'),
            'agahi_id' => Yii::t('app', 'Agahi ID'),
            'date' => Yii::t('app', 'Date'),
        ];
    }

}
