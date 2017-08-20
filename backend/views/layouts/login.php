<?php
use backend\assets\AppAsset;
use yii\helpers\Html;
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= frontend\models\Property::get_option('عنوان سایت'); ?> | ورود به حساب کاربری</title>
    <?php $this->head() ?>
</head>
<body style="background: url(../img/patterns/header_pattern.png) #3F51B5 center repeat-x;">
<?php $this->beginBody() ?>
<!-- Start page loader -->
<div id="page-loader">
    <div class="page-loader__spinner"></div>
</div>
<!-- End page loader -->
      <div class="login-main col-md-12">
        <?= $content ?>
      </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
