<?php

/* @var $this yii\web\View */
/* @var $user common\models\User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->password_reset_token]);
?>
کاربر گرامی، سلام؛
<p>شما در وبسایت <?= ' '.frontend\models\Property::get_option('عنوان سایت').' '; ?>  درخواست تغییر کلمه عبور داده اید.</p>

برای تعیین کلمه عبور جدید روی لینک زیر کلیک کنید:

<?= $resetLink ?>
