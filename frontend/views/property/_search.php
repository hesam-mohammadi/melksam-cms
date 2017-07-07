<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\PropertySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'residence_status') ?>

    <?= $form->field($model, 'view_id') ?>

    <?= $form->field($model, 'geographical_pos') ?>

    <?= $form->field($model, 'proeperty_age') ?>

    <?php // echo $form->field($model, 'descriptions') ?>

    <?php // echo $form->field($model, 'cabinet_id') ?>

    <?php // echo $form->field($model, 'floor_covering_id') ?>

    <?php // echo $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'region_id') ?>

    <?php // echo $form->field($model, 'city_id') ?>

    <?php // echo $form->field($model, 'property_type_id') ?>

    <?php // echo $form->field($model, 'dealing_type_id') ?>

    <?php // echo $form->field($model, 'document_type_id') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'phone_number1') ?>

    <?php // echo $form->field($model, 'phone_number2') ?>

    <?php // echo $form->field($model, 'mobile_number') ?>

    <?php // echo $form->field($model, 'area_size') ?>

    <?php // echo $form->field($model, 'number_of_rooms') ?>

    <?php // echo $form->field($model, 'floor_num') ?>

    <?php // echo $form->field($model, 'number_of_floors') ?>

    <?php // echo $form->field($model, 'number_of_units_in_floor') ?>

    <?php // echo $form->field($model, 'number_of_units') ?>

    <?php // echo $form->field($model, 'price_per_meter_rent') ?>

    <?php // echo $form->field($model, 'total_price') ?>

    <?php // echo $form->field($model, 'number_of_parkings') ?>

    <?php // echo $form->field($model, 'facilities_id') ?>

    <?php // echo $form->field($model, 'total_area') ?>

    <?php // echo $form->field($model, 'toilet_type') ?>

    <?php // echo $form->field($model, 'telephone_line_count') ?>

    <?php // echo $form->field($model, 'vila_type_id') ?>

    <?php // echo $form->field($model, 'front_area') ?>

    <?php // echo $form->field($model, 'alley_width') ?>

    <?php // echo $form->field($model, 'owner_name') ?>

    <?php // echo $form->field($model, 'activities_product') ?>

    <?php // echo $form->field($model, 'building_sell') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'revisory') ?>

    <?php // echo $form->field($model, 'balcony_area') ?>

    <?php // echo $form->field($model, 'has_store') ?>

    <?php // echo $form->field($model, 'water') ?>

    <?php // echo $form->field($model, 'electric') ?>

    <?php // echo $form->field($model, 'gas') ?>

    <?php // echo $form->field($model, 'equipment') ?>

    <?php // echo $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
