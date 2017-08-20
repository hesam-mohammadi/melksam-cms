<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = 'ورود به سایت';
$this->params['breadcrumbs'][] = $this->title;
?>

</header>
<section class="section">
    <div class="container card">
        <header class="section__title card__header">
            <h2><?= Html::encode($this->title) ?></h2>
            <small>لطفا اطلاعات خود را در فرم زیر وارد کنید:</small>
        </header>
        <div class="card__body">
          <div class="row">
              <div class="col-lg-5">
                <?php Pjax::begin(); ?>
                <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true ], 'id' => 'login-form']); ?>

                    <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                    <?= $form->field($model, 'password')->passwordInput() ?>

                    <?= $form->field($model, 'rememberMe')->checkbox() ?>

                    <div style="color:#999;margin:1em 0">
                        <?= Html::a('رمز عبور خود را فراموش کرده اید؟', ['site/request-password-reset']) ?>
                    </div>

                    <div class="form-group">
                        <?= Html::submitButton('ورود', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
                <?php Pjax::end(); ?>
              </div>
          </div>

        </div>
    </div>
</section>
