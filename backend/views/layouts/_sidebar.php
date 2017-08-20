<aside id="main__sidebar">
    <a class="hidden-lg main__block-close" href="index.html" data-rmd-action="block-close" data-rmd-target="#main__sidebar">
        <i class="zmdi zmdi-long-arrow-right"></i>
    </a>

    <ul class="main-menu">
        <li <?php if(in_array(\Yii::$app->controller->id,['site']) && in_array(\Yii::$app->controller->action->id,['index'])) {echo 'class="active"';} ?>>
          <a href="<?= Yii::$app->homeUrl ?>"><i class="zmdi zmdi-chart"></i> میز کار </a>
        </li>

        <li <?php if(in_array(\Yii::$app->controller->id,['property']) && in_array(\Yii::$app->controller->action->id,['index'])) {echo 'class="active"';} ?>>
          <a href="<?= \Yii::$app->homeUrl ?>/property"><i class="zmdi zmdi-view-list"></i> لیست املاک ثبت شده
            <?= \backend\models\Property::countPendingProperties();?></a>
        </li>

        <li <?php if(in_array(\Yii::$app->controller->id,['property']) && !in_array(\Yii::$app->controller->action->id,['featured']) && !in_array(\Yii::$app->controller->action->id,['index'])) {echo 'class="active"';} ?>>
          <a href="#" data-toggle="collapse" data-target="#submenu-p" aria-expanded="false"><i class="zmdi zmdi-plus-circle"></i> ثبت ملک جدید <?= \backend\models\Property::countPendingProperties();?></a>
          <ul class="side-sub nav collapse" id="submenu-p" role="menu" aria-labelledby="btn-1">
            <li><a href="<?= \Yii::$app->homeUrl ?>/property/create_apartment"><i class="zmdi zmdi-chevron-left"></i> آپارتمان</a></li>
            <li><a href="<?= \Yii::$app->homeUrl ?>/property/create_villa"><i class="zmdi zmdi-chevron-left"></i> ویلا - خانه</a></li>
            <li><a href="<?= \Yii::$app->homeUrl ?>/property/create_complex"><i class="zmdi zmdi-chevron-left"></i> مجتمع های مسکونی - اداری - تجاری</a></li>
            <li><a href="<?= \Yii::$app->homeUrl ?>/property/create_store"><i class="zmdi zmdi-chevron-left"></i> مغازه و املاک تجاری</a></li>
            <li><a href="<?= \Yii::$app->homeUrl ?>/property/create_land"><i class="zmdi zmdi-chevron-left"></i> زمین -  کلنگی</a></li>
            <li><a href="<?= \Yii::$app->homeUrl ?>/property/create_farm"><i class="zmdi zmdi-chevron-left"></i> باغ - باغچه و املاک کشاورزی</a></li>
            <li><a href="<?= \Yii::$app->homeUrl ?>/property/create_damdari"><i class="zmdi zmdi-chevron-left"></i> دامداری و دامپروری</a></li>
            <li><a href="<?= \Yii::$app->homeUrl ?>/property/create_factory"><i class="zmdi zmdi-chevron-left"></i> املاک صنعتی</a></li>
          </ul>
        </li>
        <?php if(Yii::$app->user->can('مشاور')): ?>
          <li <?php if(in_array(\Yii::$app->controller->id,['property']) && in_array(\Yii::$app->controller->action->id,['featured'])) {echo 'class="active"';} ?>>
            <a href="<?= \Yii::$app->homeUrl ?>/property/featured"><i class="zmdi zmdi-star"></i> پیشنهادات ویژه</a>
          </li>

          <li <?php if(in_array(\Yii::$app->controller->id,['user'])) {echo 'class="active"';} ?>>
            <a href="#" data-toggle="collapse" data-target="#submenu-u" aria-expanded="false"><i class="zmdi zmdi-account-box"></i> کاربران</a>
            <ul class="side-sub nav collapse <?php if(in_array(\Yii::$app->controller->id,['user'])) {echo 'in';} ?>" id="submenu-u" role="menu" aria-labelledby="btn-1">
              <li><a href="<?= \Yii::$app->homeUrl ?>/user"><i class="zmdi zmdi-chevron-left"></i> مشاهده کاربران</a></li>
              <li><a href="<?= \Yii::$app->homeUrl ?>/user/create"><i class="zmdi zmdi-chevron-left"></i> ایجاد کاربر جدید</a></li>
              <li><a href="<?= \Yii::$app->homeUrl ?>/user"><i class="zmdi zmdi-chevron-left"></i> مشاهده مدیران</a></li>
            </ul>
          </li>
        <?php endif; ?>
        <li <?php if(in_array(\Yii::$app->controller->id,['inbox'])) {echo 'class="active"';} ?>>
          <a href="<?= Yii::$app->homeUrl ?>/inbox"><i class="zmdi zmdi-inbox "></i> صندوق پیام های دریافتی</a>
        </li>
        <li <?php if(in_array(\Yii::$app->controller->id,['tasks'])) {echo 'class="active"';} ?>>
          <a href="<?= \Yii::$app->homeUrl ?>/tasks"><i class="zmdi zmdi-check-circle"></i> لیست وظایف</a>
        </li>

        <?php if(Yii::$app->user->can('مشاور')): ?>
          <li <?php if(in_array(\Yii::$app->controller->id,['blog'])) {echo 'class="active"';} ?>>
            <a href="#"  data-toggle="collapse" data-target="#submenu1" aria-expanded="false"><i class="zmdi zmdi-blogger"></i> مدیریت مطالب بلاگ</a>
            <ul class="side-sub nav collapse <?php if(in_array(\Yii::$app->controller->id,['blog'])) {echo 'in';} ?>" id="submenu1" role="menu" aria-labelledby="btn-1">
              <li><a href="<?= \Yii::$app->homeUrl ?>/blog"><i class="zmdi zmdi-chevron-left"></i> همه مطالب</a></li>
              <li><a href="<?= \Yii::$app->homeUrl ?>/blog/create"><i class="zmdi zmdi-chevron-left"></i> ارسال مطلب جدید</a></li>
              <li><a href="<?= \Yii::$app->homeUrl ?>/blog/category"><i class="zmdi zmdi-chevron-left"></i> دسته بندی ها</a></li>
            </ul>
          </li>

        <li <?php if(in_array(\Yii::$app->controller->action->id,['baseinfo'])) {echo 'class="active"';} ?>>
          <a href="<?= \Yii::$app->homeUrl ?>/site/baseinfo"><i class="zmdi zmdi-view-dashboard"></i> مدیریت اطلاعات ملکی</a>
        </li>
        <li <?php if(in_array(\Yii::$app->controller->id,['settings'])) {echo 'class="active"';} ?>>
          <a href="<?= \Yii::$app->homeUrl ?>/site/options"><i class="zmdi zmdi-settings"></i>تنظیمات سایت </a>
        </li>
        <?php endif;?>
    </ul>
</aside>
