<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "blog_pictures".
 *
 * @property integer $id
 * @property string $src
 * @property integer $user_id
 * @property integer $blog_id
 */
class BlogPictures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_pictures';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['src', 'user_id', 'blog_id'], 'required'],
            [['src'], 'string'],
            [['user_id', 'blog_id'], 'integer'],
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
            'blog_id' => Yii::t('app', 'Blog ID'),
        ];
    }
}
