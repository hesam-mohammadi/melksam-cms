<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use yii\bootstrap\activeForm;
use common\widgets\Alert;
use backend\models\TasksSearch;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <script src="/admin/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<!-- Start page loader -->
<div id="page-loader">
    <div class="page-loader__spinner"></div>
</div>
<!-- End page loader -->

<?php include('_header.php'); ?>
<main id="main">
        <?php include('_sidebar.php'); ?>
        <?= Alert::widget() ?>

        <section id="main__content">
          <div class="action-header-alt">
              <div class="action-header__item action-header__item--search">
                <?php
                $searchModel = new TasksSearch();
                $form = ActiveForm::begin([
                    'action' => ['search'],
                    'method' => 'get',
                    'fieldConfig' => [
                      'template' => '{input}', // Leave only input (remove label, error and hint)
                      'options' => [
                          'tag' => false,
                      ],
                  ],
                ]); ?>
                <?= $form->field($searchModel, 'task')->textInput(['placeHolder' => 'جستجو... (دکمه اینتر را فشار دهید)'])->label(false); ?>
                <?php ActiveForm::end(); ?>
              </div>

              <div class="action-header__item action-header__add">
                  <a href="#new-task" data-toggle="modal" class="btn btn-danger btn-sm">وظیفه جدید</a>
              </div>
          </div>

          <div class="main__container">
          <?= Breadcrumbs::widget([
              'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
          ]) ?>
            <?= $content ?>
        </div>
        </section>
    <?php include('_footer.php'); ?>
    </main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
