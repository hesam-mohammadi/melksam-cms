<a href="listing-detail.html" class="list-group-item media">
    <div class="pull-right">
        <img src="<?=Yii::$app->homeUrl;?>img/demo/listing/thumbs/2.jpg" alt="" class="list-group__img" width="65">
    </div>
    <div class="media-body list-group__text">
        <strong><?= $model->dealingType->name ?> <?= $model->propertyType->name ?> <?= $model->area_size ?> متری</strong>
        <small><?= $model->city->name?>، <?= $model->region->name; ?></small>
    </div>
</a>
