<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;
use backend\models\SiteLogo;
/* @var $this yii\web\View */
/* @var $model backend\models\Options */
/* @var $form ActiveForm */
$this->title = Yii::t('app', 'تنظیمات سایت');
$this->params['breadcrumbs'][] = $this->title;
?>
<h1><?= $this->title ?></h1><br>
<ul class="nav nav-tabs create_property_title"> <li class="active"><a>اطلاعات اصلی</a></li> </ul>
<?php
// the GridView widget (you must use kartik\grid\GridView)
echo \kartik\grid\GridView::widget([
'dataProvider'=>$dataProvider,
// 'filterModel'=>$searchModel,
'responsive'=>true,
'hover'=>true,
'summary' => false,
'columns' => [
'option_name',
[
'class'=>'kartik\grid\EditableColumn',
'attribute'=>'option_value',
'editableOptions'=>[
    'format' => \kartik\editable\Editable::FORMAT_BUTTON,
    'inputType'=>\kartik\editable\Editable::INPUT_TEXTAREA ,
    'formOptions' => ['action' => ['site/edit_options']],
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
],
]
]);
?>
<ul class="nav nav-tabs create_property_title"> <li class="active"><a>لوگو سایت</a></li> </ul>

<?php
$form = ActiveForm::begin();
$findImage = SiteLogo::find()->all();
$allimage = array();
$key = ArrayHelper::getColumn($findImage,'id');
foreach ($findImage as $index => $eachimage) {
    $baseurl = \Yii::$app->params['frontendUrl'];
    $image_url = $baseurl.'/'.$eachimage['src'];
    $allimage = Html::img("$image_url",  ['class'=>'file-preview-image']);
}
echo '<div class="well well-small">';
echo $form->field($modelLogo, 'src')->widget(FileInput::className(), [
  'name' => 'src',
  'pluginOptions' => [
      'uploadUrl' => Url::to(['upload']),
      'maxFileCount' => 1,
      'showPreview' => true,
      'showCaption' => false,
      'browseLabel' =>  'آپلود لوگو',
      'elCaptionText' => '#customCaption',
      'filebatchuploadcomplete' => false,
      'initialPreview'=> $allimage,
      'initialPreviewConfig' => [
          isset($findImage[0]) ? ['caption' => "{$key[0]}", 'url' => Url::to(['delsingle','key'=>$key[0],'id'=>$modelLogo->id]), 'key' => $findImage[0]['id']] : null,
      ],
      'overwriteInitial' => false,
]]);
ActiveForm::end();
echo '<span id="customCaption" class="text-success"><br><i class="zmdi zmdi-info"></i> بهتر است فرمت لوگو png باشد تا هنگام نمایش در سایت نمای زیباتری داشته باشد.
</span>';
echo '</div>';

$js = <<< 'SCRIPT'
        var $input = $("#sitelogo-src");
        $input.fileinput({
            uploadUrl: "#", // No need server upload action
            uploadAsync: false,
            showUpload: false, // hide upload button
            showRemove: false, // hide remove button
            maxFileCount: 1
        })
        .on("filebatchselected", function(event, files) {
            $input.fileinput("upload");
        });
SCRIPT;
$this->registerJs($js);
?>
<br><ul class="nav nav-tabs create_property_title"> <li class="active"><a>شبکه های اجتماعی</a></li> </ul>
<?php
// the GridView widget (you must use kartik\grid\GridView)
echo \kartik\grid\GridView::widget([
'dataProvider'=>$socailProvider,
// 'filterModel'=>$searchModel,
'responsive'=> true,
'hover'=>true,
'summary' => false,
'columns' => [
'social.name',
[
'class'=>'kartik\grid\EditableColumn',
'attribute'=>'value',
'editableOptions'=>[
    'format' => \kartik\editable\Editable::FORMAT_BUTTON,
    'inputType'=>\kartik\editable\Editable::INPUT_TEXTAREA ,
    'formOptions' => ['action' => ['site/edit_socials']],
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
],

[
'class'=>'kartik\grid\EditableColumn',
'attribute'=>'status',
'editableOptions'=>[
    'inputType'=>\kartik\editable\Editable::INPUT_DROPDOWN_LIST ,
    'asPopover' => true,
    'formOptions' => ['action' => ['site/edit_status']],
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
]

]);
?>
