<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
$this->title = \Yii::$app->name.' | علاقمندی ها';

?>
</header>
<section class="section">
    <div class="container container--sm">
<div class="card">
    <div class="tab-nav tab-nav--justified" data-rmd-breakpoint="650">
        <div class="tab-nav__inner">
            <ul>
                <li><a>لیست علاقمندی ها</a></li>
            </ul>
        </div>
    </div>
    <?php
    Pjax::begin(['id' => 'fav_pjax']);
    $reqcookies = Yii::$app->request->cookies;
    if (isset($reqcookies)) {
        foreach ($reqcookies as $name => $value) {
            if (strpos($name, 'fav') !== false):
              $properties = \frontend\models\Property::find()->where(['id' => $value])->all();
              $pictures = \backend\models\Pictures::find()->where(['agahi_id' => $value])->asArray()->all();
              foreach($properties as $property):
            ?>
            <div class="list-group m-t-20">
                <div class="list-group__wrap">
                    <a href="<?=\yii\helpers\Url::to(['property/listing-detail','id'=>$property->id]) ?>" class="list-group-item media">
                        <div class="pull-right">
                          <?php if($pictures==null): ?>
                              <img src="<?=Yii::$app->homeUrl;?>uploads/no_image.jpg" alt="<?= $property->dealingType->name ?> <?= $property->propertyType->name ?> <?= $property->area_size ?> متری در <?= $property->city->name?>" class="list-group__img" width="65">
                          <?php else: ?>
                              <?php
                                $pic = explode(',', $pictures[0]['src']);?>
                              <img src="<?= '/'.$pic[1] ?>" alt="<?= $property->dealingType->name ?> <?= $property->propertyType->name ?> <?= $property->area_size ?> متری در <?= $property->city->name?>" class="list-group__img" width="65">

                          <?php endif ?>

                        </div>
                        <div class="media-body list-group__text">
                            <strong><?= $property->dealingType->name ?> <?= $property->propertyType->name ?> <?= $property->area_size ?> متری در <?= $property->city->name?></strong>
                            <small><?=$property->total_price?> تومان</small>
                        </div>
                    </a>
                    <div class="actions list-group__actions">
                          <a href="#" class="fav" id="<?=$property->id?>" title="حذف علاقمندی"><i class="zmdi zmdi-close"></i></a>
                    </div>
                </div>
            </div>
        <?php
              endforeach;
            endif;
                }
            }
            ?>
            <div class="p-10"></div>
            <?php Pjax::end(); ?>
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
   success: function(data) {
     $.pjax.reload({container: '#fav_pjax'});
   }
  });
});

SCRIPT;
$this->registerJs($js);
?>
