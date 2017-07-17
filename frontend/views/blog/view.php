<?php
use yii\widgets\ListView;
$this->title = 'وبلاگ  '.\frontend\models\Property::get_option('عنوان سایت').' | '.$model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
</header>
<section class="section">
    <div class="container">
        <header class="section__title">
            <h2><?= $model->title ?></h2>
            <small><i class="zmdi zmdi-calendar"></i>  <?= Yii::$app->formatter->asDate($model->created_at)?> &nbsp; &nbsp; <i class="zmdi zmdi-folder"></i> <?= $model->cat->name; ?></small>

            <div class="actions actions--section">
                <div class="dropdown">
                    <a href="blog-details.html" data-toggle="dropdown"><i class="zmdi zmdi-share"></i></a>
                    <div class="dropdown-menu pull-right rmd-share">
                        <div></div>
                    </div>
                </div>
            </div>
        </header>

        <div class="row">
            <div class="col-md-8 col-sm-7">
                <article class="card blog">
                    <div class="card__img">
                        <img src="<?= Yii::$app->homeUrl.$pictures['src']?>" alt="">
                    </div>
                    <div class="card__body">
                        <?= $model->content ?>
                    </div>
                </article>
              </div>
              <aside class="col-md-4 col-sm-5 hidden-xs">
                  <div class="card">
                      <div class="card__header">
                          <h2>مطالب مشابه</h2>
                      </div>

                      <div class="list-group">
                        <?php
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemOptions' => ['class' => 'item'],
                            'itemView' => '_similar_posts',
                            'summary'=> false,
                        ]);
                        ?>
                          <div class="p-10"></div>
                      </div>
                  </div>
              </aside>
            </div>
              </section>
