<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h4 class="text-center text-warning">ورود به پنل مدیریت</h4>
    <br>

    <div class="row">
        <div class="m-loginform col-md-4 col-sm-4 col-lg-4 col-xs-11">
            <a class="login-logo" href="<?= Yii::$app->params['frontendUrl'] ?>" target="_blank"><img class="img-responsive" src="<?= Yii::$app->homeUrl?>/img/melksam_logo.png"></a>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->textInput(['placeHolder' => 'آدرس ایمیل'])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeHolder' => 'کلمه عبور'])->label(false); ?>

                    <?= Html::submitButton('ورود', ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
                <div style="color:#999;margin:1em 0">
                    <a href="<?=Yii::$app->params['frontendUrl']?>/site/request-password-reset" class="text-center">رمز عبور خود را فراموش کرده اید؟</a>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
