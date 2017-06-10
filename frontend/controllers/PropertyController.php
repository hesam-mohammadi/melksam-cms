<?php

namespace frontend\controllers;
use yii\data\ActiveDataProvider;
use frontend\models\Property;
use frontend\models\Inbox;

class PropertyController extends \yii\web\Controller
{
    public function actionListingDetail($id)
    {
      $model = new Inbox();
      $listing= Property::find()->where(['status' => 1])->one();
      if ($model->load(\Yii::$app->request->post()) && $model->validate()) {

        $model->name = $_POST['Inbox']['name'];
        $model->section = 'تماس با مالک';
        $model->property_id = $id;
        $model->message = $_POST['Inbox']['message'];
        $model->phone_number = $_POST['Inbox']['phone_number'];
        $model->status = 0;
        $model->save();
        if($model->save()) {
          \Yii::$app->session->setFlash('success', '.پیام شما با موفقیت ارسال شد. به زودی با شما تماس خواهیم گرفت');
        }
        else {
          \Yii::$app->session->setFlash('danger', '.متاسفانه مشکلی در ارسال پیام پیش آمد. لطفا دوباره امتحان کنید');
        }
        return $this->refresh();
      }
      else {
      return $this->render('listing-detail', ['listing' => $listing, 'model' => $model]);
      }
    }


}
