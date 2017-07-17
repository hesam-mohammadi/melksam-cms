<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "blog_category".
 *
 * @property integer $id
 * @property string $name
 * @property integer $status
 * @property integer $created_at
 *
 * @property BlogPosts[] $blogPosts
 */
class BlogCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'status', 'created_at'], 'required'],
            [['status', 'created_at'], 'integer'],
            [['name'], 'string', 'max' => 200],
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
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBlogPosts()
    {
        return $this->hasMany(BlogPosts::className(), ['cat_id' => 'id']);
    }
}
