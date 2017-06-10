<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use yii\helpers\Url;

$this->title = Yii::t('app', 'ویرایش {modelClass}: ', [
    'modelClass' => 'منطقه',
]) . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'منطقه ها')];
$this->params['breadcrumbs'][] = ['label' => $model->name];
$this->params['breadcrumbs'][] = Yii::t('app', 'ویرایش');

$province = backend\models\Province::find()->all();
$prList= ArrayHelper::map($province,'id','name');

?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'province_id')->dropDownList($prList, ['id'=>'region-province']); ?>

<?= $form->field($model, 'city_id')->widget(DepDrop::classname(), [
  'options'=>['id'=>'subcity-id'],
  'pluginOptions'=>[
      'depends'=>['region-province'],
      'placeholder'=>'انتخاب کنید...',
      'url'=>Url::to(['/site/subcity'])
  ]
]); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'به روز رسانی'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
