<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\depdrop\DepDrop;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use backend\models\Province;
use kartik\editable\Editable;

$this->title = Yii::t('app', 'مدیریت اطلاعات ملکی');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="property-index">

    <h1><?= Html::encode($this->title) ?></h1>
<!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#province" aria-controls="province" role="tab" data-toggle="tab">استان ها</a></li>
    <li role="presentation"><a href="#city" aria-controls="city" role="tab" data-toggle="tab">شهر ها</a></li>
    <li role="presentation"><a href="#region" aria-controls="region" role="tab" data-toggle="tab">منطقه ها</a></li>
    <li role="presentation"><a href="#other" aria-controls="other" role="tab" data-toggle="tab">سایر</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="province">

      <div class="col-sm-12">
        <p><h2> ثبت استان جدید </h2> <br>
      <?php $form = \yii\widgets\ActiveForm::begin([
              'id' => 'province-form',
              'action' => ['create_province'],
              'enableAjaxValidation' => false,
              'enableClientValidation' => true,
      ]); ?>
          <div class="col-sm-4">
          <?= $form->field($province_model, 'name')->textInput(['placeHolder' => 'عنوان'])->label(false) ; ?>
          </div>
          <div class="col-sm-2">
            <?= Html::submitButton('ثبت', ['class' => 'btn btn-success btn-block']); ?>
          </div>
          <div class="province-log margin-top-8 pull-right text-success"></div>

          <?php $form->end(); ?>
          </p>
        </div>

        <?php Pjax::begin(['id' => 'province_pjax']); ?>
        <?php
// the GridView widget (you must use kartik\grid\GridView)
echo \kartik\grid\GridView::widget([
    'dataProvider'=>$provinceProvider,
    // 'filterModel'=>$searchModel,
    'responsive'=>true,
    'hover'=>true,
    'columns' => [
    [ 'class' => '\kartik\grid\SerialColumn' ],
    [
        'class'=>'kartik\grid\EditableColumn',
        'attribute'=>'name',
        'editableOptions'=>[
            'format' => \kartik\editable\Editable::FORMAT_BUTTON,
            'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
            'formOptions' => ['action' => ['site/edit_province']],
            'asPopover' => false,
            'showButtonLabels' => true,
            'editableButtonOptions' => [
                'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
                'class' => 'btn btn-link btn-xs pull-left'
            ],

            'options'=>['pluginOptions'=> '']
        ],

        'hAlign'=>'right',
        'vAlign'=>'middle',
        // 'width'=>'50px',
        // 'format'=>['decimal', 2],
        'pageSummary'=>true,

    ],

    [
      'class' => 'yii\grid\ActionColumn',
      'template' => '{delete_province}',
      'buttons' => [
            // 'delete' => function ($url, $model) {
            //     return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف </span>', ['/province/delete', 'id' => $model->id], ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1']);
            // },
            'delete_province' => function ($url) {
                      return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> '. Yii::t('yii', 'Delete').' </span>', '#', [
                          'title' => Yii::t('yii', 'Delete'),
                          'aria-label' => Yii::t('yii', 'Delete'),
                          'onclick' => "
                              if (confirm('آیا از حذف این مورد اطمینان دارید؟')) {
                                  $.ajax('$url', {
                                      type: 'POST'
                                  }).done(function(data) {
                                      $.pjax.reload({container: '#province_pjax'});
                                  });
                              }
                              return false;
                          ",
                      ]);
                  },

      ],
    ],
]

]);
        ?>
        <?php Pjax::end(); ?>
    </div>

    <div role="tabpanel" class="tab-pane" id="city">

      <div class="col-sm-12">
        <p><h2> ثبت شهر جدید </h2> <br>
      <?php $form = \yii\widgets\ActiveForm::begin([
              'id' => 'city-form',
              'action' => ['create_city'],
              'enableAjaxValidation' => false,
              'enableClientValidation' => true,

      ]); ?>
          <div class="col-sm-4">
          <?php $prList = ArrayHelper::map(Province::find()->asArray()->all(), 'id', 'name') ?>
          <?= $form->field($province_model, 'name')->dropDownList($prList, ['id'=>'province-id']); ?>
          <?= $form->field($city_model, 'name')->textInput(['placeHolder' => 'عنوان شهر'])->label(false); ?>
          </div>
          <div class="col-sm-2">
            <?= Html::submitButton('ثبت', ['class' => 'btn btn-success btn-block']); ?>
          </div>
          <div class="city-log margin-top-8 pull-right text-success"></div>

          <?php $form->end(); ?>
          </p>
        </div>

      <?php Pjax::begin(['id' => 'city_pjax']); ?>
      <?php
