<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Property */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'residence_status')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'view_id')->textInput() ?>

    <?= $form->field($model, 'geographical_pos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'proeperty_age')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'descriptions')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cabinet_id')->textInput() ?>

    <?= $form->field($model, 'floor_covering_id')->textInput() ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'region_id')->textInput() ?>

    <?= $form->field($model, 'city_id')->textInput() ?>

    <?= $form->field($model, 'property_type_id')->textInput() ?>

    <?= $form->field($model, 'dealing_type_id')->textInput() ?>

    <?= $form->field($model, 'document_type_id')->textInput() ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone_number1')->textInput() ?>

    <?= $form->field($model, 'phone_number2')->textInput() ?>

    <?= $form->field($model, 'mobile_number')->textInput() ?>

    <?= $form->field($model, 'area_size')->textInput() ?>

    <?= $form->field($model, 'number_of_rooms')->textInput() ?>

    <?= $form->field($model, 'floor_num')->textInput() ?>

    <?= $form->field($model, 'number_of_floors')->textInput() ?>

    <?= $form->field($model, 'number_of_units_in_floor')->textInput() ?>

    <?= $form->field($model, 'number_of_units')->textInput() ?>

    <?= $form->field($model, 'price_per_meter_rent')->textInput() ?>

    <?= $form->field($model, 'total_price')->textInput() ?>

    <?= $form->field($model, 'number_of_parkings')->textInput() ?>

    <?= $form->field($model, 'facilities_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'total_area')->textInput() ?>

    <?= $form->field($model, 'toilet_type')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telephone_line_count')->textInput() ?>

    <?= $form->field($model, 'parking_count')->textInput() ?>

    <?= $form->field($model, 'vila_type_id')->textInput() ?>

    <?= $form->field($model, 'front_area')->textInput() ?>

    <?= $form->field($model, 'alley_width')->textInput() ?>

    <?= $form->field($model, 'owner_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'activities_product')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'building_sell')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <?= $form->field($model, 'revisory')->textInput() ?>

    <?= $form->field($model, 'balcony_area')->textInput() ?>

    <?= $form->field($model, 'has_store')->textInput() ?>

    <?= $form->field($model, 'water')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'electric')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gas')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'equipment')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pic')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
