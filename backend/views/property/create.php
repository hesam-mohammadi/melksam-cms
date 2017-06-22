<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Property */

if ($this->context->action->id == 'create_apartment') {$this->title = Yii::t('app', 'ثبت آپارتمان جدید');}
elseif ($this->context->action->id == 'create_villa') {$this->title = Yii::t('app', 'ثبت ویلا - خانه جدید');}
elseif ($this->context->action->id == 'create_complex') {$this->title = Yii::t('app', 'ثبت مجتمع های مسکونی - اداری - تجاری');}
elseif ($this->context->action->id == 'create_store') {$this->title = Yii::t('app', 'ثبت مغازه و املاک تجاری');}
elseif ($this->context->action->id == 'create_land') {$this->title = Yii::t('app', 'ثبت زمین - کلنگی');}
elseif ($this->context->action->id == 'create_farm') {$this->title = Yii::t('app', 'ثبت باغ - باغچه و املاک کشاورزی');}
elseif ($this->context->action->id == 'create_damdari') {$this->title = Yii::t('app', 'ثبت دامداری و دامپروری');}
elseif ($this->context->action->id == 'create_factory') {$this->title = Yii::t('app', 'ثبت املاک صنعتی');}
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
    elseif ($this->context->action->id == 'create_villa') {
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
    elseif ($this->context->action->id == 'create_complex') {
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

    elseif ($this->context->action->id == 'create_store') {
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

    elseif ($this->context->action->id == 'create_land') {
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

    elseif ($this->context->action->id == 'create_farm') {
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

    elseif ($this->context->action->id == 'create_damdari') {
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

    elseif ($this->context->action->id == 'create_factory') {
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