// the GridView widget (you must use kartik\grid\GridView)
echo \kartik\grid\GridView::widget([
  'dataProvider'=>$cityProvider,
  // 'filterModel'=>$searchModel,
  'responsive'=>true,
  'hover'=>true,
  'columns' => [
  [ 'class' => '\kartik\grid\SerialColumn' ],
  [
      'class'=>'kartik\grid\EditableColumn',
      'attribute'=>'name',
      'editableOptions'=>[
          'format' => \kartik\editable\Editable::FORMAT_BUTTON,
          'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
          'formOptions' => ['action' => ['site/edit_city']],
          'asPopover' => false,
          'showButtonLabels' => true,
          'editableButtonOptions' => [
              'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
              'class' => 'btn btn-link btn-xs pull-left'
          ],

          'options'=>['pluginOptions'=> '']
      ],

      'hAlign'=>'right',
      'vAlign'=>'middle',
      // 'width'=>'50px',
      // 'format'=>['decimal', 2],
      'pageSummary'=>true,

  ],
  [
      'class'=>'kartik\grid\EditableColumn',

      'attribute' => 'province_id',
      'label' => 'استان مربوطه',
      'value' => function($model, $index, $dataColumn) {
          return $model->province->name;
      },
      'editableOptions'=>[
          'format' => \kartik\editable\Editable::FORMAT_BUTTON,
          'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST,
          'data'=> ArrayHelper::map(Province::find()->all(), 'id', 'name'), // any list of values
          'formOptions' => ['action' => ['site/edit_city']],
          'asPopover' => false,
          'showButtonLabels' => true,
          'editableButtonOptions' => [
              'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
              'class' => 'btn btn-link btn-xs pull-left'
          ],

          'options'=>['pluginOptions'=> '']
      ],

      'hAlign'=>'right',
      'vAlign'=>'middle',
      // 'width'=>'50px',
      // 'format'=>['decimal', 2],
      'pageSummary'=>true,

  ],

  [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{delete_city}',
    'buttons' => [
          // 'delete' => function ($url, $model) {
          //     return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف </span>', ['/province/delete', 'id' => $model->id], ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1']);
          // },
          'delete_city' => function ($url) {
                    return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> '. Yii::t('yii', 'Delete').' </span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'aria-label' => Yii::t('yii', 'Delete'),
                        'onclick' => "
                            if (confirm('آیا از حذف این مورد اطمینان دارید؟')) {
                                $.ajax('$url', {
                                    type: 'POST'
                                }).done(function(data) {
                                    $.pjax.reload({container: '#city_pjax'});
                                });
                            }
                            return false;
                        ",
                    ]);
                },

    ],
  ],
]

]);
      ?>
      <?php Pjax::end(); ?>
    </div>

    <div role="tabpanel" class="tab-pane" id="region">

      <div class="col-sm-12">
        <p><h2>ثبت منطقه جدید </h2> <br>
      <?php $form = \yii\widgets\ActiveForm::begin([
              'id' => 'region-form',
              'action' => ['create_region'],
              'enableAjaxValidation' => false,
              'enableClientValidation' => true,

      ]); ?>
          <div class="col-sm-4">
          <?php $prList = ArrayHelper::map(Province::find()->asArray()->all(), 'id', 'name') ?>
          <?= $form->field($city_model, 'province_id')->dropDownList($prList, ['id'=>'region-province']); ?>
          <?= $form->field($city_model, 'name')->widget(DepDrop::classname(), [
            'options'=>['id'=>'subcity-id'],
            'pluginOptions'=>[
                'depends'=>['region-province'],
                'placeholder'=>'انتخاب کنید...',
                'url'=>Url::to(['/site/subcity'])
            ]
          ]); ?>
          <?= $form->field($region_model, 'name')->textInput(['placeHolder' => 'عنوان منطقه'])->label(false); ?>
          </div>
          <div class="col-sm-2">
            <?= Html::submitButton('ثبت', ['class' => 'btn btn-success btn-block']); ?>
          </div>
          <div class="region-log margin-top-8 pull-right text-success"></div>

          <?php $form->end(); ?>
          </p>
        </div>

      <?php Pjax::begin(['id' => 'region_pjax']); ?>

      <?php
