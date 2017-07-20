<?php use yii\helpers\Html; ?>
<div class="list-group-item">
    <div class="checkbox checkbox--char">
        <label>
            <input id="<?=$model->id?>" type="checkbox" <?= ($model->status == 1) ? 'checked' : ''; ?>>
            <span class="checkbox__helper"><i class="mdc-bg-purple-400"><?=mb_substr($model->task, 0, 1)?></i></span>
            <span class="tasks-list__info">
                <?= $model->task ?>
                <small class="text-muted"><?= Yii::$app->formatter->asDateTime($model->created_at); ?></small>
            </span>
        </label>
    </div>

    <div class="list-group__attrs">
        <?= ($model->task_cat_id != null) ? '<div> #'.$model->taskCat->title.'</div>' : '';  ?>
        <div><?= $model->priority ?></div>
    </div>

    <div class="actions list-group__actions">
        <div class="dropdown">
            <a href="tasks-lists.html" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

            <ul class="dropdown-menu pull-right">
              <li><a  class="done" id="<?=$model->id?>" href="#"><?= ($model->status ==0) ? 'انجام شد': 'انجام نشده'?></a></li>
                <li><a href="update?id=<?=$model->id?>">ویرایش</a></li>
                <li>
                <?= Html::a('<span class="text-danger"><i class="zmdi zmdi-delete"></i> حذف</span>', 'delete?id='.$model->id, [
                    'title' => Yii::t('yii', 'Delete'),
                    'data-confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                    'data-method'  => 'post',
                ]); ?>
                </li>
            </ul>
        </div>
    </div>
</div>
<?php
$script = <<< JS
$('.checkbox input').click(function() {
  var id = $(this).attr('id');
  $.ajax({
    type: "POST",
    url: "status",
    data: {
        id: id
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
    url: "status",
    data: {
        id: id
    },
    success: function() {
      $.pjax.reload({container: '#status_pjax'});
    }
});
});
JS;
$this->registerJs($script);
?>
