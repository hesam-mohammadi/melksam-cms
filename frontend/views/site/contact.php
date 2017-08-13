<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use frontend\models\Property;
use yii\widgets\Pjax;

$this->title = 'تماس با ما';
$this->params['breadcrumbs'][] = $this->title;
?>
</header>
<section class="section">
    <div class="container">
        <header class="section__title">
            <h2>تماس با ما</h2>
        </header>

        <div class="contact">
            <div class="contact__inner clearfix">
              <div class="col-sm-6">
                  <div class="contact__info">
                      <ul class="rmd-contact-list">
                          <li> <?= Property::get_option('عنوان سایت') ?> </li>
                          <li> <?= Property::get_option('توضیحات') ?> </li> <br>
                          <li><i class="zmdi zmdi-pin"></i> <?= Property::get_option('آدرس') ?> </li>
                          <li><i class="zmdi zmdi-phone"></i> <?= Property::get_option('تلفن') ?></li>
                          <li><i class="zmdi zmdi-email"></i> <?= Property::get_option('ایمیل') ?> </li>

                      </ul>

                      <div class="contact__social">
                        <?php if(Property::get_social(3) != null): ?>
                          <a href="<?=Property::get_social(3)?>" class="mdc-bg-indigo-300"><img src="<?= Yii::$app->homeUrl?>img/icons/facebook-logo.svg" class="social_svg" alt="facebook"></a>
                        <?php endif; ?>
                        <?php if(Property::get_social(4) != null): ?>
                          <a href="<?=Property::get_social(4)?>" class="mdc-bg-cyan-300"><img src="<?= Yii::$app->homeUrl?>img/icons/twitter.svg" class="social_svg" alt="twitter"></a>
                        <?php endif; ?>

                        <?php if(Property::get_social(6) != null): ?>
                          <a href="<?=Property::get_social(6)?>" class="mdc-bg-blue"><img src="<?= Yii::$app->homeUrl?>img/icons/linkedin-logo.svg" class="social_svg" alt="linkedin"></a>
                        <?php endif; ?>

                        <?php if(Property::get_social(5) != null): ?>
                          <a href="<?=Property::get_social(5)?>" class="mdc-bg-red-300"><img src="<?= Yii::$app->homeUrl?>img/icons/google-plus.svg" class="social_svg" alt="google plus"></a>
                        <?php endif; ?>

                        <?php if(Property::get_social(2) != null): ?>
                          <a href="<?=Property::get_social(2)?>" class="mdc-bg-blue-grey-400"><img src="<?= Yii::$app->homeUrl?>img/icons/instagram-logo.svg" class="social_svg" alt="instagram"></a>
                        <?php endif; ?>

                        <?php if(Property::get_social(1) != null): ?>
                              <a href="<?=Property::get_social(1)?>" class="mdc-bg-blue-300"><img src="<?= Yii::$app->homeUrl?>img/icons/telegram-logo.svg" class="social_svg" alt="telegram"></a>
                        <?php endif; ?>
                      </div>
                  </div>
              </div>

                <div class="col-sm-6">
                  <?php Pjax::begin(); ?>
                  <?php $form = ActiveForm::begin(['options' => ['class' => 'contact__form']]); ?>
                      <div class="card__body">
                          <?= $form->field($inbox, 'name')->textInput(['placeHolder' => 'نام و نام خانوادگی'])->label(false) ?>
                          <?= $form->field($inbox, 'phone_number')->textInput(['placeHolder' => 'شماره تماس'])->label(false) ?>
                          <?= $form->field($inbox, 'email')->input('email', ['placeHolder' => 'ایمیل'])->label(false); ?>
                          <?= $form->field($inbox, 'message')->textarea(['rows' => 2, 'placeHolder' => 'متن پیام خود را وارد کنید'])->label(false) ?>
                      </div>

                      <div class="card__footer">
                          <?= Html::submitButton('ارسال پیام', ['class' => 'btn brn-sm btn-default btn-static', 'name' => 'contact-button']) ?>
                          <button class="btn btn-link hidden-lg hidden-md" data-rmd-action="block-close" data-rmd-target="#inquire">لغو ارسال</button>
                      </div>
                  <?php ActiveForm::end(); ?>
                  <?php Pjax::end(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