// the GridView widget (you must use kartik\grid\GridView)
echo \kartik\grid\GridView::widget([
  'dataProvider'=>$regionProvider,
  // 'filterModel'=>$searchModel,
  'responsive'=>true,
  'hover'=>true,
  'columns' => [
  [ 'class' => '\kartik\grid\SerialColumn' ],
  [
      'class'=>'kartik\grid\EditableColumn',
      'attribute'=>'name',
      'editableOptions'=>[
          'format' => \kartik\editable\Editable::FORMAT_BUTTON,
          'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
          'formOptions' => ['action' => ['site/edit_region']],
          'asPopover' => false,
          'showButtonLabels' => true,
          'editableButtonOptions' => [
              'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
              'class' => 'btn btn-link btn-xs pull-left'
          ],

          'options'=>['pluginOptions'=> '']
      ],

      'hAlign'=>'right',
      'vAlign'=>'middle',
      // 'width'=>'50px',
      // 'format'=>['decimal', 2],
      'pageSummary'=>true,

  ],
  [
          'class' => '\kartik\grid\DataColumn',
          'attribute' => 'city.name',
          'label' => 'شهر مربوطه',
          'pageSummary' => true
      ],

  [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{delete_region}',
    'buttons' => [
          // 'delete' => function ($url, $model) {
          //     return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف </span>', ['/province/delete', 'id' => $model->id], ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1']);
          // },
          'delete_region' => function ($url) {
                    return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> '. Yii::t('yii', 'Delete').' </span>', '#', [
                        'title' => Yii::t('yii', 'Delete'),
                        'aria-label' => Yii::t('yii', 'Delete'),
                        'onclick' => "
                            if (confirm('آیا از حذف این مورد اطمینان دارید؟')) {
                                $.ajax('$url', {
                                    type: 'POST'
                                }).done(function(data) {
                                    $.pjax.reload({container: '#region_pjax'});
                                });
                            }
                            return false;
                        ",
                    ]);
                },

    ],
  ],
]

]);
      ?>

      <?php Pjax::end(); ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="other">

      <div class="panel-group wrap" id="bs-collapse">
      <div class="panel">
      <div class="panel-heading">
        <h4 class="panel-title">
          <a data-toggle="collapse" data-parent="#" href="#dealing_type">
            نوع قرارداد
          </a>
        </h4>
      </div>
      <div id="dealing_type" class="panel-collapse collapse in">
        <div class="panel-body">

          <div class="col-sm-12">
            <p><h2> ثبت نوع قرارداد جدید </h2> <br>
          <?php $form = \yii\widgets\ActiveForm::begin([
                  'id' => 'my-form',
                  'action' => ['create_dealing'],
                  'enableAjaxValidation' => false,
                  'enableClientValidation' => true,

          ]); ?>
              <div class="col-sm-4">
              <?= $form->field($dealing_model, 'name')->textInput(['placeHolder' => 'عنوان'])->label(false) ; ?>
              </div>
              <div class="col-sm-2">
                <?= Html::submitButton('ثبت', ['class' => 'btn btn-success btn-block']); ?>
              </div>
              <div class="log margin-top-8 pull-right text-success"></div>

              <?php $form->end(); ?>
              </p>
            </div>
          <?php Pjax::begin(['id' => 'dealing_type_pjax']); ?>
          <?php
    // the GridView widget (you must use kartik\grid\GridView)
    echo \kartik\grid\GridView::widget([
      'dataProvider'=>$dealingProvider,
      // 'filterModel'=>$searchModel,
      'responsive'=>true,
      'hover'=>true,
      'columns' => [
      [ 'class' => '\kartik\grid\SerialColumn' ],
      [
          'class'=>'kartik\grid\EditableColumn',
          'attribute'=>'name',
          'editableOptions'=>[
              'format' => \kartik\editable\Editable::FORMAT_BUTTON,
              'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
              'formOptions' => ['action' => ['site/edit_dealing']],
              'asPopover' => false,
              'showButtonLabels' => true,
              'editableButtonOptions' => [
                  'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
                  'class' => 'btn btn-link btn-xs pull-left'
              ],

              'options'=>['pluginOptions'=> '']
          ],

          'hAlign'=>'right',
          'vAlign'=>'middle',
          // 'width'=>'50px',
          // 'format'=>['decimal', 2],
          'pageSummary'=>true,

      ],

      [
        'class' => 'yii\grid\ActionColumn',
        'template' => '{delete_dealing}',
        'buttons' => [
              // 'delete' => function ($url, $model) {
              //     return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف </span>', ['/province/delete', 'id' => $model->id], ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1']);
              // },
              'delete_dealing' => function ($url) {
                        return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> '. Yii::t('yii', 'Delete').' </span>', '#', [
                            'title' => Yii::t('yii', 'Delete'),
                            'aria-label' => Yii::t('yii', 'Delete'),
                            'onclick' => "
                                if (confirm('آیا از حذف این مورد اطمینان دارید؟')) {
                                    $.ajax('$url', {
                                        type: 'POST'
                                    }).done(function(data) {
                                        $.pjax.reload({container: '#dealing_type_pjax'});
                                    });
                                }
                                return false;
                            ",
                        ]);
                    },

        ],
      ],
    ]

    ]);
          ?>
          <?php Pjax::end(); ?>
        </div>
      </div>

      </div>
    <!-- end of panel -->

    <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#" href="#view">
         نوع نما
        </a>
      </h4>
        </div>
        <div id="view" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="col-sm-12">
              <p><h2> ثبت نمای جدید </h2> <br>
            <?php $form = \yii\widgets\ActiveForm::begin([
                    'id' => 'view-form',
                    'action' => ['create_view'],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,

            ]); ?>
                <div class="col-sm-4">
                <?= $form->field($view_model, 'name')->textInput(['placeHolder' => 'عنوان'])->label(false) ; ?>
                </div>
                <div class="col-sm-2">
                  <?= Html::submitButton('ثبت', ['class' => 'btn btn-success btn-block']); ?>
                </div>
                <div class="view-log margin-top-8 pull-right text-success"></div>

                <?php $form->end(); ?>
                </p>
              </div>

            <?php Pjax::begin(['id' => 'view_pjax']); ?>
            <?php
      // the GridView widget (you must use kartik\grid\GridView)
      echo \kartik\grid\GridView::widget([
        'dataProvider'=>$viewProvider,
        // 'filterModel'=>$searchModel,
        'responsive'=>true,
        'hover'=>true,
        'columns' => [
        [ 'class' => '\kartik\grid\SerialColumn' ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'name',
            'editableOptions'=>[
                'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                'formOptions' => ['action' => ['site/edit_view']],
                'asPopover' => false,
                'showButtonLabels' => true,
                'editableButtonOptions' => [
                    'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
                    'class' => 'btn btn-link btn-xs pull-left'
                ],

                'options'=>['pluginOptions'=> '']
            ],

            'hAlign'=>'right',
            'vAlign'=>'middle',
            // 'width'=>'50px',
            // 'format'=>['decimal', 2],
            'pageSummary'=>true,

        ],

        [
          'class' => 'yii\grid\ActionColumn',
          'template' => '{delete_view}',
          'buttons' => [
                // 'delete' => function ($url, $model) {
                //     return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف </span>', ['/province/delete', 'id' => $model->id], ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1']);
                // },
                'delete_view' => function ($url) {
                          return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> '. Yii::t('yii', 'Delete').' </span>', '#', [
                              'title' => Yii::t('yii', 'Delete'),
                              'aria-label' => Yii::t('yii', 'Delete'),
                              'onclick' => "
                                  if (confirm('آیا از حذف این مورد اطمینان دارید؟')) {
                                      $.ajax('$url', {
                                          type: 'POST'
                                      }).done(function(data) {
                                          $.pjax.reload({container: '#view_pjax'});
                                      });
                                  }
                                  return false;
                              ",
                          ]);
                      },

          ],
        ],
      ]

      ]);
            ?>
            <?php Pjax::end(); ?>
          </div>

        </div>
      </div>
      <!-- end of panel -->

      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#" href="#floor_covering">
          کف پوش
        </a>
      </h4>
        </div>
        <div id="floor_covering" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="col-sm-12">
              <p><h2> ثبت کف پوش جدید </h2> <br>
            <?php $form = \yii\widgets\ActiveForm::begin([
                    'id' => 'cover-form',
                    'action' => ['create_cover'],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,

            ]); ?>
                <div class="col-sm-4">
                <?= $form->field($cover_model, 'name')->textInput(['placeHolder' => 'عنوان'])->label(false) ; ?>
                </div>
                <div class="col-sm-2">
                  <?= Html::submitButton('ثبت', ['class' => 'btn btn-success btn-block']); ?>
                </div>
                <div class="cover-log margin-top-8 pull-right text-success"></div>

                <?php $form->end(); ?>
                </p>
              </div>

            <?php Pjax::begin(['id' => 'cover_pjax']); ?>
            <?php
      // the GridView widget (you must use kartik\grid\GridView)
      echo \kartik\grid\GridView::widget([
        'dataProvider'=>$coverProvider,
        // 'filterModel'=>$searchModel,
        'responsive'=>true,
        'hover'=>true,
        'columns' => [
        [ 'class' => '\kartik\grid\SerialColumn' ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'name',
            'editableOptions'=>[
                'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                'formOptions' => ['action' => ['site/edit_cover']],
                'asPopover' => false,
                'showButtonLabels' => true,
                'editableButtonOptions' => [
                    'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
                    'class' => 'btn btn-link btn-xs pull-left'
                ],

                'options'=>['pluginOptions'=> '']
            ],

            'hAlign'=>'right',
            'vAlign'=>'middle',
            // 'width'=>'50px',
            // 'format'=>['decimal', 2],
            'pageSummary'=>true,

        ],

        [
          'class' => 'yii\grid\ActionColumn',
          'template' => '{delete_cover}',
          'buttons' => [
                // 'delete' => function ($url, $model) {
                //     return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف </span>', ['/province/delete', 'id' => $model->id], ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1']);
                // },
                'delete_cover' => function ($url) {
                          return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> '. Yii::t('yii', 'Delete').' </span>', '#', [
                              'title' => Yii::t('yii', 'Delete'),
                              'aria-label' => Yii::t('yii', 'Delete'),
                              'onclick' => "
                                  if (confirm('آیا از حذف این مورد اطمینان دارید؟')) {
                                      $.ajax('$url', {
                                          type: 'POST'
                                      }).done(function(data) {
                                          $.pjax.reload({container: '#cover_pjax'});
                                      });
                                  }
                                  return false;
                              ",
                          ]);
                      },

          ],
        ],
      ]

      ]);
            ?>
            <?php Pjax::end(); ?>
          </div>
        </div>
      </div>
      <!-- end of panel -->

      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#" href="#cabinet">
          کابینت
        </a>
      </h4>
        </div>
        <div id="cabinet" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="col-sm-12">
              <p><h2> ثبت کابینت جدید </h2> <br>
            <?php $form = \yii\widgets\ActiveForm::begin([
                    'id' => 'cabinet-form',
                    'action' => ['create_cabinet'],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,

            ]); ?>
                <div class="col-sm-4">
                <?= $form->field($cabinet_model, 'name')->textInput(['placeHolder' => 'عنوان'])->label(false) ; ?>
                </div>
                <div class="col-sm-2">
                  <?= Html::submitButton('ثبت', ['class' => 'btn btn-success btn-block']); ?>
                </div>
                <div class="cabinet-log margin-top-8 pull-right text-success"></div>

                <?php $form->end(); ?>
                </p>
              </div>

            <?php Pjax::begin(['id' => 'cabinet_pjax']); ?>
            <?php
      // the GridView widget (you must use kartik\grid\GridView)
      echo \kartik\grid\GridView::widget([
        'dataProvider'=>$cabinetProvider,
        // 'filterModel'=>$searchModel,
        'responsive'=>true,
        'hover'=>true,
        'columns' => [
        [ 'class' => '\kartik\grid\SerialColumn' ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'name',
            'editableOptions'=>[
                'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                'formOptions' => ['action' => ['site/edit_cabinet']],
                'asPopover' => false,
                'showButtonLabels' => true,
                'editableButtonOptions' => [
                    'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
                    'class' => 'btn btn-link btn-xs pull-left'
                ],

                'options'=>['pluginOptions'=> '']
            ],

            'hAlign'=>'right',
            'vAlign'=>'middle',
            // 'width'=>'50px',
            // 'format'=>['decimal', 2],
            'pageSummary'=>true,

        ],

        [
          'class' => 'yii\grid\ActionColumn',
          'template' => '{delete_cabinet}',
          'buttons' => [
                // 'delete' => function ($url, $model) {
                //     return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف </span>', ['/province/delete', 'id' => $model->id], ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1']);
                // },
                'delete_cabinet' => function ($url) {
                          return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> '. Yii::t('yii', 'Delete').' </span>', '#', [
                              'title' => Yii::t('yii', 'Delete'),
                              'aria-label' => Yii::t('yii', 'Delete'),
                              'onclick' => "
                                  if (confirm('آیا از حذف این مورد اطمینان دارید؟')) {
                                      $.ajax('$url', {
                                          type: 'POST'
                                      }).done(function(data) {
                                          $.pjax.reload({container: '#cabinet_pjax'});
                                      });
                                  }
                                  return false;
                              ",
                          ]);
                      },

          ],
        ],
      ]

      ]);
            ?>
            <?php Pjax::end(); ?>
          </div>
        </div>
      </div>
      <!-- end of panel -->

      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#" href="#vila_type">
          نوع ویلا
        </a>
      </h4>
        </div>
        <div id="vila_type" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="col-sm-12">
              <p><h2> ثبت نوع ویلا جدید </h2> <br>
            <?php $form = \yii\widgets\ActiveForm::begin([
                    'id' => 'vila-form',
                    'action' => ['create_vila'],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,

            ]); ?>
                <div class="col-sm-4">
                <?= $form->field($vila_model, 'name')->textInput(['placeHolder' => 'عنوان'])->label(false) ; ?>
                </div>
                <div class="col-sm-2">
                  <?= Html::submitButton('ثبت', ['class' => 'btn btn-success btn-block']); ?>
                </div>
                <div class="vila-log margin-top-8 pull-right text-success"></div>

                <?php $form->end(); ?>
                </p>
              </div>

            <?php Pjax::begin(['id' => 'vila_pjax']); ?>
            <?php
      // the GridView widget (you must use kartik\grid\GridView)
      echo \kartik\grid\GridView::widget([
        'dataProvider'=>$vilaProvider,
        // 'filterModel'=>$searchModel,
        'responsive'=>true,
        'hover'=>true,
        'columns' => [
        [ 'class' => '\kartik\grid\SerialColumn' ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'name',
            'editableOptions'=>[
                'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                'formOptions' => ['action' => ['site/edit_vila']],
                'asPopover' => false,
                'showButtonLabels' => true,
                'editableButtonOptions' => [
                    'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
                    'class' => 'btn btn-link btn-xs pull-left'
                ],

                'options'=>['pluginOptions'=> '']
            ],

            'hAlign'=>'right',
            'vAlign'=>'middle',
            // 'width'=>'50px',
            // 'format'=>['decimal', 2],
            'pageSummary'=>true,

        ],

        [
          'class' => 'yii\grid\ActionColumn',
          'template' => '{delete_vila}',
          'buttons' => [
                // 'delete' => function ($url, $model) {
                //     return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف </span>', ['/province/delete', 'id' => $model->id], ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1']);
                // },
                'delete_vila' => function ($url) {
                          return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> '. Yii::t('yii', 'Delete').' </span>', '#', [
                              'title' => Yii::t('yii', 'Delete'),
                              'aria-label' => Yii::t('yii', 'Delete'),
                              'onclick' => "
                                  if (confirm('آیا از حذف این مورد اطمینان دارید؟')) {
                                      $.ajax('$url', {
                                          type: 'POST'
                                      }).done(function(data) {
                                          $.pjax.reload({container: '#vila_pjax'});
                                      });
                                  }
                                  return false;
                              ",
                          ]);
                      },

          ],
        ],
      ]

      ]);
            ?>
            <?php Pjax::end(); ?>
          </div>
        </div>
      </div>
      <!-- end of panel -->

      <div class="panel">
        <div class="panel-heading">
          <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#" href="#facilities">
          امکانات
        </a>
      </h4>
        </div>
        <div id="facilities" class="panel-collapse collapse">
          <div class="panel-body">
            <div class="col-sm-12">
              <p><h2> ثبت امکانات جدید </h2> <br>
            <?php $form = \yii\widgets\ActiveForm::begin([
                    'id' => 'facilities-form',
                    'action' => ['create_facilities'],
                    'enableAjaxValidation' => false,
                    'enableClientValidation' => true,

            ]); ?>
                <div class="col-sm-4">

                <?= $form->field($facilities_model, 'name')->textInput(['placeHolder' => 'عنوان'])->label(false) ; ?>
                <div class="note-view__label col-sm-12 hidden-xs">انتخاب رنگ پس زمینه</div> <br>
                <div class="color-tag form-group">
                    <span class="color-tag__default">
                        <input type="radio" value="color-tag__default" name="css_class" checked>
                        <i></i>
                    </span>
                    <span class="mdc-bg-blue-400">
                        <input type="radio" value="mdc-bg-blue-400" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-light-blue-500">
                        <input type="radio" value="mdc-bg-light-blue-500" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-teal-400">
                        <input type="radio" value="mdc-bg-teal-400" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-red-400">
                        <input type="radio" value="mdc-bg-red-400" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-red-300	">
                        <input type="radio" value="mdc-bg-red-300	" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-pink-400">
                        <input type="radio" value="mdc-bg-pink-400" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-lime-400">
                        <input type="radio" value="mdc-bg-lime-400" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-green-400">
                        <input type="radio" value="mdc-bg-green-400" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-light-green-500">
                        <input type="radio" value="mdc-bg-light-green-500" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-cyan-400">
                        <input type="radio" value="mdc-bg-cyan-400" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-purple-300">
                        <input type="radio" value="mdc-bg-purple-300" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-indigo">
                        <input type="radio" value="mdc-bg-indigo" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-amber-400">
                        <input type="radio" value="mdc-bg-amber-400" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-brown-400">
                        <input type="radio" value="mdc-bg-brown-400" name="css_class">
                        <i></i>
                    </span>
                    <span class="mdc-bg-blue-grey-400">
                        <input type="radio" value="mdc-bg-blue-grey-400" name="css_class">
                        <i></i>
                    </span>
                </div>
                <div class="col-sm-7 form-group">
                  <?= Html::submitButton('ثبت', ['class' => 'btn btn-success btn-block']); ?> <br>
                </div>
                </div>

                <?php $form->end(); ?>
                <div class="facilities-log margin-top-8 pull-right text-success"></div>

                </p>
              </div>

            <?php Pjax::begin(['id' => 'facilities_pjax']); ?>
            <?php
      // the GridView widget (you must use kartik\grid\GridView)
      echo \kartik\grid\GridView::widget([
        'dataProvider'=>$facilitiesProvider,
        // 'filterModel'=>$searchModel,
        'responsive'=>true,
        'hover'=>true,
        'columns' => [
        [ 'class' => '\kartik\grid\SerialColumn' ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'name',
            'editableOptions'=>[
                'format' => \kartik\editable\Editable::FORMAT_BUTTON,
                'inputType'=>\kartik\editable\Editable::INPUT_TEXT,
                'formOptions' => ['action' => ['site/edit_facilities']],
                'asPopover' => false,
                'showButtonLabels' => true,
                'editableButtonOptions' => [
                    'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
                    'class' => 'btn btn-link btn-xs pull-left'
                ],


                'options'=>['pluginOptions'=> '']
            ],

            'hAlign'=>'right',
            'vAlign'=>'middle',
            // 'width'=>'50px',
            // 'format'=>['decimal', 2],
            'pageSummary'=>true,

        ],

        [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'css_class',
        'format' => 'raw',
        'value' => function ($model) {
            return '<div class="color-tag"> <span class="'.$model->css_class.'"></span></div>';
        },
        'pageSummary' => true
    ],

        [
          'class' => 'yii\grid\ActionColumn',
          'template' => '{delete_facilities}',
          'buttons' => [
                // 'delete' => function ($url, $model) {
                //     return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف </span>', ['/province/delete', 'id' => $model->id], ['title' => Yii::t('app', 'Delete'), 'data' => ['confirm' => 'Are you sure you want to delete this item?','method' => 'post'], 'data-ajax' => '1']);
                // },
                'delete_facilities' => function ($url) {
                          return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> '. Yii::t('yii', 'Delete').' </span>', '#', [
                              'title' => Yii::t('yii', 'Delete'),
                              'aria-label' => Yii::t('yii', 'Delete'),
                              'onclick' => "
                                  if (confirm('آیا از حذف این مورد اطمینان دارید؟')) {
                                      $.ajax('$url', {
                                          type: 'POST'
                                      }).done(function(data) {
                                          $.pjax.reload({container: '#facilities_pjax'});
                                      });
                                  }
                                  return false;
                              ",
                          ]);
                      },

          ],
        ],
      ]

      ]);
            ?>
            <?php Pjax::end(); ?>
          </div>
        </div>
      </div>
      <!-- end of panel -->
    </div>

    </div>
</div>
</div>
