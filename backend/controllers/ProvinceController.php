<?php

namespace backend\controllers;
use backend\models\Province;

class ProvinceController extends \yii\web\Controller
{
  public function actionDelete($id)
  {
      $this->findModel($id)->delete();

      return $this->redirect(['index']);
  }

}
