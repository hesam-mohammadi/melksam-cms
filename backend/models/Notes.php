<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notes".
 *
 * @property integer $id
 * @property string $title
 * @property string $tag
 * @property string $content
 */
class Notes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'notes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title', 'tag', 'content'], 'required'],
            [['id'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 255],
            [['tag'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'tag' => Yii::t('app', 'Tag'),
            'content' => Yii::t('app', 'Content'),
        ];
    }
}
