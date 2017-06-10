<?php
use kartik\growl\Growl;
 if (Yii::$app->session->hasFlash('signup_success')){
   echo Growl::widget([
'type' => Growl::TYPE_SUCCESS,
'title' => 'عالیه!',
'body' => Yii::$app->session->getFlash('signup_success'),
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
if (Yii::$app->session->hasFlash('resend_success')){
  echo Growl::widget([
'type' => Growl::TYPE_SUCCESS,
'title' => 'ایمیل فعالسازی مجددا برای شما ارسال شد!',
'body' => Yii::$app->session->getFlash('resend_success'),
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
if (Yii::$app->session->hasFlash('resend_failed')){
  echo Growl::widget([
'type' => Growl::TYPE_SUCCESS,
'title' => 'خطا در انجام عملیات!',
'body' => Yii::$app->session->getFlash('resend_success'),
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
$this->title = 'ثبت نام';

?>

</header>
<section class="section">
    <div class="container">
          <div class="submit-property">
          <div class="tab-content submit-property__content" style="margin-top: 0;">
            <div class="tab-pane fade in active" id="submit-property-1">
              <div class="card">
                  <div class="submit-property__success">
                      <i class="zmdi zmdi-check"></i>

                      <h2>ثبت نام شما با موفقیت انجام شد!</h2>
                      <p>
                        پس از ثبت نام در سایت برای فعال سازی حساب کاربری (اکانت) شما یک ایمیل به آدرس ایمیلی که در فرم ثبت نام وارد کردید ارسال می شود که حاوی یک لینک برای فعال سازی حساب کاربری شما است ، با کلیک بروی لینک، حساب کاربری شما فعال خواهد شد .
                      </p>
                      <p>
                        <span class="text-info"><b>توجه : </b>در برخی موارد ایمیل فعال سازی به پوشه اسپم ایمیل شما می رود و شما می توانید ایمیل را آنجا پیدا کنید. </span>
                      </p>
                      <p>
                        اگر احیانا لینک فعال سازی به دست شما نرسید و یا با اشکالی در فعال سازی روبرو شدید می توانید روی لینک زیر کلیک تا ایمیل فعال سازی دوباره برای شما ارسال شود :
                        <br />

                        <a href="<?=Yii::$app->homeUrl;?>site/resend-confirm-email?id=<?=$id?>">ارسال مجدد لینک فعالسازی</a>
                      </p>
                  </div>
              </div>
            </div>
          </div>
        </div>

</section>
