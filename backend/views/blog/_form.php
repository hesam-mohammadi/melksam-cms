<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\file\FileInput;
use bajadev\ckeditor\CKEditor;
use backend\models\BlogCategory;
use backend\models\BlogPictures;
use yii\web\UploadedFile;

/* @var $this yii\web\View */
/* @var $model backend\models\BlogPosts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="blog-posts-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
      <div class="col-sm-8">
        <?= $form->field($model, 'title')->textInput() ?>

        <?php
        $categories = BlogCategory::find()->all();
        echo $form->field($model, 'cat_id')->dropDownList(ArrayHelper::map($categories,'id','name'),['prompt'=>'انتخاب دسته بندی...']);
        ?>

        <?php echo $form->field($model, 'content')->widget(CKEditor::className(), [
            'editorOptions' => [
                'preset' => 'basic', /* basic, standard, full */
                'inline' => false,
                'contentsLangDirection' => 'rtl',
                'height' => 400,
                'filebrowserBrowseUrl' => 'browse-images',
                'filebrowserUploadUrl' => 'upload-images',
                'extraPlugins' => 'imageuploader',
                'contentsCss' => ["body {font-size: 13px; font-family: Vazir}"],
            ],
        ]); ?>

        <?php if($model->isNewRecord): ?>
        <div class="form-group col-sm-12">
        <div class="checkbox">
          <label>
              <input type="checkbox" name="status" value= "1" checked>
              <i class="input-helper"></i> وضعیت
          </label>
        </div>
        </div>
        <?php else: ?>
          <div class="form-group col-sm-12">
          <?php $checked = ($model->status = $model->status) ? "checked" : ""; ?>
          <div class="checkbox">
            <label>
                <input type="checkbox" name="User[status]" value= "1" <?= $checked ?>>
                <i class="input-helper"></i> وضعیت
            </label>
          </div>
          </div>
        <?php endif; ?>

        <?= $form->field($model, 'captcha')->widget(\gbksoft\recaptcha\widgets\Recaptcha::class, [
        'clientOptions' => [
            'data-sitekey' => '6LdYvCoUAAAAANTJGdCrOkSwayeWTUX_cbjDFoqR',
        ]
        ]) ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
      </div>
      <div class="col-sm-4">
        <?php
            $findImage = BlogPictures::find()->where(['blog_id' => $model->id, 'user_id' => Yii::$app->user->id])->one();
            if($findImage !=null ) {
              $preview = Html::img(Yii::$app->params['frontendUrl'].'/'.$findImage['src'],  ['style'=>'max-height: 245px !important;', 'class' => 'img-responsive']);
            }
            elseif(null !== UploadedFile::getInstances($model, 'featured_img' ))
            $preview = UploadedFile::getInstances($model, 'featured_img');
            else {
              $preview = null;
            }
            echo $form->field($model, 'featured_img')->widget(FileInput::classname(), [
                'options' => ['accept' => 'image/*'],
                'pluginOptions' => [
                    'showPreview' => true,
                    'showCaption' => false,
                    'showRemove' => (null !== UploadedFile::getInstances($model, 'featured_img') && $findImage == null ) ? true : false,
                    'showUpload' => false,
                    'initialPreview'=> $preview,
                    'initialPreviewConfig' => [
                        isset($findImage) ? ['caption' => "{$findImage['id']}", 'url' => Url::to(['/blog/delsingle','key'=>$findImage['id'],'id'=>$model->id]), 'key' => $findImage['id']] : null,
                    ],
                    'browseClass' => 'btn btn-primary btn-block',
                    'browseIcon' => '<i class="glyphicon glyphicon-camera"></i> ',
                    'browseLabel' =>  'آپلود عکس اصلی پست'
                ]
        ]); ?>
      </div>

  </div>

    <?php ActiveForm::end(); ?>

</div>
