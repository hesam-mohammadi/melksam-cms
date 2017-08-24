<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property string $option_id
 * @property string $option_name
 * @property string $option_value
 * @property string $site_logo
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['option_name', 'option_value'], 'required'],
            [['option_value'], 'string'],
            [['option_name'], 'string', 'max' => 199],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'option_id' => Yii::t('app', 'Option ID'),
            'option_name' => Yii::t('app', 'عنوان'),
            'option_value' => Yii::t('app', 'مقدار'),
        ];
    }
}
