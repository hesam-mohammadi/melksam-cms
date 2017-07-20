<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tasks".
 *
 * @property integer $id
 * @property string $task
 * @property integer $task_cat_id
 * @property string $priority
 * @property integer $user_id
 * @property integer $status
 * @property integer $created_at
 *
 * @property User $user
 * @property TaskCategory $taskCat
 */
class Tasks extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tasks';
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
            [['task', 'priority'], 'required'],
            [['task_cat_id', 'user_id', 'status', 'created_at'], 'integer'],
            [['priority'], 'string'],
            [['task'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['task_cat_id'], 'exist', 'skipOnError' => true, 'targetClass' => TaskCategory::className(), 'targetAttribute' => ['task_cat_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'task' => Yii::t('app', 'Task'),
            'task_cat_id' => Yii::t('app', 'Task Cat ID'),
            'priority' => Yii::t('app', 'Priority'),
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTaskCat()
    {
        return $this->hasOne(TaskCategory::className(), ['id' => 'task_cat_id']);
    }

    public function createTask()
    {
        $this->user_id = \Yii::$app->user->id;
        $this->priority = $_POST['Tasks']['priority'];
        $this->save();
        if($this->save()) {
          \Yii::$app->session->setFlash('success', '.پیام شما با موفقیت ارسال شد');
        }
        else {
          \Yii::$app->session->setFlash('danger', '.متاسفانه مشکلی در ارسال پیام پیش آمد. لطفا دوباره امتحان کنید');
        }
        return true;
    }
}
