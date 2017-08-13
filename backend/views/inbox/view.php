<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model backend\models\Inbox */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Inboxes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inbox-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'section',
            'property_id',
            'message:ntext',
            'phone_number',
            'email',
            'created_at:datetime',
        ],
    ]) ?>
    <?php if($model->email != null): ?>
      <br><br>
      <ul class="nav nav-tabs create_property_title"> <li class="active"><a>پاسخ به ایمیل </a></li> </ul>
      <?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'reply')->textarea(['rows' => 6]) ?>
      <div class="form-group">
          <?= Html::submitButton(Yii::t('app', 'ارسال'), ['class' => 'btn btn-success']) ?>
      </div>
      <?php ActiveForm::end(); ?>
    <?php endif; ?>

</div>
