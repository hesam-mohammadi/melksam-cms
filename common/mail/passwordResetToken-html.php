<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
<div class="password-reset">
    <p>کاربر گرامی، سلام؛</p>
    <p>شما در وبسایت <?= ' '.frontend\models\Property::get_option('عنوان سایت').' '; ?>  درخواست تغییر کلمه عبور داده اید.</p>
    <p>برای تعیین کلمه عبور جدید روی لینک زیر کلیک کنید:</p>

    <p><?= Html::a(Html::encode($resetLink), $resetLink) ?></p>
</div>
