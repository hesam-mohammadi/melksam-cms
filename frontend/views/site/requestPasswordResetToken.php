<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'درخواست بازیابی رمز عبور';
$this->params['breadcrumbs'][] = $this->title;
?>

</header>
<section class="section">
    <div class="container card">
        <header class="section__title card__header">
            <h2><?= Html::encode($this->title) ?></h2>
            <small>در صورتیکه رمز عبور خود را فراموش کرده یا برای ورود مشکل دارید؛ ایمیل خود را وارد کنید تا رمز عبور جدید برای شما ارسال شود</small>
        </header>
        <div class="card__body">
          <div class="row">
              <div class="col-lg-5">
                <?php Pjax::begin(); ?>
                <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                    <?= $form->field($model, 'email')->textInput() ?>

                    <div class="form-group">
                        <?= Html::submitButton('ارسال', ['class' => 'btn btn-primary']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
                <?php Pjax::end(); ?>
              </div>
          </div>

        </div>
    </div>
</section>
