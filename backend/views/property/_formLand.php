<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use backend\models\Region;
use backend\models\Pictures;
use backend\models\Province;
/* @var $this yii\web\View */
/* @var $model backend\models\Property */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="property-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <ul class="nav nav-tabs create_property_title"> <li class="active"><a>مشخصات عمومی ملک</a></li> </ul>

    <div class="col-sm-4">
      <?= $form->field($model, 'dealing_type_id')->dropDownList(ArrayHelper::map($dealing_type,'id','name'), ['prompt'=>'-- انتخاب نوع معامله --']); ?>
    </div>

    <div class="col-sm-4">
      <?php $model->property_type_id = 5;?>
      <?= $form->field($model, 'property_type_id')->dropDownList(ArrayHelper::map($property_type,'id','name'), ['prompt'=>'-- انتخاب نوع ملک --','disabled' => 'disabled'] ); ?>
    </div>

    <div class="col-sm-4">
      <?= $form->field($model, 'document_type_id')->dropDownList(ArrayHelper::map($document_type,'id','name'), ['prompt'=>'-- انتخاب نوع سند --']); ?>
    </div>

    <?php if($model->isNewRecord): ?>
    <div class="col-sm-4">
      <?php // Parent
        echo $form->field($model, 'province_id')->dropDownList(ArrayHelper::map(Province::find()->all(), 'id', 'name'), ['id'=>'cat-id', 'prompt' => '-- انتخاب استان --']);
      ?>
    </div>
    <div class="col-sm-4">
      <?php
      // Child # 1
      echo $form->field($model, 'city_id')->widget(DepDrop::classname(), [
          'options'=>['id'=>'subcat-id'],
          'pluginOptions'=>[
              'depends'=>['cat-id'],
              'placeholder'=>'-- انتخاب شهر --',
              'url'=>Url::to(['/site/subcity'])
          ]
      ]);
      ?>
    </div>
    <div class="col-sm-4">
      <?php
      // Child # 2
      echo $form->field($model, 'region_id')->widget(DepDrop::classname(), [
          'pluginOptions'=>[
              'depends'=>['cat-id', 'subcat-id'],
              'placeholder'=>'-- انتخاب منطقه --',
              'url'=>Url::to(['/site/prod'])
          ]
      ]);
      ?>
    </div>
    <?php else: ?>
    <div class="col-sm-4">
      <?php
        // Parent
        $catList = ArrayHelper::map(Province::find()->All(), 'id', 'name');
        $model->province_id=$model->city->province_id;
        echo $form->field($model, 'province_id')->dropDownList($catList, ['id' => 'cat-id','options' => [32 => ['hidden' => true]]])->label('<i style="color: firebrick;" class="glyphicon glyphicon-asterisk"></i> استان');
      ?>
    </div>
    <div class="col-sm-4">
      <?php
      // Child # 1
      $city = ArrayHelper::map(\backend\models\City::find()->where(['province_id' => $model->city->province_id])->All(),'id','name');
      echo $form->field($model, 'city_id')->dropDownList($city, [
        'id' => 'subcat-id',
        'prompt' => '-- انتخاب شهر --',
        'options' => ['data-pjax' => true],
      ])->label('<i style="color: firebrick;" class="glyphicon glyphicon-asterisk"></i> شهر');

      $form->field($model, 'city_id')->widget(DepDrop::classname(), [
          'options' => ['id' => 'subcat-id', 'data-pjax' => true],
          'pluginOptions' => [
              'depends' => ['cat-id'],
              'placeholder' => '-- انتخاب منطقه --',
              'url' => Url::to(['/site/subcity'])
          ]
      ]);
      ?>
    </div>
    <div class="col-sm-4">
      <?php
      // Child # 2
      $nahie = ArrayHelper::map(\backend\models\Region::find()->where(['city_id' => $model->city->id])->All(),'id','name');
      echo $form->field($model, 'region_id')->dropDownList($nahie, [
          'id' => 'region-id',
          'prompt' => '-- انتخاب منطقه --',
          'options' => ['data-pjax' => true],
      ]);

      $form->field($model, 'region_id')->widget(DepDrop::classname(), [
          'options' => ['id' => 'region-id', 'data-pjax' => true],
          'pluginOptions' => [
              'depends'=>['cat-id', 'subcat-id'],
              'placeholder' => '-- انتخاب منطقه --',
              'url' => Url::to(['/site/prod'])
          ]
      ]);
      ?>
    </div>
    <?php endif?>

    <div class="col-sm-12">
      <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
    </div>

    <div class="col-sm-3">
      <?= $form->field($model, 'phone_number1')->textInput() ?>
    </div>

    <div class="col-sm-3">
      <?= $form->field($model, 'phone_number2')->textInput() ?>
    </div>

    <div class="col-sm-3">
      <?= $form->field($model, 'mobile_number')->textInput() ?>
    </div>

    <div class="col-sm-3">
      <?= $form->field($model, 'owner_name')->textInput(['maxlength' => true]) ?>
    </div>

    <ul class="nav nav-tabs create_property_title"> <li class="active"><a>مشخصات اختصاصی ملک</a></li> </ul>

    <div class="col-sm-6">
      <?= $form->field($model, 'area_size')->textInput(); ?>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
          <label>موقعیت جغرافیایی</label>
          <div class="btn-group btn-group-justified" data-toggle="buttons">
              <label class="btn <?php echo ($model->geographical_pos == 'شمالی') ? "active" : ""; ?>">
                <input type="radio" name="Property[geographical_pos]" value="شمالی" <?php echo ($model->geographical_pos == 'شمالی') ? "checked" : ""; ?> > شمالی
              </label>
              <label class="btn <?php echo ($model->geographical_pos == 'جنوبی') ? "active" : ""; ?>">
                  <input type="radio" name="Property[geographical_pos]" value="جنوبی" <?php echo ($model->geographical_pos == 'جنوبی') ? "checked" : ""; ?> > جنوبی
              </label>
              <label class="btn <?php echo ($model->geographical_pos == 'شرقی') ? "active" : ""; ?>">
                <input type="radio" name="Property[geographical_pos]" value="شرقی" <?php echo ($model->geographical_pos == 'شرقی') ? "checked" : ""; ?> > شرقی
              </label>
              <label class="btn <?php echo ($model->geographical_pos == 'غربی') ? "active" : ""; ?>">
                <input type="radio" name="Property[geographical_pos]" value="غربی" <?php echo ($model->geographical_pos == 'غربی') ? "checked" : ""; ?> > غربی
              </label>
          </div>
      </div>
    </div>

    <div class="col-sm-4">
      <?= $form->field($model, 'front_area')->textInput() ?>
    </div>

    <div class="col-sm-4">
      <?= $form->field($model, 'alley_width')->textInput() ?>
    </div>

    <div class="col-sm-4">
      <?= $form->field($model, 'height')->textInput() ?>
    </div>

    <div class="col-sm-4">
      <?= $form->field($model, 'revisory')->textInput() ?>
    </div>

    <div class="col-sm-4">
      <?= $form->field($model, 'price_per_meter_rent')->textInput(['placeholder' => "مثال: 100000"]); ?>
    </div>

    <div class="col-sm-4">
      <?= $form->field($model, 'total_price')->textInput(['placeholder' => "مثال: 100000"]); ?>
    </div>

    <div class="col-sm-12">
      <?= $form->field($model, 'descriptions')->textarea(['rows' => 4]) ?>
    </div>

    <ul class="nav nav-tabs create_property_title"> <li class="active"><a> امکانات </a></li> </ul>

    <div class="facility-box table-responsive">

          <?php foreach($facilities as $facility): ?>
            <?php
            $facilities_id = explode(',', $model->facilities_id);
            $checked = (in_array($facility->id,$facilities_id)) ? "checked" : ""; ?>
            <li class="col-sm-2">
            <div class="checkbox">
              <label>
                  <input type="checkbox" name="Property[facilities_id][]" value= "<?= $facility->id ?>" <?= $checked ?>>
                  <i class="input-helper"></i>
                  <?= $facility->name ?>
              </label>
          </div>
        </li>
        <?php endforeach; ?>
    </div>

    <br><br>
    <ul class="nav nav-tabs create_property_title"> <li class="active"><a> تصاویر ملک </a></li> </ul>

    <?php
    $findImage = Pictures::find()->where(['agahi_id' => $model->id, 'user_id' => Yii::$app->user->id])->all();
    $allimage = array();
    $key = ArrayHelper::getColumn($findImage,'id');
    foreach ($findImage as $index => $eachimage) {
        $baseurl = \Yii::$app->request->BaseUrl;
        $image_url = $baseurl.$eachimage['src'];
        $im = explode(',', $image_url);
        $allimage[] = Html::img("/$im[1]",  ['class'=>'file-preview-image']);
    }

    echo $form->field($model, 'file')->widget(FileInput::className(), [
        'options' => ['multiple' => true, 'accept' => 'image/*',],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/property/upload']),
            'maxFileCount' => 4,
            'previewFileType' => 'image/*',
            'initialPreview'=>$allimage,
            'initialPreviewConfig' => [
                isset($findImage[0]) ? ['caption' => "{$key[0]}", 'url' => Url::to(['/property/delsingle','key'=>$key[0],'id'=>$model->id]), 'key' => $findImage[0]['id']] : null,
                isset($findImage[1]) ? ['caption' => "{$key[1]}", 'url' => Url::to(['/property/delsingle','key'=>$key[1],'id'=>$model->id]), 'key' => $findImage[1]['id']] : null,
                isset($findImage[2]) ? ['caption' => "{$key[2]}", 'url' => Url::to(['/property/delsingle','key'=>$key[2],'id'=>$model->id]), 'key' => $findImage[2]['id']] : null,
                isset($findImage[3]) ? ['caption' => "{$key[3]}", 'url' => Url::to(['/property/delsingle','key'=>$key[3],'id'=>$model->id]), 'key' => $findImage[3]['id']] : null,
                isset($findImage[4]) ? ['caption' => "{$key[4]}", 'url' => Url::to(['/property/delsingle','key'=>$key[4],'id'=>$model->id]), 'key' => $findImage[4]['id']] : null,
            ],
            'overwriteInitial' => false,
            'maxFileSize'=>5120,
        ]
    ]);
    ?>

    <?php
    $js = <<< 'SCRIPT'
            var $input = $("#property-file");
            $input.fileinput({
                uploadUrl: "#", // No need server upload action
                uploadAsync: false,
                showUpload: false, // hide upload button
                showRemove: false, // hide remove button
                maxFileCount: 4
            })
            .on("filebatchselected", function(event, files) {
                $input.fileinput("upload");
            });
SCRIPT;
    $this->registerJs($js);
    ?>


    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
