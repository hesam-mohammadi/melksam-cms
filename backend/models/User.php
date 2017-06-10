<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $username
 * @property string $fname
 * @property string $lname
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $mobile
 * @property string $gender
 * @property integer $city_id
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Property[] $properties
 * @property City $city
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'mobile', 'created_at', 'updated_at'], 'required'],
            [['lname'], 'string'],
            [['mobile', 'city_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'fname', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['gender'], 'string', 'max' => 25],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'نام کاربری'),
            'fname' => Yii::t('app', 'نام'),
            'lname' => Yii::t('app', 'نام خانوادگی'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'رمز عبور'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'ایمیل'),
            'mobile' => Yii::t('app', 'تلفن همراه'),
            'gender' => Yii::t('app', 'جنسیت'),
            'city_id' => Yii::t('app', 'شهر محل اقامت'),
            'status' => Yii::t('app', 'وضعیت'),
            'created_at' => Yii::t('app', 'تاریخ عضویت'),
            'updated_at' => Yii::t('app', 'تاریخ به روز رسانی'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperties()
    {
        return $this->hasMany(Property::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(City::className(), ['id' => 'city_id']);
    }
}
