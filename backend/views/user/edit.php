<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\url;
use yii\widgets\ActiveForm;
use kartik\depdrop\DepDrop;
use backend\models\Province;
use kartik\growl\Growl;

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'ویرایش حساب کاربری';
$this->params['breadcrumbs'][] = Yii::t('app', 'ویرایش حساب کاربری');

if (Yii::$app->session->hasFlash('profile_success')){
  echo Growl::widget([
'type' => Growl::TYPE_SUCCESS,
'title' => 'عملیات با موفقیت انجام شد',
'body' => Yii::$app->session->getFlash('profile_success'),
'showSeparator' => true,
'delay' => 0,
'pluginOptions' => [
'showProgressbar' => false,
'placement' => [
'from' => 'top',
'align' => 'right',
]
]
]);
}
if (Yii::$app->session->hasFlash('profile_warning')){
  echo Growl::widget([
'type' => Growl::TYPE_WARNING,
'body' => Yii::$app->session->getFlash('confirm_success'),
'showSeparator' => false,
'delay' => 0,
'pluginOptions' => [
'showProgressbar' => true,
'placement' => [
'from' => 'top',
'align' => 'right',
]
]
]);
}
?>

<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="col-sm-6">
          <?= $form->field($model, 'fname')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-6">
          <?= $form->field($model, 'lname')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-sm-6">
          <?php  if(Yii::$app->user->can('مدیر')) {
              echo $form->field($model, 'email')->textInput(['maxlength' => true]);
          }
          else {
              echo $form->field($model, 'email')->textInput(['maxlength' => true,'disabled' => true]);
          }
          ?>
        </div>

        <div class="col-sm-6">
          <?= $form->field($model, 'password')->textInput(['maxlength' => true])->hint('اگر قصد تغییر کلمه عبور را ندارید این قسمت را خالی بگذارید') ?>
        </div>

        <?php if(\Yii::$app->user->can('مدیر')):?>
        <?php if($model->isNewRecord): ?>
          <div class="col-sm-6">
            <?= $form->field($model, 'auth_item')->dropDownList(ArrayHelper::map(\backend\models\AuthItem::findAll(['type' => 1]), 'name', 'name'),['prompt'=>'-- انتخاب نقش کاربر --']); ?>
          </div>
        <?php else: ?>
          <?php $model->auth_item = $model->getUserRole(); ?>
          <div class="col-sm-6">
            <?= $form->field($model, 'auth_item')->dropDownList(ArrayHelper::map(\backend\models\AuthItem::findAll(['type' => 1]), 'name', 'name'),['prompt'=>'-- انتخاب نقش کاربر --']); ?>
          </div>
        <?php endif; ?>
        <?php endif; ?>

        <div class="col-sm-6">
          <?= $form->field($model, 'mobile')->textInput() ?>
        </div>

        <?php if($model->isNewRecord || $model->city_id == null): ?>
        <div class="col-sm-6">
          <?= $form->field($model, 'province_id')->dropDownList(ArrayHelper::map(Province::find()->all(), 'id', 'name'), ['id'=>'cat-id', 'prompt' => '-- انتخاب استان --']) ?>
        </div>

        <div class="col-sm-6">
          <?php
          // Child # 1
          echo $form->field($model, 'city_id')->widget(DepDrop::classname(), [
              'options'=>['id'=>'subcat-id'],
              'pluginOptions'=>[
                  'depends'=>['cat-id'],
                  'placeholder'=>'-- انتخاب شهر --',
                  'url'=>Url::to(['/site/subcity'])
              ]
          ]);
          ?>
        </div>
      <?php else: ?>
        <div class="col-sm-6">
          <?php
            // Parent
            $catList = ArrayHelper::map(Province::find()->All(), 'id', 'name');
            $model->province_id = $model->city->province_id;
            echo $form->field($model, 'province_id')->dropDownList($catList, ['id' => 'cat-id','options' => [32 => ['hidden' => true]]]);
          ?>
        </div>

        <div class="col-sm-6">
          <?php
          // Child # 1
          $city = ArrayHelper::map(\backend\models\City::find()->where(['province_id' => $model->city->province_id])->All(),'id','name');
          echo $form->field($model, 'city_id')->dropDownList($city, [
            'id' => 'subcat-id',
            'prompt' => '-- انتخاب شهر --',
            'options' => ['data-pjax' => true],
          ]);

          $form->field($model, 'city_id')->widget(DepDrop::classname(), [
              'options' => ['id' => 'subcat-id', 'data-pjax' => true],
              'pluginOptions' => [
                  'depends' => ['cat-id'],
                  'placeholder' => '-- انتخاب منطقه --',
                  'url' => Url::to(['/site/subcity'])
              ]
          ]);
          ?>
        </div>
        <?php endif ?>

    <?php if(\Yii::$app->user->can('مدیر')):?>
        <?php if($model->isNewRecord): ?>
        <div class="form-group col-sm-12">
        <div class="checkbox">
          <label>
              <input type="checkbox" name="User[status]" value= "10">
              <i class="input-helper"></i> وضعیت
          </label>
        </div>
        </div>
        <?php else: ?>
          <div class="form-group col-sm-12">
          <?php $checked = ($model->status = $model->status) ? "checked" : ""; ?>
          <div class="checkbox">
            <label>
                <input type="checkbox" name="User[status]" value= "10" <?= $checked ?>>
                <i class="input-helper"></i> وضعیت
            </label>
          </div>
          </div>
        <?php endif; ?>
    <?php endif; ?>

        <?= $form->field($model, 'captcha')->widget(\gbksoft\recaptcha\widgets\Recaptcha::class, [
        'clientOptions' => [
            'data-sitekey' => '6LdYvCoUAAAAANTJGdCrOkSwayeWTUX_cbjDFoqR',
        ]
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>


</div>
