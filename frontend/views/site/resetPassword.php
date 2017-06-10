<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'بازیابی کلمه عبور';
$this->params['breadcrumbs'][] = $this->title;
?>

</header>
<section class="section">
    <div class="container card">
        <header class="section__title card__header">
            <h2><?= Html::encode($this->title) ?></h2>
            <small>لطفا رمز عبور جدید خود را وارد کنید:</small>
        </header>
        <div class="card__body">
          <div class="row">
              <div class="col-lg-5">
                <?php Pjax::begin(); ?>
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

                    <?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

                    <div class="form-group">
                        <?= Html::submitButton('ذخیره', ['class' => 'btn btn-primary']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
                <?php Pjax::end(); ?>
              </div>
          </div>

        </div>
    </div>
</section>
