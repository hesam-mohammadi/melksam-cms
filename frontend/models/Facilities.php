<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "facilities".
 *
 * @property integer $id
 * @property string $name
 */
class Facilities extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'facilities';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name', 'css_class'], 'string', 'max' => 150],
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
            'css_class' => Yii::t('app', 'Css Class'),
        ];
    }
}
