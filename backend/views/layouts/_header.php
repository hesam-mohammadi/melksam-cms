<?php use yii\helpers\Html; ?>
<header id="header-alt">
    <a href="index.html" class="header-alt__trigger hidden-lg" data-rmd-action="block-open" data-rmd-target="#main__sidebar">
        <i class="zmdi zmdi-menu"></i>
    </a>

    <a href="<?= Yii::$app->homeUrl?>" class="header-alt__logo hidden-xs">
      <?= (\Yii::$app->user->can('مشاور')) ? '  پنل مدیریت' : 'پنل کاربری'; ?>
    </a>

    <ul class="header-alt__menu">
        <?php if(Yii::$app->user->can('مشاور')): ?><li>
            <a href="<?= Yii::$app->homeUrl ?>/user"><?= \backend\models\User::countInactiveUsers();?><i class="zmdi zmdi-accounts-alt"></i></a>
        </li><?php endif; ?>
        <li>
            <a href="<?= Yii::$app->homeUrl ?>/inbox"><?= \backend\models\Inbox::countUnreadMessages();?><i class="zmdi zmdi-email"></i></a>
        </li>
        <li class="hidden-xs">
            <a href="<?= Yii::$app->params['frontendUrl'] ?>" target="_blank"><i class="zmdi zmdi-home"></i></a>
        </li>
        <li class="header-alt__profile dropdown">
            <a href="index.html" data-toggle="dropdown">
                <img src="<?=Yii::$app->homeUrl ?>img/user_empty.png" alt="">
            </a>

            <ul class="dropdown-menu pull-left">
                <li><a href="<?=Yii::$app->homeUrl ?>user/edit-profile">ویرایش حساب کاربری</a></li>
                <li><a href="<?= Yii::$app->params['frontendUrl'] ?>/fav">لیست علاقمندی ها</a></li>
                <li><?= Html::a('<i class="zmdi zmdi-power"></i> خروج', ['/site/logout'],['data' => ['method' => 'post',]]);?></li>
            </ul>
        </li>
    </ul>

    <div class="header-alt__search-wrap">
        <form class="header-alt__search">
            <input type="text" placeholder="Search...">

            <i class="zmdi zmdi-long-arrow-left" data-rmd-action="block-close"></i>
        </form>
    </div>
</header>
