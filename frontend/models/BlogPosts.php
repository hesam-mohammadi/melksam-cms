<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "blog_posts".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $cat_id
 * @property integer $user_id
 * @property integer $created_at
 * @property integer $status
 *
 * @property BlogCategory $cat
 */
class BlogPosts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog_posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'cat_id', 'user_id', 'created_at', 'status'], 'required'],
            [['title', 'content'], 'string'],
            [['cat_id', 'user_id', 'created_at', 'status'], 'integer'],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
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
            'content' => Yii::t('app', 'Content'),
            'cat_id' => Yii::t('app', 'Cat ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(BlogCategory::className(), ['id' => 'cat_id']);
    }

    public function findSimilarPosts($id)
    {
      $model = BlogPosts::find()->where(['id' => $id])->one();
      $post = BlogPosts::find()->where(['cat_id' => $model->cat_id])->andWhere(['not',['id'=>$id]])->andWhere(['status' => 1])->limit(5);
      return $post;
    }
}
