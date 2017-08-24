<?php
  $pictures = \backend\models\BlogPictures::find()->where(['blog_id' => $model->id])->one();

?>
<article class="card">
    <a class="card__img col-md-4 col-sm-3 pull-right" style="padding: 10px;" href="<?= Yii::$app->homeUrl ?>blog/view?id=<?=$model->id?>">
        <img src="<?= $pictures['src']?>" class="img-responisve" alt="">
    </a>
    <div class="col-md-8 col-sm-7">
    <div class="card__header">
        <a href="<?= Yii::$app->homeUrl ?>blog/view?id=<?=$model->id?>"><h2><?= $model->title ?></h2></a>
        <small><i class="zmdi zmdi-calendar"></i>  <?= Yii::$app->formatter->asDate($model->created_at)?> &nbsp; &nbsp; <i class="zmdi zmdi-folder"></i> <?= $model->cat->name; ?></small>
    </div>
    <div class="card__body">
        <?=mb_substr(\yii\helpers\HtmlPurifier::process(str_replace("\r\n","<br>",$model->content)), 0,200).'...'?>

        <div class="blog-more">
            <a href="view?id=<?=$model->id?>"> ادامه مطلب...</a>
        </div>
    </div>
  </div>
</article>
