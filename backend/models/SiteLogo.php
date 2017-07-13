<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "site_logo".
 *
 * @property integer $id
 * @property string $src
 */
class SiteLogo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'site_logo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['src'], 'required'],
            [['src'], 'string'],
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
        ];
    }
}
