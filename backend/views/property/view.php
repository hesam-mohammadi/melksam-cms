<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Property */

$this->title = $model->propertyType->name.' '.$model->area_size.' متری'.' - '.$model->city->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'لیست املاک ثبت شده'), 'url' => ['index']];
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

    <?php if($model->property_type_id == 1): ?>
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'id',
              'propertyType.name',
              'area_size',
              'total_area',
              'dealingType.name',
              'city.name',
              'region.name',
              'owner_name',
              'phone_number1',
              'phone_number2',
              'mobile_number',
              'price_per_meter_rent',
              'total_price',
              [
              'attribute'=>'pic',
              'value' => $model->loadImage($model),
              'format'=>['raw'],
              ],
              'residence_status',
              'view.name',
              'geographical_pos',
              'proeperty_age',
              'descriptions:ntext',
              'cabinet.name',
              'floorCovering.name',
              'user.email',
              'documentType.name',
              'address:ntext',
              'number_of_rooms',
              'floor_num',
              'number_of_floors',
              'number_of_units_in_floor',
              'number_of_units',
              'number_of_parkings',
              'toilet_type',
              'telephone_line_count',
              'created_at:datetime',
              'status:boolean',
          ],
      ]) ?>
    <?php elseif($model->property_type_id == 2): ?>
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'id',
              'propertyType.name',
              'vilaType.name',
              'area_size',
              'total_area',
              'front_area',
              'alley_width',
              'dealingType.name',
              'city.name',
              'region.name',
              'owner_name',
              'phone_number1',
              'phone_number2',
              'mobile_number',
              'price_per_meter_rent',
              'total_price',
              [
              'attribute'=>'pic',
              'value' => $model->loadImage($model),
              'format'=>['raw'],
              ],
              'residence_status',
              'view.name',
              'geographical_pos',
              'proeperty_age',
              'descriptions:ntext',
              'cabinet.name',
              'floorCovering.name',
              'user.email',
              'documentType.name',
              'address:ntext',
              'number_of_rooms',
              'number_of_parkings',
              'toilet_type',
              'telephone_line_count',
              'created_at:datetime',
              'status:boolean',
          ],
      ]) ?>
    <?php elseif($model->property_type_id == 3): ?>
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'id',
              'propertyType.name',
              'area_size',
              'total_area',
              'front_area',
              'alley_width',
              'dealingType.name',
              'city.name',
              'region.name',
              'owner_name',
              'phone_number1',
              'phone_number2',
              'mobile_number',
              'price_per_meter_rent',
              'total_price',
              [
              'attribute'=>'pic',
              'value' => $model->loadImage($model),
              'format'=>['raw'],
              ],
              'residence_status',
              'view.name',
              'geographical_pos',
              'proeperty_age',
              'descriptions:ntext',
              'cabinet.name',
              'floorCovering.name',
              'user.email',
              'documentType.name',
              'address:ntext',
              'number_of_rooms',
              'floor_num',
              'number_of_floors',
              'number_of_units_in_floor',
              'number_of_units',
              'number_of_parkings',
              'toilet_type',
              'telephone_line_count',
              'created_at:datetime',
              'status:boolean',
          ],
      ]) ?>
    <?php elseif($model->property_type_id == 4): ?>
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'id',
              'propertyType.name',
              'area_size',
              'front_area',
              'height',
              'revisory',
              'balcony_area',
              'building_sell',
              'activities_product',
              'dealingType.name',
              'city.name',
              'region.name',
              'owner_name',
              'phone_number1',
              'phone_number2',
              'mobile_number',
              'price_per_meter_rent',
              'total_price',
              [
              'attribute'=>'pic',
              'value' => $model->loadImage($model),
              'format'=>['raw'],
              ],
              'residence_status',
              'view.name',
              'geographical_pos',
              'proeperty_age',
              'descriptions:ntext',
              'floorCovering.name',
              'user.email',
              'documentType.name',
              'address:ntext',
              'number_of_rooms',
              'number_of_parkings',
              'toilet_type',
              'telephone_line_count',
              'created_at:datetime',
              'status:boolean',
          ],
      ]) ?>
    <?php elseif($model->property_type_id == 5): ?>
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'id',
              'propertyType.name',
              'area_size',
              'front_area',
              'alley_width',
              'height',
              'revisory',
              'dealingType.name',
              'city.name',
              'region.name',
              'owner_name',
              'phone_number1',
              'phone_number2',
              'mobile_number',
              'price_per_meter_rent',
              'total_price',
              [
              'attribute'=>'pic',
              'value' => $model->loadImage($model),
              'format'=>['raw'],
              ],
              'geographical_pos',
              'descriptions:ntext',
              'user.email',
              'documentType.name',
              'address:ntext',
              'created_at:datetime',
              'status:boolean',
          ],
      ]) ?>
    <?php elseif($model->property_type_id == 6 or $model->property_type_id == 7 or $model->property_type_id == 8 ): ?>
      <?= DetailView::widget([
          'model' => $model,
          'attributes' => [
              'id',
              'propertyType.name',
              'area_size',
              'total_area',
              'building_sell',
              'water',
              'electric',
              'gas',
              'activities_product',
              'equipment',

              'dealingType.name',
              'city.name',
              'region.name',
              'owner_name',
              'phone_number1',
              'phone_number2',
              'mobile_number',
              'price_per_meter_rent',
              'total_price',
              [
              'attribute'=>'pic',
              'value' => $model->loadImage($model),
              'format'=>['raw'],
              ],
              'geographical_pos',
              'descriptions:ntext',
              'user.email',
              'documentType.name',
              'address:ntext',
              'created_at:datetime',
              'status:boolean',
          ],
      ]) ?>
    <?php endif; ?>

</div>
