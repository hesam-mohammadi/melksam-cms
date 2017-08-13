<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
in_array(\Yii::$app->controller->action->id,['featured']) ? $this->title = Yii::t('app', 'املاک ویژه') : $this->title = Yii::t('app', 'لیست املاک ثبت شده');

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
      <?php if(!in_array(\Yii::$app->controller->action->id,['featured'])): ?>
    <div class="dropdown">
      <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">ثبت ملک جدید
      <span class="caret"></span></button>
      <ul class="dropdown-menu">
        <li><a href="/admin/property/create_apartment">آپارتمان</a></li>
        <li><a href="/admin/property/create_villa">ویلا - خانه</a></li>
        <li><a href="/admin/property/create_complex">مجتمع های مسکونی - اداری - تجاری</a></li>
        <li><a href="/admin/property/create_store">مغازه و املاک تجاری</a></li>
        <li><a href="/admin/property/create_land">زمین - کلنگی</a></li>
        <li><a href="/admin/property/create_farm">باغ - باغچه و املاک کشاورزی</a></li>
        <li><a href="/admin/property/create_damdari">دامداری و دامپروری</a></li>
        <li><a href="/admin/property/create_factory">املاک صنعتی</a></li>
      </ul>
    </div>
  <?php endif; ?>
    </p>
<?php Pjax::begin(); ?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'responsive'=>true,
        'hover'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'property_location',
                'format' => 'raw',
                'value' => function ($model) {
                        return $model->city->province->name.' - '.$model->city->name.' - '.$model->region->name.' - '.$model->address ;
                },
            ],
            [
             'label'=>'ویژه',
             'format'=>'raw',
             'value' => function($model, $key, $index, $column) { return $model->featured == 0 ? '<span class="glyphicon glyphicon-remove text-danger"></span>' : '<span class="glyphicon glyphicon-ok text-success"></span></span>';},
            ],
            // 'residence_status',
            // 'view_id',
            // 'geographical_pos',
            // 'proeperty_age',
            // 'descriptions:ntext',
            // 'cabinet_id',
            // 'bathrooms',
            // 'floor_covering_id',
            // 'user_id',
            // 'region_id',
            // 'city_id',
            [
                'attribute'=>'property_type_id',
                'value'=>'propertyType.name',
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            [
                'attribute'=>'dealing_type_id',
                'value'=>'dealingType.name',
                //'contentOptions'=>['style'=>'width: 120px;']
            ],
            // 'document_type_id',
            // 'address:ntext',
            // 'area_size',
            // 'number_of_rooms',
            // 'floor_num',
            // 'number_of_floors',
            // 'number_of_units_in_floor',
            // 'number_of_units',
            // 'price_per_meter_rent',
            // 'total_price',
            // 'number_of_parkings',
            // 'facilities_id',
            // 'total_area',
            // 'toilet_type',
            // 'telephone_line_count',
            // 'parking_count',
            // 'vila_type_id',
            // 'front_area',
            // 'alley_width',
            // 'owner_name',
            // 'activities_product',
            // 'building_sell',
            // 'height',
            // 'revisory',
            // 'balcony_area',
            // 'has_store',
            // 'water',
            // 'electric',
            // 'gas',
            // 'equipment',
            // 'pic:ntext',
            'created_at:date',
            'status:boolean',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
