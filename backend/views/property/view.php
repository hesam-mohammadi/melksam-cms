<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Property */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Properties'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'residence_status',
            'view_id',
            'geographical_pos',
            'proeperty_age',
            'descriptions:ntext',
            'cabinet_id',
            'floor_covering_id',
            'user_id',
            'region_id',
            'city_id',
            'property_type_id',
            'dealing_type_id',
            'document_type_id',
            'address:ntext',
            'area_size',
            'number_of_rooms',
            'floor_num',
            'number_of_floors',
            'number_of_units_in_floor',
            'number_of_units',
            'price_per_meter_rent',
            'total_price',
            'number_of_parkings',
            'facilities_id',
            'total_area',
            'toilet_type',
            'telephone_line_count',
            'parking_count',
            'vila_type_id',
            'front_area',
            'alley_width',
            'owner_name',
            'activities_product',
            'building_sell',
            'height',
            'revisory',
            'balcony_area',
            'has_store',
            'water',
            'electric',
            'gas',
            'equipment',
            'pic:ntext',
            'created_at',
            'status',
        ],
    ]) ?>

</div>
