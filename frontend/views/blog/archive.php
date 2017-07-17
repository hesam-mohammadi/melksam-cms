</header>
<?php
use yii\widgets\listView;
use yii\widgets\Pjax;
use frontend\models\Property;

$this->title = 'وبلاگ  '.Property::get_option('عنوان سایت');
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-7 pull-right">
              <?php $pjax= Pjax::begin(); ?>
              <?= ListView::widget([
                  'dataProvider' => $dataProvider,
                  'itemView' => '_blogItem',
                  'summary' => false
              ]); ?>
              <?php Pjax::end(); ?>
            </div>

            <aside class="col-md-4 col-sm-5 pull-left hidden-xs">
              <div class="card tags-list">
                  <div class="card__header">
                      <h2>دسته بندی مطالب</h2>
                  </div>
                  <div class="card__body">
                    <?php foreach($cats as $cat): ?>
                      <a href="archive?id=<?=$cat->id?>" class="tags-list__item"><?= $cat->name ?></a>
                    <?php endforeach ?>
                  </div>
              </div>

              <?php if(Property::get_social(1) != null): ?>
                <a href="<?=Property::get_social(1)?>" class="card subscribe mdc-bg-blue-300">
                    <div class="subscribe__icon">
                        <img src="<?= Yii::$app->homeUrl?>img/icons/telegram-logo.svg" class="social_svg-blog" alt="telegram">
                    </div>

                    <h2>ما را در تگرام دنبال کنید</h2>
                    <small>اولین نفری باشید که از همه چیز با خبر میشوید</small>
                </a>
                <?php endif; ?>

            </aside>
        </div>
    </div>
</section>
