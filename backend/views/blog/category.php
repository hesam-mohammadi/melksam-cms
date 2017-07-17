<?php
use yii\helpers\Html;
use yii\widgets\Pjax;
?>

<div class="col-sm-12">
  <p><h2> ثبت دسته جدید </h2> <br>
<?php $form = \yii\widgets\ActiveForm::begin([
        'id' => 'cat-form',
        'action' => ['create_cat'],
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
]); ?>
    <div class="col-sm-4">
    <?= $form->field($model, 'name')->textInput(['placeHolder' => 'عنوان'])->label(false) ; ?>
    </div>
    <div class="col-sm-2">
      <?= Html::submitButton('ثبت', ['class' => 'btn btn-success btn-block']); ?>
    </div>
    <div class="cat-log margin-top-8 pull-right text-success"></div>

    <?php $form->end(); ?>
    </p>
  </div>

  <?php Pjax::begin(['id' => 'cat_pjax']); ?>
  <?php
  // the GridView widget (you must use kartik\grid\GridView)
  echo \kartik\grid\GridView::widget([
  'dataProvider'=>$dataProvider,
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
      'formOptions' => ['action' => ['edit_cat']],
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
  'attribute'=>'status',
  'editableOptions'=>[
      'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST ,
      'asPopover' => true,
      'formOptions' => ['action' => ['edit_status']],
      'asPopover' => false,
      'showButtonLabels' => true,
      'data' => [0 => 'غیر فعال', 1 => 'فعال'],
      'displayValueConfig'=> [
          '0' => '<span class="glyphicon glyphicon-remove text-danger"></span> غیر فعال',
          '1' => '<span class="glyphicon glyphicon-ok text-success"></span> فعال',
      ],
      'editableButtonOptions' => [
          'label' => '<span class="text-primary"> <i class="zmdi zmdi-edit"></i> ویرایش </span>',
          'class' => 'btn btn-link btn-xs pull-left'
      ],
      'options'=>['pluginOptions'=> '']
  ],
  'hAlign'=>'right',
  'vAlign'=>'middle',
  ],
  [
  'class' => 'yii\grid\ActionColumn',
  'template' => '{delete_cat}',
  'buttons' => [
      'delete_cat' => function ($url) {
                return Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> '. Yii::t('yii', 'Delete').' </span>', '#', [
                    'title' => Yii::t('yii', 'Delete'),
                    'aria-label' => Yii::t('yii', 'Delete'),
                    'onclick' => "
                        if (confirm('آیا از حذف این مورد اطمینان دارید؟')) {
                            $.ajax('$url', {
                                type: 'POST'
                            }).done(function(data) {
                                $.pjax.reload({container: '#cat_pjax'});
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
  <?php Pjax::end();
$script = <<< JS
$(document).ready(
  $('#cat-form').on('beforeSubmit', function(event, jqXHR, settings) {
var form = $(this);
if(form.find('.has-error').length) {
        return false;
}

$.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(data) {
          $('#cat-name').val("");
          $.pjax.reload({container: '#cat_pjax'});
          $( ".cat-log" ).text( "عملیات با موفقیت انجام شد!" );
        }
});

return false;
})
  );
JS;
$this->registerJs($script);
?>
