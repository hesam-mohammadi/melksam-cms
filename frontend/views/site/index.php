<?php
/* @var $this yii\web\View */
use yii\widgets\ListView;
use frontend\models\Property;
$this->title = Property::get_option('عنوان سایت'). ' | '. Property::get_option('توضیحات') ;
$this->registerMetaTag([
    'name' => 'title',
    'content' => Property::get_option('عنوان سایت'),
]);
$this->registerMetaTag([
    'name' => 'description',
    'content' => Property::get_option('توضیحات'),
]);
?>

<div class="header__recommended">

    <?= $this->render('_search'); ?>
    <?php if($dataProvider->getModels() != null):?>
      <div class="my-location">
          <div class="my-location__title">پیشنهادات ویژه <i class="zmdi zmdi-star mdc-text-amber animated infinite tada"></i> </div>
      </div>
    <?php endif; ?>
    <div class="listings-grid">
      <?php
        $myModels = $dataProvider->getModels();
        foreach ($myModels as $listings):
        $pictures = \backend\models\Pictures::find()->where(['agahi_id' => $listings->id])->asArray()->all();
      ?>
      <div class="listings-grid__item">
          <a href="<?=\yii\helpers\Url::to(['property/listing-detail','id'=>$listings->id]) ?>">
              <div class="listings-grid__main">
                <?php if($pictures==null): ?>
                    <img src="<?=Yii::$app->homeUrl;?>uploads/no_image.jpg" class="img-responsive" alt="<?= $listings->dealingType->name ?> <?= $listings->propertyType->name ?> <?= $listings->area_size ?> متری در <?= $listings->city->name?>">
                <?php else: ?>
                    <?php
                      $pic = explode(',', $pictures[0]['src']);?>
                    <img src="<?= '/'.$pic[1] ?>" alt="<?= $listings->dealingType->name ?> <?= $listings->propertyType->name ?> <?= $listings->area_size ?> متری در <?= $listings->city->name?>">

                <?php endif ?>
                  <div class="listings-grid__price"><?=$listings->total_price?> تومان</div>
              </div>

              <div class="listings-grid__body">
                  <small><?= $listings->city->name?>، <?= $listings->region->name; ?></small>
                  <h5><?= $listings->dealingType->name ?> <?= $listings->propertyType->name ?> <?= $listings->area_size ?> متری</h5>
              </div>

              <ul class="listings-grid__attrs">
                  <li><i class="listings-grid__icon listings-grid__icon--bed"></i> <?= $listings->number_of_rooms; ?> خوابه </li>
                  <li><i class="listings-grid__icon listings-grid__icon--parking"></i> <?= $listings->number_of_parkings; ?> </li>
              </ul>
          </a>

          <div class="actions listings-grid__favorite">
            <?php
            $reqcookies = Yii::$app->request->cookies;
            if ($reqcookies->has('fav-'.$listings->id)) {
              $checked = 'checked';
            }
            else {
              $checked = '';
            }
            ?>
              <div class="actions__toggle">
                  <input type="checkbox" class="fav" id="<?=$listings->id?>" <?=$checked?>>
                  <i class="zmdi zmdi-favorite-outline"></i>
                  <i class="zmdi zmdi-favorite"></i>
              </div>
          </div>
      </div>
    <?php endforeach; ?>

    </div>
</div>
</header>

<section class="section">
<div class="container">
    <header class="section__title">
        <?php $property_count= Property::find()->where(['status' => 1])->count(); ?>
        <h2><?= $property_count ?> ملک برای فروش و اجاره</h2>
        <small>آپارتمان، خانه های ویلایی، املاک تجاری و مغازه، واحد های اداری، زمین و ...</small>
    </header>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card__header card__header--minimal">
                    <h2>جدیدترین املاک برای فروش</h2>
                </div>

                <div class="grid-widget grid-widget--listings">
                  <?= ListView::widget([
                    'dataProvider' => $saleProvider,
                    'itemView' => '_propertyItem',
                    'summary' => false,
                  ]); ?>
                </div>

                <a class="view-more" href="http://bootstrapsale.com/projects/roost/v1-0/grid-listings.html">
                  <i class="zmdi zmdi-long-arrow-left"></i>  مشاهده همه
                </a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card__header card__header--minimal">
                    <h2>جدیدترین املاک برای رهن و اجاره</h2>
                </div>

                <div class="grid-widget grid-widget--listings">
                  <?= ListView::widget([
                    'dataProvider' => $rentProvider,
                    'itemView' => '_propertyItem',
                    'summary' => false,
                  ]); ?>
                </div>

                <a class="view-more" href="http://bootstrapsale.com/projects/roost/v1-0/grid-listings.html">
                    <i class="zmdi zmdi-long-arrow-left"></i> مشاهده همه
                </a>
            </div>
        </div>
        </div>
    </div>
</div>
</section>
<?php
$js = <<< 'SCRIPT'
$(document).on("click",".fav", function () {
  var clickedBtnID = $(this).attr('id'); // or var clickedBtnID = this.id
   $.ajax({
    url: "/property/fav",
    type: 'post',
    data: {
       id: clickedBtnID,
    },
  });
});

SCRIPT;
$this->registerJs($js);
?>
