<?php $pictures = \backend\models\Pictures::find()->where(['agahi_id' => $model->id])->asArray()->all(); ?>
<div class="col-sm-6 col-md-3">
<div class="listings-grid__item">
    <a href="<?=\yii\helpers\Url::to(['property/listing-detail','id'=>$model->id]) ?>">
        <div class="listings-grid__main">
          <?php if($pictures==null): ?>
              <img src="<?=Yii::$app->homeUrl;?>uploads/no_image.jpg" class="img-responsive" alt="<?= $model->dealingType->name ?> <?= $model->propertyType->name ?> <?= $model->area_size ?> متری در <?= $model->city->name?>">
          <?php else: ?>
              <?php
                $pic = explode(',', $pictures[0]['src']);?>
              <img src="<?= '/'.$pic[1] ?>" alt="<?= $model->dealingType->name ?> <?= $model->propertyType->name ?> <?= $model->area_size ?> متری در <?= $model->city->name?>">

          <?php endif ?>
            <div class="listings-grid__price"><?=$model->total_price?> تومان</div>
        </div>

        <div class="listings-grid__body">
            <small><?= $model->city->name?>، <?= $model->region->name; ?></small>
            <h5><?= $model->dealingType->name ?> <?= $model->propertyType->name ?> <?= $model->area_size ?> متری</h5>
        </div>

        <ul class="listings-grid__attrs">
            <li><i class="listings-grid__icon listings-grid__icon--bed"></i> <?= $model->number_of_rooms; ?> خوابه </li>
            <li><i class="listings-grid__icon listings-grid__icon--parking"></i> <?= $model->number_of_parkings; ?> </li>
        </ul>
    </a>

    <div class="actions listings-grid__favorite">
      <?php
      $reqcookies = Yii::$app->request->cookies;
      if ($reqcookies->has('fav-'.$model->id)) {
        $checked = 'checked';
      }
      else {
        $checked = '';
      }
      ?>
        <div class="actions__toggle">
            <input type="checkbox" class="fav" id="<?=$model->id?>" <?=$checked?>>
            <i class="zmdi zmdi-favorite-outline"></i>
            <i class="zmdi zmdi-favorite"></i>
        </div>
    </div>
</div>
</div>
