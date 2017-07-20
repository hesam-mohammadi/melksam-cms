<?php
use yii\helpers\arrayHelper;
use yii\helpers\Html;
use yii\widgets\activeForm;
use backend\models\TaskCategory;

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'User',
]) . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<?php $form = ActiveForm::begin(); ?>
      <?= $form->field($model, 'task')->textInput(['placeHolder' => 'چه کاری قراره انجام بدید؟'])?>

      <div class="col-sm-6">
        <?php
        $categories = TaskCategory::find()->all();
        echo $form->field($model, 'task_cat_id')->dropDownList(ArrayHelper::map($categories,'id','title'),['prompt'=>'انتخاب دسته بندی...', 'class' => 'select2']);
        ?>
      </div>

      <div class="col-sm-6">
      <div class="form-group">
          <label>اولویت</label>
          <div class="btn-group btn-group-justified" data-toggle="buttons">
              <label class="btn <?= ($model->priority == '!') ? 'active' : ''?>">
                  <input type="radio" name="Tasks[priority]" value="!" <?= ($model->priority == '!') ? 'checked' : ''?>>!
              </label>
              <label class="btn <?= ($model->priority == '!!') ? 'active' : ''?>">
                  <input type="radio" name="Tasks[priority]" value="!!" <?= ($model->priority == '!!') ? 'checked' : ''?>>!!
              </label>
              <label class="btn <?= ($model->priority == '!!!') ? 'active' : ''?>">
                  <input type="radio" name="Tasks[priority]" value="!!!" <?= ($model->priority == '!!!') ? 'checked' : ''?>>!!!
              </label>
          </div>
      </div>
    </div>
</div>
<div class="modal-footer">
  <?= Html::submitButton(Yii::t('app', 'Create'), ['class' => 'btn btn-success']) ?>
</div>
<?php ActiveForm::end(); ?>
