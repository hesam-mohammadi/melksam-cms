<?php $pictures = \backend\models\Pictures::find()->where(['agahi_id' => $model->id])->asArray()->all();?>
<div class="col-xs-6">
    <a class="grid-widget__item" href="<?=\yii\helpers\Url::to(['property/listing-detail','id'=>$model->id]) ?>">
        <?php if($pictures==null): ?>
            <img src="<?=Yii::$app->homeUrl;?>uploads/no_image.jpg" class="img-responsive" alt="<?= $model->dealingType->name ?> <?= $model->propertyType->name ?> <?= $model->area_size ?> متری در <?= $model->city->name?>">
        <?php else: ?>
            <?php
              $pic = explode(',', $pictures[0]['src']);?>
            <img src="<?= '/'.$pic[1] ?>" alt="<?= $model->dealingType->name ?> <?= $model->propertyType->name ?> <?= $model->area_size ?> متری در <?= $model->city->name?>">

        <?php endif ?>

        <div class="grid-widget__info">
            <h4><?= $model->dealingType->name ?> <?= $model->propertyType->name ?> <?= $model->area_size ?> متری</h4>
            <small><?= $model->city->name?>، <?= $model->region->name; ?></small>
        </div>
    </a>
</div>
