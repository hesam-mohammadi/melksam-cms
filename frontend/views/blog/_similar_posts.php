<a href="view?id=<?=$model->id?>" class="list-group-item media">

    <div class="media-body list-group__text">
        <strong><?= $model->title ?></strong>
        <small><?= Yii::$app->formatter->asDate($model->created_at)?></small>
    </div>
</a>
