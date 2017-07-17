<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
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
 * @property User $user
 */
class BlogPosts extends \yii\db\ActiveRecord
{
     public $featured_img;
     /**
      * @inheritdoc
      */
     public static function tableName()
     {
         return 'blog_posts';
     }

     public function behaviors()
     {
         return [
             'timestamp' => [
                 'class' => TimestampBehavior::className(),
                 'attributes' => [
                     ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
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
            [['title', 'cat_id'], 'required'],
            [['featured_img'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
            [['title', 'content'], 'string'],
            [['cat_id', 'user_id', 'created_at', 'status'], 'integer'],
            [['cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => BlogCategory::className(), 'targetAttribute' => ['cat_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
     public function attributeLabels()
     {
       return [
           'id' => Yii::t('app', 'ID'),
           'title' => Yii::t('app', 'عنوان پست'),
           'content' => Yii::t('app', 'متن پست'),
           'cat_id' => Yii::t('app', 'دسته مطلب'),
           'featured_img' => Yii::t('app', 'تصویر شاخص'),
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

}
