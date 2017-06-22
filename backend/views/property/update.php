<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Property */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Property',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="property-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    if ($model->property_type_id == 1) {
    echo $this->render('_formApartment', [
      'model' => $model,
      'modelpic' => $modelpic,
      'dealing_type' => $dealing_type,
      'document_type' => $document_type,
      'view' => $view,
      'cabinet' => $cabinet,
      'floor_covering' => $floor_covering,
      'province_list' => $province_list,
      'property_type' => $property_type,
      'facilities' => $facilities,
    ]);
    }
    elseif ($model->property_type_id == 2) {
    echo $this->render('_formVilla', [
      'model' => $model,
      'modelpic' => $modelpic,
      'dealing_type' => $dealing_type,
      'document_type' => $document_type,
      'view' => $view,
      'cabinet' => $cabinet,
      'floor_covering' => $floor_covering,
      'province_list' => $province_list,
      'property_type' => $property_type,
      'facilities' => $facilities,
      'vila_type' => $vila_type,
    ]);
    }

    elseif ($model->property_type_id == 3) {
    echo $this->render('_formComplex', [
      'model' => $model,
      'modelpic' => $modelpic,
      'dealing_type' => $dealing_type,
      'document_type' => $document_type,
      'view' => $view,
      'cabinet' => $cabinet,
      'floor_covering' => $floor_covering,
      'province_list' => $province_list,
      'property_type' => $property_type,
      'facilities' => $facilities,
    ]);
    }

    elseif ($model->property_type_id == 4) {
    echo $this->render('_formStore', [
      'model' => $model,
      'modelpic' => $modelpic,
      'dealing_type' => $dealing_type,
      'document_type' => $document_type,
      'view' => $view,
      'cabinet' => $cabinet,
      'floor_covering' => $floor_covering,
      'province_list' => $province_list,
      'property_type' => $property_type,
      'facilities' => $facilities,
    ]);
    }

    elseif ($model->property_type_id == 5) {
    echo $this->render('_formLand', [
      'model' => $model,
      'modelpic' => $modelpic,
      'dealing_type' => $dealing_type,
      'document_type' => $document_type,
      'view' => $view,
      'cabinet' => $cabinet,
      'floor_covering' => $floor_covering,
      'province_list' => $province_list,
      'property_type' => $property_type,
      'facilities' => $facilities,
    ]);
    }

    elseif ($model->property_type_id == 6) {
    echo $this->render('_formFarm', [
      'model' => $model,
      'modelpic' => $modelpic,
      'dealing_type' => $dealing_type,
      'document_type' => $document_type,
      'view' => $view,
      'cabinet' => $cabinet,
      'floor_covering' => $floor_covering,
      'province_list' => $province_list,
      'property_type' => $property_type,
      'facilities' => $facilities,
    ]);
    }

    elseif ($model->property_type_id == 7) {
    echo $this->render('_formDamdari', [
      'model' => $model,
      'modelpic' => $modelpic,
      'dealing_type' => $dealing_type,
      'document_type' => $document_type,
      'view' => $view,
      'cabinet' => $cabinet,
      'floor_covering' => $floor_covering,
      'province_list' => $province_list,
      'property_type' => $property_type,
      'facilities' => $facilities,
    ]);
    }

    elseif ($model->property_type_id == 8) {
    echo $this->render('_formFactory', [
      'model' => $model,
      'modelpic' => $modelpic,
      'dealing_type' => $dealing_type,
      'document_type' => $document_type,
      'view' => $view,
      'cabinet' => $cabinet,
      'floor_covering' => $floor_covering,
      'province_list' => $province_list,
      'property_type' => $property_type,
      'facilities' => $facilities,
    ]);
    }

    else {
      echo $this->render('_form', [
          'model' => $model,
      ]);
    }
    ?>

</div>
