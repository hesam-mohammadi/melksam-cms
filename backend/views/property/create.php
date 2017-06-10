<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Property */

$this->title = Yii::t('app', 'ثبت آپارتمان جدید');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'املاک'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-create">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php
    if ($this->context->action->id == 'create_apartment') {
      echo $this->render('_formApartment', [
        'model' => $model,
        'modelpic' => $modelpic,
      ]);
      }
    elseif($this->context->action->id == 'create') {
      echo $this->render('_form', [
          'model' => $model,
      ]);
    }
    ?>


</div>
