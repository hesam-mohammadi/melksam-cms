<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
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
    public $password;
    public $province_id;
    public $auth_item;
    public $captcha;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                  ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                  ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
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
            [['fname', 'lname', 'email', 'mobile'], 'required'],
            [['password'], 'required', 'on' => ['create']],
            [['city_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['mobile'],'integer'],
            [['mobile'],'string','min'=>11],
            [['mobile'],'string','max'=>11],
            [['password', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [
            'captcha',
            \gbksoft\recaptcha\validators\RecaptchaValidator::class,
            'secret' => '6LdYvCoUAAAAAGVi7UkrLMdQS0JwgZJ8P99Nep9j'
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fname' => Yii::t('app', 'نام'),
            'lname' => Yii::t('app', 'نام خانوادگی'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password' => Yii::t('app', 'رمز عبور'),
            'password_reset_token' => Yii::t('app', 'Password Reset Token'),
            'email' => Yii::t('app', 'ایمیل'),
            'mobile' => Yii::t('app', 'تلفن همراه'),
            'gender' => Yii::t('app', 'جنسیت'),
            'city_id' => Yii::t('app', 'شهر محل اقامت'),
            'province_id' => Yii::t('app', 'استان محل اقامت'),
            'status' => Yii::t('app', 'وضعیت'),
            'created_at' => Yii::t('app', 'تاریخ عضویت'),
            'updated_at' => Yii::t('app', 'تاریخ به روز رسانی'),
            'auth_item' => Yii::t('app', 'نقش کاربر'),
            'userRole' => Yii::t('app', 'نقش کاربر'),
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

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if(isset($_POST['User']['status'])) {
              $this->status = $_POST['User']['status'];
            }
            else {
              $this->status = 0;
            }
            return true;
        } else {
            return false;
        }
    }

    public function saveAssignment()
    {
        $auth = new \backend\models\AuthAssignment();
        $auth->item_name = $_POST['User']['auth_item'];
        $auth->user_id = strval($this->id);
        if($auth->save()) {
          return true;
        }
        else {
          print_r($this->id);
          echo '<br>';
          print_r($auth->errors);
          die();
        }
    }

    public function getUserRole()
    {
        $roles = \Yii::$app->authManager->getRolesByUser($this->id);
        $role = '';
        foreach($roles as $key => $value) { $role = $key; }
        return $role;
    }

    public function countUsers()
    {
      $allusers = User::find()->all();
      $users = count($allusers);
      return $users;
    }

    public function latest5Users() {
      $latestuser = User::find()->limit(5)->OrderBy(['created_at' => SORT_DESC])->all();
      return $latestuser;
    }
}
