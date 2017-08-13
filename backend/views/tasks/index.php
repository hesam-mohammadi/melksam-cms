<?php
use yii\widgets\listView;
use yii\widgets\Pjax;
use yii\widgets\activeForm;
use yii\helpers\arrayHelper;
use yii\helpers\Html;
use backend\models\TaskCategory;

$this->title = Yii::t('app', 'لیست وظایف');
?>
<header class="main__title">
  <?php $this->params['breadcrumbs'][] = $this->title;?>

    <h2><?= Html::encode($this->title) ?></h2>
</header>

<div class="row">
    <div class="col-md-8">
        <div class="list-group list-group--block tasks-lists">
            <div class="list-group__header text-right">
              تعداد کل وظایف:  <?= $dataProvider->getTotalCount() ?>
            </div>

            <?php $pjax= Pjax::begin(['id' => 'status_pjax']); ?>
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_taskItem',
                'summary' => false
            ]); ?>
            <?php Pjax::end(); ?>
        </div>
    </div>

    <div class="col-md-4 hidden-sm hidden-xs">
        <div class="card">
            <div class="card__header">
                <h2>لیبل ها</h2>
                <small>شما می توانید با استفاده از لیبل ها، وظایف خود را دسته بندی کنید</small>
            </div>

            <?php $pjax= Pjax::begin(['id' => 'label_pjax']); ?>
            <div class="card__body tags-list">
                <?php foreach ($cats as $cat): ?>
                  <div class="tags-list__item"><?= $cat->title ?></div>
                <?php endforeach; ?>
            </div>

            <div class="card__footer card__footer--highlight">
              <?php $form = ActiveForm::begin([
                'id' => 'label-form',
                'action' => ['create_label'],
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
              ]); ?>
                    <?= $form->field($catModel, 'title')->textInput(['placeHolder' => 'لیبل جدید', 'id' => 'label-title']) ?>
                <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-primary']) ?>
            <?php ActiveForm::end(); ?>
            </div>
            <?php Pjax::end(); ?>
            </div>
        </div>
    </div>
</div>
<!-- new Task Modal -->
<div class="modal fade" id="new-task" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ثبت وظیفه جدید</h4>
            </div>
            <div class="modal-body">
              <?php $form = ActiveForm::begin(); ?>
                    <?= $form->field($task, 'task')->textInput(['placeHolder' => 'چه کاری قراره انجام بدید؟'])->label(false) ?>
                    <?php
                    $categories = TaskCategory::find()->all();
                    echo $form->field($task, 'task_cat_id')->dropDownList(ArrayHelper::map($categories,'id','title'),['prompt'=>'انتخاب دسته بندی...', 'class' => 'select2'])->label(false);
                    ?>

                    <div class="form-group">
                        <label>اولویت</label>
                        <div class="btn-group btn-group-justified" data-toggle="buttons">
                            <label class="btn">
                                <input type="radio" name="Tasks[priority]" value="!">!
                            </label>
                            <label class="btn active">
                                <input type="radio" name="Tasks[priority]" value="!!" checked="">!!
                            </label>
                            <label class="btn">
                                <input type="radio" name="Tasks[priority]" value="!!!">!!!
                            </label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?>
                <button type="button" class="btn btn-link" data-dismiss="modal">لغو</button>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<?php
$script = <<< JS
$(document).ready(
  $('#label-form').on('beforeSubmit', function(event, jqXHR, settings) {
var form = $(this);
if(form.find('.has-error').length) {
        return false;
}

$.ajax({
        url: form.attr('action'),
        type: 'post',
        data: form.serialize(),
        success: function(data) {
          $.pjax.reload({container: '#label_pjax'});
        }
});

return false;
})
  );
JS;
$this->registerJs($script);
?>
<?php
$script2 = <<< JS
$('.checkbox input').click(function() {
  var id = $(this).attr('id');
  $.ajax({
    type: "POST",
    url: "tasks/status",
    data: {
        id: id,
        _csrf: yii.getCsrfToken(),
    },
    success: function() {
      $.pjax.reload({container: '#status_pjax'});
    }
});
});

$('.done').click(function() {
  var id = $(this).attr('id');
  $.ajax({
    type: "POST",
    url: "tasks/status",
    data: {
        id: id
    },
    success: function() {
      $.pjax.reload({container: '#status_pjax'});
    }
});
});
JS;
$this->registerJs($script2);
?>
