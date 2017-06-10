<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use backend\models\DealingType;
use backend\models\DocumentType;
use backend\models\PropertyView;
use backend\models\PropertyType;
use backend\models\Cabinet;
use backend\models\FloorCovering;
use backend\models\Province;
use backend\models\Region;
use backend\models\Facilities;

/* @var $this yii\web\View */
/* @var $model backend\models\Property */
/* @var $form yii\widgets\ActiveForm */
$dealing_type = DealingType::find()->all();
$document_type = DocumentType::find()->all();
$view = PropertyView::find()->all();
$cabinet = Cabinet::find()->all();
$floor_covering = FloorCovering::find()->all();
$province_list = Province::find()->all();
$property_type = PropertyType::find()->all();
$facilities = Facilities::find()->all();
?>

<div class="property-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <ul class="nav nav-tabs create_property_title"> <li class="active"><a>مشخصات عمومی ملک</a></li> </ul>

    <div class="col-sm-6">
      <?= $form->field($model, 'dealing_type_id')->dropDownList(ArrayHelper::map($dealing_type,'id','name'), ['prompt'=>'-- انتخاب نوع معامله --']); ?>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'property_type_id')->dropDownList(ArrayHelper::map($property_type,'id','name'), ['prompt'=>'-- انتخاب نوع ملک --']); ?>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'document_type_id')->dropDownList(ArrayHelper::map($document_type,'id','name'), ['prompt'=>'-- انتخاب نوع سند --']); ?>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'owner_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-sm-4">
      <?php // Parent
        echo $form->field($model, 'province_id')->dropDownList(ArrayHelper::map(Province::find()->all(), 'id', 'name'), ['id'=>'cat-id']);
      ?>
    </div>
    <div class="col-sm-4">
      <?php
      // Child # 1
      echo $form->field($model, 'city_id')->widget(DepDrop::classname(), [
          'options'=>['id'=>'subcat-id'],
          'pluginOptions'=>[
              'depends'=>['cat-id'],
              'placeholder'=>'Select...',
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
              'placeholder'=>'Select...',
              'url'=>Url::to(['/site/prod'])
          ]
      ]);
      ?>
    </div>

    <div class="col-sm-12">
      <?= $form->field($model, 'address')->textarea(['rows' => 2]) ?>
    </div>

    <div class="col-sm-4">
      <?= $form->field($model, 'phone_number1')->textInput() ?>
    </div>

    <div class="col-sm-4">
      <?= $form->field($model, 'phone_number2')->textInput() ?>
    </div>

    <div class="col-sm-4">
      <?= $form->field($model, 'mobile_number')->textInput() ?>
    </div>

    <ul class="nav nav-tabs create_property_title"> <li class="active"><a>مشخصات اختصاصی ملک</a></li> </ul>

    <div class="col-sm-6">
      <?= $form->field($model, 'area_size')->textInput() ?>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'total_area')->textInput() ?>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'view_id')->dropDownList(ArrayHelper::map($view,'id','name'), ['prompt'=>'-- انتخاب نوع نما --']); ?>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
          <label>تعداد اتاق</label>
          <div class="btn-group btn-group-justified" data-toggle="buttons">
              <label class="btn">
                  <input type="radio" name="Property[number_of_rooms]" value="1">1
              </label>
              <label class="btn active">
                  <input type="radio" name="Property[number_of_rooms]" value="2" checked>2
              </label>
              <label class="btn">
                  <input type="radio" name="Property[number_of_rooms]" value="3">3
              </label>
              <label class="btn">
                  <input type="radio" name="Property[number_of_rooms]" value="4">4
              </label>
              <label class="btn">
                  <input type="radio" name="Property[number_of_rooms]" value="+4">4+
              </label>
          </div>
      </div>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'floor_num')->textInput() ?>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'number_of_floors')->textInput() ?>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'number_of_units_in_floor')->textInput() ?>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'number_of_units')->textInput() ?>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'residence_status')->dropDownList(['تخلیه' => 'تخلیه', 'مستاجر' => 'مستاجر', 'مالک' => 'مالک', '---' => '---'], ['prompt'=>'-- انتخاب وضعیت سکونت --']); ?>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
          <label>موقعیت جغرافیایی</label>
          <div class="btn-group btn-group-justified" data-toggle="buttons">
              <label class="btn">
                  <input type="radio" name="Property[geographical_pos]" value="شمالی"> شمالی
              </label>
              <label class="btn">
                  <input type="radio" name="Property[geographical_pos]" value="جنوبی">جنوبی
              </label>
              <label class="btn">
                  <input type="radio" name="Property[geographical_pos]" value="شرقی">شرقی
              </label>
              <label class="btn">
                  <input type="radio" name="Property[geographical_pos]" value="غربی">غربی
              </label>
          </div>
      </div>
    </div>

    <div class="col-sm-6">
      <?= $form->field($model, 'proeperty_age')->radioList(['example1' => 'نوساز', 'example2' => 'قدیمی']) ?>
    </div>

    <div class="col-sm-12">
      <?= $form->field($model, 'descriptions')->textarea(['rows' => 4]) ?>
    </div>
    <div class="col-sm-12">
      <div class="table-responsive property_table">
         <table class="table table-bordered">
           <thead class="panel-heading">
             <tr>
               <th>کابینت آشپزخانه</th>
               <th>سرویس بهداشتی</th>
               <th>کف پوش</th>
               <th>* قیمت متری / اجاره (تومان)</th>
               <th>* قیمت کل / ودیعه (تومان)</th>
             </tr>
           </thead>
           <tbody>
             <tr>
               <td><?= $form->field($model, 'cabinet_id')->dropDownList(ArrayHelper::map($cabinet,'id','name'), ['prompt'=>'-- انتخاب نوع کابینت --'])->label(false); ?></td>
               <td><?= $form->field($model, 'toilet_type')->dropDownList(['ایرانی' => 'ایرانی', 'فرنگی' => 'فرنگی', 'ایرانی - فرنگی' => 'ایرانی - فرنگی', '--' => '--'], ['prompt'=>'-- انتخاب سرویس بهداشتی --'])->label(false); ?></td>
               <td><?= $form->field($model, 'floor_covering_id')->dropDownList(ArrayHelper::map($floor_covering,'id','name'), ['prompt'=>'-- انتخاب نوع کف پوش--'])->label(false); ?></td>
               <td><?= $form->field($model, 'price_per_meter_rent')->textInput(['placeholder' => "مثال: 100000"])->label(false) ?></td>
               <td><?= $form->field($model, 'total_price')->textInput(['placeholder' => "مثال: 100000"])->label(false) ?></td>
             </tr>
           </tbody>
         </table>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
          <label>تعداد پارکینگ</label>
          <div class="btn-group btn-group-justified" data-toggle="buttons">
              <label class="btn">
                  <input type="radio" name="Property[number_of_parkings]" value="1">1
              </label>
              <label class="btn">
                  <input type="radio" name="Property[number_of_parkings]" value="2">2
              </label>
              <label class="btn">
                  <input type="radio" name="Property[number_of_parkings]" value="3">3
              </label>
              <label class="btn">
                  <input type="radio" name="Property[number_of_parkings]" value="+3">+3
              </label>
              <label class="btn active">
                  <input type="radio" name="Property[number_of_parkings]" value="0" checked> ندارد
              </label>
          </div>
      </div>
    </div>

    <div class="col-sm-6">
      <div class="form-group">
          <label>تعداد تلفن</label>
          <div class="btn-group btn-group-justified" data-toggle="buttons">
              <label class="btn">
                  <input type="radio" name="Property[telephone_line_count]" value="1">1
              </label>
              <label class="btn">
                  <input type="radio" name="Property[telephone_line_count]" value="2">2
              </label>
              <label class="btn">
                  <input type="radio" name="Property[telephone_line_count]" value="3">3
              </label>
              <label class="btn">
                  <input type="radio" name="Property[telephone_line_count]" value="+3">+3
              </label>
              <label class="btn active">
                  <input type="radio" name="Property[telephone_line_count]" value="0" checked> ندارد
              </label>
          </div>
      </div>
    </div>

    <ul class="nav nav-tabs create_property_title"> <li class="active"><a> امکانات </a></li> </ul>

    <div class="facility-box table-responsive">
          <?php foreach($facilities as $facility): ?>
            <li class="col-sm-2">
            <div class="checkbox">
              <label>
                  <input type="checkbox" name="Property[facilities_id][]" value= "<?= $facility->id ?>">
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
    echo $form->field($model, 'file')->widget(FileInput::className(), [
        'options' => ['multiple' => true, 'accept' => 'image/*',],
        'pluginOptions' => [
            'uploadUrl' => Url::to(['/property/upload']),
            'maxFileCount' => 4,
            'previewFileType' => 'image/*',
            'overwriteInitial' => false,
            'showUpload' => true,
            'showCaption' => true,
            'showRemove' => false,
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
    <?php
    $js = <<< 'SCRIPT'
$(".fileinput-remove-button").click(function(){
var value = 'remove';
var url = document.URL;
var value1 = url.substring(url.lastIndexOf('=') + 1);
    $.ajax({
       url: "/property/delpicture",
       type: 'post',
       data: {
                remove:value,
                id:value1,
                _csrf : '<?=Yii::$app->request->getCsrfToken()?>'
       },
       success: function (data) {
          if(value1){
          location.reload();
          }
       }
    });
});
SCRIPT;
    $this->registerJs($js);
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
