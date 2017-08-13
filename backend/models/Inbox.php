<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use backend\models\Property;
/**
 * This is the model class for table "inbox".
 *
 * @property integer $id
 * @property string $name
 * @property string $section
 * @property integer $property_id
 * @property string $message
 * @property string $phone_number
 * @property integer $created_at
 * @property integer $status
 *
 * @property Property $property
 */
class Inbox extends \yii\db\ActiveRecord
{
  public $reply;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'inbox';
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
            [['name', 'message', 'phone_number'], 'required'],
            [['property_id', 'created_at', 'status'], 'integer'],
            [['message'], 'string'],
            [['name', 'email'], 'string', 'max' => 200],
            [['section'], 'string', 'max' => 100],
            [['phone_number'], 'string', 'max' => 15],
            [['property_id'], 'exist', 'skipOnError' => true, 'targetClass' => Property::className(), 'targetAttribute' => ['property_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'نام و نام خانوادگی'),
            'section' => Yii::t('app', 'بخش'),
            'property_id' => Yii::t('app', 'کد ملک'),
            'message' => Yii::t('app', 'متن پیام'),
            'phone_number' => Yii::t('app', 'تلفن'),
            'email' => Yii::t('app', 'ایمیل'),
            'created_at' => Yii::t('app', 'زمان ارسال'),
            'status' => Yii::t('app', 'وضعیت'),
            'reply' => Yii::t('app', 'متن پاسخ'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProperty()
    {
        return $this->hasOne(Property::className(), ['id' => 'property_id']);
    }

    public function sendMessage($id)
    {
        $this->section = 'تماس با مالک';
        $this->property_id = $id;
        $this->message = $_POST['Inbox']['message'];
        $this->phone_number = $_POST['Inbox']['phone_number'];
        $this->status = 0;
        $this->save();
        if($this->save()) {
          \Yii::$app->session->setFlash('success', '.پیام شما با موفقیت ارسال شد');
        }
        else {
          \Yii::$app->session->setFlash('danger', '.متاسفانه مشکلی در ارسال پیام پیش آمد. لطفا دوباره امتحان کنید');
        }
        return true;
    }

    public function sendContact()
    {
        $this->section = 'تماس با ما';
        $this->property_id = '';
        $this->message = $_POST['Inbox']['message'];
        $this->phone_number = $_POST['Inbox']['phone_number'];
        $this->email = $_POST['Inbox']['email'];
        $this->status = 0;
        $this->save();
        if($this->save()) {
          \Yii::$app->session->setFlash('success', '.پیام شما با موفقیت ارسال شد');
        }
        else {
          \Yii::$app->session->setFlash('danger', '.متاسفانه مشکلی در ارسال پیام پیش آمد. لطفا دوباره امتحان کنید');
        }
        return true;
    }

    public function findUserMessages() {
      $inbox = Inbox::find()
      ->joinWith('property')
      ->where(['property.user_id' => \Yii::$app->user->id]);
      return $inbox;
    }

    public function countMessages()
    {
      $allinboxes = Inbox::find()->all();
      $messages = count($allinboxes);
      return $messages;
    }

    public function latest5Messages() {
      $latestmsg = Inbox::find()->limit(5)->OrderBy(['created_at' => SORT_DESC])->all();
      return $latestmsg;
    }

}
