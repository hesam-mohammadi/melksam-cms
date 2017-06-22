<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Inbox */

$this->title = Yii::t('app', 'Create Inbox');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inboxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inbox-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
