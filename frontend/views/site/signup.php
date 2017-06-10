<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'ثبت نام در سایت';
$this->params['breadcrumbs'][] = $this->title;
?>
</header>
<section class="section site-signup">
    <div class="container card">
        <header class="section__title card__header">
            <h2><?= Html::encode($this->title) ?></h2>
            <small>لطفا برای ثبت نام فرم زیر را تکمیل کنید:</small>
        </header>
        <div class="card__body">
          <div class="row">
              <div class="col-lg-5">
                <?php Pjax::begin(); ?>
                  <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ], 'id' => 'form-signup']); ?>

                      <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                      <?= $form->field($model, 'email') ?>

                      <?= $form->field($model, 'password')->passwordInput() ?>

                      <div class="form-group">
                          <?= Html::submitButton('ثبت نام', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                      </div>

                  <?php ActiveForm::end(); ?>
                  <?php Pjax::end(); ?>
              </div>
          </div>

        </div>
    </div>
</section>
