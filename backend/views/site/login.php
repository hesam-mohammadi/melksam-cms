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
    <h4 class="text-center text-warning">لوگو ملکسام</h4>


    <div class="row">
        <div class="m-loginform col-md-4 col-sm-4 col-lg-4 col-xs-11">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'email')->textInput(['placeHolder' => 'آدرس ایمیل'])->label(false) ?>

                <?= $form->field($model, 'password')->passwordInput(['placeHolder' => 'کلمه عبور'])->label(false); ?>

                    <?= Html::submitButton('ورود', ['class' => 'btn btn-success btn-block', 'name' => 'login-button']) ?>
                <div style="color:#999;margin:1em 0">
                    <a href="<?=Yii::$app->params['frontendUrl']?>/site/request-password-reset">رمز عبور خود را فراموش کرده اید؟</a>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
