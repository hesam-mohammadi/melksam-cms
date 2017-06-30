<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Inboxes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="inbox-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Inbox'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'created_at:datetime',
            'section',
            'property_id',
            'message:ntext',
            // 'phone_number',

            [
             'label'=>'وضعیت',
             'format'=>'raw',
             'value' => function($model, $key, $index, $column) { return $model->status == 0 ? '<span class="text-danger"><i class="zmdi zmdi-email"></i> خوانده نشده</span>' : '<span class="text-success"><i class="zmdi zmdi-email-open"></i> خوانده شده</span>';},
            ],
            // 'status:boolean',

            [
              'class' => 'yii\grid\ActionColumn',
              'template' => '{view} &nbsp; {delete_inbox}',
              'buttons' => [
                  'view' => function ($url, $model, $key) {
                          return Html::a('<span"><i class="zmdi zmdi-eye"></i> مشاهده پیام</span>', '/admin/inbox/view?id='.$model->id, [
                              'title' => Yii::t('yii', 'View'),
                              'aria-label' => Yii::t('yii', 'View'),
                          ]);
                  },
                  'delete_inbox' => function ($url, $model, $key) {
                    if(\Yii::$app->user->can('admin')) {
                      return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف پیام</span>', '/admin/inbox/delete?id='.$model->id, [
                          'title' => Yii::t('yii', 'Delete'),
                          'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                          'data-method'  => 'post',
                      ]);
                    }
                },

              ],
            ],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
