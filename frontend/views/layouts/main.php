<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap\ActiveForm;
use common\models\LoginForm;
use yii\helpers\Url;
use frontend\models\PasswordResetRequestForm;
use frontend\models\SignupForm;
use kartik\growl\Growl;
use pceuropa\menu\Menu;
use yii\widgets\Pjax;
use mdm\admin\components\MenuHelper;


AppAsset::register($this);


if (Yii::$app->session->hasFlash('confirm_success')){
  echo Growl::widget([
'type' => Growl::TYPE_SUCCESS,
'title' => '!ثبت نام شما با موفقیت تکمیل شد',
'body' => Yii::$app->session->getFlash('confirm_success'),
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
if (Yii::$app->session->hasFlash('confirm_warning')){
  echo Growl::widget([
'type' => Growl::TYPE_SUCCESS,
'body' => Yii::$app->session->getFlash('confirm_warning'),
'showSeparator' => false,
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
if (Yii::$app->session->hasFlash('success_reset')){
  echo Growl::widget([
'type' => Growl::TYPE_SUCCESS,
'title' => 'عالیه!',
'body' => Yii::$app->session->getFlash('success_reset'),
'showSeparator' => false,
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
if (Yii::$app->session->hasFlash('warning_reset')){
  echo Growl::widget([
'type' => Growl::TYPE_SUCCESS,
'title' => '!اوه خطا',
'body' => Yii::$app->session->getFlash('warning_reset'),
'showSeparator' => false,
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
if (Yii::$app->session->hasFlash('success_password_saved')){
  echo Growl::widget([
'type' => Growl::TYPE_SUCCESS,
'title' => '!کلمه عبور شما با موفقیت تغییر کرد',
'body' => Yii::$app->session->getFlash('success_password_saved'),
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
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language = 'fa-IR'?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Start page loader -->
<div id="page-loader">
    <div class="page-loader__spinner"></div>
</div>
<!-- End page loader -->
<header id="header">
    <div class="header__top">
        <div class="container">
            <ul class="top-nav">
              <?php if (Yii::$app->user->isGuest): ?>
                <li class="dropdown top-nav__guest pull-right">
                      <a data-toggle="dropdown" href="#"><i class="zmdi zmdi-account-add"></i> ثبت نام</a>

                      <?php $form = ActiveForm::begin(['action' => ['site/signup'],'options' => ['method' => 'post', 'class'=> 'dropdown-menu stop-propagate']]); ?>
                          <?php $SignupForm= new SignupForm; ?>
                          <?= $form->field($SignupForm, 'username')->textInput(['placeHolder' => 'نام کاربری'])->label(false)  ?>
                          <i class="form-group__bar"></i>

                          <?php echo $form->field($SignupForm, 'email')->textInput()->input('email', ['placeholder' => "آدرس ایمیل"])->label(false); ?>
                          <i class="form-group__bar"></i>

                          <?= $form->field($SignupForm, 'password')->passwordInput(['placeHolder' => 'رمز عبور'])->label(false)  ?>
                          <p><small><a href="index.html">شرایط و قوانین استفاده</a> را خوانده و میپذیرم</small></p>

                          <?= Html::submitButton('ثبت نام', ['class' => 'btn btn-primary btn-block m-t-10 m-b-10', 'name' => 'login-button']) ?>

                          <div class="text-center"><small><a href="index.html">مشاور املاک هستید؟</a></small></div>

                          <div class="top-nav__auth">
                              <span>یا</span>

                              <div>ورود با استفاده از</div>

                              <a href="index.html" class="mdc-bg-blue-500">
                                  <i class="zmdi zmdi-facebook"></i>
                              </a>

                              <a href="index.html" class="mdc-bg-cyan-500">
                                  <i class="zmdi zmdi-twitter"></i>
                              </a>

                              <a href="index.html" class="mdc-bg-red-400">
                                  <i class="zmdi zmdi-google"></i>
                              </a>
                          </div>
                      <?php ActiveForm::end(); ?>
                  </li>
                  <li class="dropdown top-nav__guest pull-right">
                      <a data-toggle="dropdown" href="#" data-rmd-action="switch-login"><i class="zmdi zmdi-sign-in"></i> ورود</a>

                      <div class="dropdown-menu">
                          <div class="tab-content">
                            <?php $form = ActiveForm::begin(['id' => 'top-nav-login', 'action' => ['login'],'options' => ['method' => 'post', 'class'=> 'tab-pane fade active in']]); ?>
                                <?php $LoginForm= new LoginForm; ?>
                                <?= $form->field($LoginForm, 'username')->textInput(['placeHolder' => 'نام کاربری'])->label(false)  ?>
                                <i class="form-group__bar"></i>

                                <?= $form->field($LoginForm, 'password')->passwordInput(['placeHolder' => 'رمز عبور'])->label(false)  ?>
                                <i class="form-group__bar"></i>

                                <?= Html::submitButton('ورود', ['class' => 'btn btn-primary btn-block m-t-10 m-b-10', 'name' => 'login-button']) ?>

                                <div class="text-center">
                                    <a href="/#top-nav-forgot-password" data-toggle="tab"><small>رمز عبور خود را فراموش کرده اید؟</small></a>
                                </div>

                                <div class="top-nav__auth">
                                    <span>یا</span>

                                    <div>ورود با استفاده از</div>
                                    <?= yii\authclient\widgets\AuthChoice::widget([
                                         'baseAuthUrl' => ['site/auth']
                                    ]) ?>

                                    <a href="index.html" class="mdc-bg-blue-500">
                                        <i class="zmdi zmdi-facebook"></i>
                                    </a>

                                    <a href="index.html" class="mdc-bg-cyan-500">
                                        <i class="zmdi zmdi-twitter"></i>
                                    </a>

                                    <a href="index.html" class="mdc-bg-red-400">
                                        <i class="zmdi zmdi-google"></i>
                                    </a>
                                </div>
                            <?php ActiveForm::end() ?>

                            <?php $form = ActiveForm::begin(['id' => 'top-nav-forgot-password', 'action' => ['/site/request-password-reset'],'options' => ['method' => 'post', 'class' => 'tab-pane fade forgot-password']]); ?>
                                <a href="/#top-nav-login" class="top-nav__back" data-toggle="tab"></a>

                                <p>در صورتیکه رمز عبور خود را فراموش کرده یا برای ورود مشکل دارید؛ ایمیل خود را وارد کنید تا رمز عبور جدید برای شما ارسال شود</p>

                                <?php $model = new PasswordResetRequestForm(); ?>
                                <?= $form->field($model, 'email')->textInput(['placeHolder' => 'آدرس ایمیل'])->label(false) ?>
                                <i class="form-group__bar"></i>

                                <div class="form-group">
                                    <?= Html::submitButton('بازیابی کلمه عبور', ['class' => 'btn btn-warning btn-block', 'name' => 'login-button']) ?>
                                </div>
                            <?php ActiveForm::end(); ?>
                          </div>
                      </div>
                  </li>
              <?php else: ?>
                <li class="dropdown pull-right after-login">
                    <a href="#" data-toggle="dropdown">
                      <?php
                      if((Yii::$app->user->identity->fname) && (Yii::$app->user->identity->lname) != null){
                          echo '<i class="zmdi zmdi-account"></i> سلام '.Yii::$app->user->identity->fname.' '.Yii::$app->user->identity->lname;
                      }
                      else {
                          echo '<i class="zmdi zmdi-account" style="margin-left: 5px; margin-right: 0"></i> سلام '.Yii::$app->user->identity->username . ' <i class="zmdi zmdi-caret-down" style="margin-right: 0px;"></i> ';
                      }?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="after-login.html"><i class="zmdi zmdi-assignment-account"></i> حساب کاربری</a></li>
                        <li><a href="after-login.html"><i class="zmdi zmdi-favorite-outline"></i> علاقمندی  ها</a></li>
                        <li><?= Html::a('<i class="zmdi zmdi-power"></i> خروج', ['/site/logout'],['data' => ['method' => 'post',]]);?></li>
                    </ul>
                </li>
                <li class="top-nav__icon">
                    <a href="#">
                        <i class="zmdi zmdi-notifications"></i>
                        <i class="top-nav__alert"></i>
                    </a>
                </li>
              <?php endif; ?>

                <li class="pull-left top-nav__icon">
                    <a href="index.html"><i class="zmdi zmdi-facebook"></i></a>
                </li>
                <li class="pull-left top-nav__icon">
                    <a href="index.html"><i class="zmdi zmdi-twitter"></i></a>
                </li>
                <li class="pull-left top-nav__icon">
                    <a href="index.html"><i class="zmdi zmdi-instagram"></i></a>
                </li>

                <li class="pull-left hidden-xs"><span><i class="zmdi zmdi-email"></i>hello@amlak.ir</span></li>
                <li class="pull-left hidden-xs"><span><i class="zmdi zmdi-phone"></i>013-44511234</span></li>
            </ul>
        </div>
    </div>

    <div class="header__main">
        <div class="container">
            <a class="logo" href="index.html">
                <img src="<?=Yii::$app->homeUrl;?>img/logo.png" alt="">
                <div class="logo__text">
                    <span>پروژه املاک</span>
                    <span>خرید، فروش، رهن و اجاره ملک</span>
                </div>
            </a>

            <div class="navigation-trigger visible-xs visible-sm" data-rmd-action="block-open" data-rmd-target=".navigation">
                <i class="zmdi zmdi-menu"></i>
            </div>

            <ul class="navigation">
                <li class="visible-xs visible-sm"><a class="navigation__close" data-rmd-action="navigation-close" href="index.html"><i class="zmdi zmdi-long-arrow-right"></i></a></li>

                <li class="active navigation__dropdown">
                    <a href="<?=Yii::$app->homeUrl;?>">صفحه اصلی</a>

                    <ul class="navigation__drop-menu">
                        <li><a href="after-login.html">After Login</a></li>
                        <li><a href="home-alternative.html">Home Alternative</a></li>
                        <li><a href="dashboard/index.html">Dashboard</a></li>
                    </ul>
                </li>

                <li class="navigation__dropdown">
                  <a href="index.html" class="prevent-default"> املاک ثبت شده    </a>
                    <ul class="navigation__drop-menu">
                        <li><a href="listings-grid.html">Grid view</a></li>
                        <li><a href="listings-list.html">List view</a></li>
                        <li><a href="listings-map.html">Map view</a></li>
                        <li><a href="listing-detail.html">Listing Detail</a></li>
                    </ul>
                </li>


                <li><a href="submit-property.html">سپردن ملک</a></li>

                <li class="navigation__dropdown">
                    <a href="mortgage.html">وام و تسهیلات</a>

                    <ul class="navigation__drop-menu">
                        <li><a href="mortgage-detail.html">Mortgage Detail</a></li>
                        <li><a href="mortgage-detail-reviews.html">Mortgage Reviews</a></li>
                        <li><a href="mortgage-detail-disclaimer.html">Mortgage Disclaimer</a></li>
                    </ul>
                </li>

                <li class="navigation__dropdown">
                    <a href="agents.html">مشاورین املاک</a>

                    <ul class="navigation__drop-menu">
                        <li><a href="agent-detail.html">Agent Detail</a></li>
                        <li><a href="agent-detail-properties.html">Agent Properties</a></li>
                        <li><a href="agent-detail-reviews.html">Agent Reviews</a></li>
                    </ul>
                </li>

                <li><a href="contact.html">تماس با ما</a></li>

                <li class="navigation__dropdown">
                    <a href="index.html" class="prevent-default">موارد بیشتر</a>

                    <ul class="navigation__drop-menu navigation__drop-menu--right">
                        <li><a href="profile.html">Profile Private</a></li>
                        <li><a href="profile-public.html">Profile Public</a></li>
                        <li><a href="blog.html">Blog</a></li>
                        <li><a href="blog-details.html">Blog Detail</a></li>
                        <li><a href="neighborhood-guide.html">Neighborhood Guide</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                        <li><a href="team.html">Team</a></li>
                        <li><a href="email/listing-mail.html">Email Template</a></li>
                        <li><a href="404.html">Error - 404</a></li>
                        <li><a href="empty-page.html">Empty Page</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
  <?= Alert::widget() ?>
  <?= $content ?>

  <footer id="footer">
      <div class="container hidden-xs">
          <div class="row">
              <div class="col-sm-4">
                  <div class="footer__block">
                      <a class="logo clearfix" href="index.html">
                          <div class="logo__text">
                              <span>Roost</span>
                              <span>Material Design Real Estate</span>
                          </div>
                      </a>

                      <address class="m-t-20 m-b-20 f-14">
                          44-46 Morningside Road,
                          Edinburgh, Scotland
                      </address>

                      <div class="f-20">0062-345678910</div>
                      <div class="f-14 m-t-5">hello@Roost.com / info@Roost.com</div>

                      <div class="f-20 m-t-20">
                          <a href="index.html" class="m-r-10"><i class="zmdi zmdi-google"></i></a>
                          <a href="index.html" class="m-r-10"><i class="zmdi zmdi-facebook"></i></a>
                          <a href="index.html"><i class="zmdi zmdi-twitter"></i></a>
                      </div>
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="footer__block footer__block--blog">
                      <div class="footer__title">Latest from our blog</div>

                      <a href="index.html">
                          Aenean lacinia bibendum nulla sed
                          <small>On 2016/06/20 at 6:00 PM</small>
                      </a>
                      <a href="index.html">
                          Vestibulum id ligula porta felis euismod semper
                          <small>On 2016/06/18 at 7:12 PM</small>
                      </a>
                      <a href="index.html">
                          Etiam porta sem malesuada magna mollis euismod
                          <small>On 2016/06/10 at 12:59 PM</small>
                      </a>
                  </div>
              </div>
              <div class="col-sm-4">
                  <div class="footer__block">
                      <div class="footer__title">Disclaimer</div>

                      <div>Donec id elit non mi porta gravida at eget metus. Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Donec sed odio dui. Maecenas sed diam eget risus varius blandit sit amet non magna. Sed posuere consectetur est at lobortis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam.</div>
                  </div>
              </div>
          </div>
      </div>

      <div class="footer__bottom">
          <div class="container">
              <span class="footer__copyright">© Roost Real Estates</span>

              <a href="index.html">About Us</a>
              <a href="index.html">Terms & Conditions</a>
              <a href="index.html">Privacy Policy</a>
              <a href="index.html">Careers</a>
              <a href="index.html">Agent Login</a>
          </div>

          <div class="footer__to-top" data-rmd-action="scroll-to" data-rmd-target="html">
              <i class="zmdi zmdi-chevron-up"></i>
          </div>
      </div>
  </footer>

  <!-- Older IE warning message -->
  <!--[if lt IE 9]>
      <div class="ie-warning">
          <h1>Warning!!</h1>
          <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
          <div class="ie-warning__inner">
              <ul class="ie-warning__download">
                  <li>
                      <a href="http://www.google.com/chrome/">
                          <img src="img/browsers/chrome.png" alt="">
                          <div>Chrome</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.mozilla.org/en-US/firefox/new/">
                          <img src="img/browsers/firefox.png" alt="">
                          <div>Firefox</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://www.opera.com">
                          <img src="img/browsers/opera.png" alt="">
                          <div>Opera</div>
                      </a>
                  </li>
                  <li>
                      <a href="https://www.apple.com/safari/">
                          <img src="img/browsers/safari.png" alt="">
                          <div>Safari</div>
                      </a>
                  </li>
                  <li>
                      <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                          <img src="img/browsers/ie.png" alt="">
                          <div>IE (New)</div>
                      </a>
                  </li>
              </ul>
          </div>
          <p>Sorry for the inconvenience!</p>
      </div>
  <![endif]-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
