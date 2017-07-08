<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use frontend\models\PropertySearch;

?>
<div class="header__search container">

  <?php
  $searchModel = new PropertySearch();
  $form = ActiveForm::begin([
      'action' => ['search'],
      'method' => 'get',
      'fieldConfig' => [
        'template' => '{input}', // Leave only input (remove label, error and hint)
        'options' => [
            'tag' => false,
        ],
    ],
  ]); ?>
        <div class="search">
            <div class="search__type dropdown">
                <a> جستجوی ملک</a>
            </div>

            <div class="search__body">
                <?= $form->field($searchModel, 'q', [
                        'inputOptions' => [
                            'placeholder' => " استان، شهر یا محله مورد نظر خود را وارد کنید",
                            'class' => 'search__input',
                            'data-rmd-action' => "advanced-search-open",
                        ],
                    ])->label(false); ?>

                <div class="search__advanced">

                    <div class="col-sm-6">
                        <div class="form-group">
                        <label>نوع معامله</label>
                        <?php  $dealing_type= \frontend\models\DealingType::find()->all();
                               $listData=ArrayHelper::map($dealing_type,'id','name');
                              echo $form->field($searchModel, 'dealing_type_id')->dropDownList($listData,['prompt' => '-- همه موارد --', 'class' => 'select2']);
                        ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                          <label>نوع ملک    </label>
                        <?php  $proeprty_type= \frontend\models\PropertyType::find()->all();
                               $listData=ArrayHelper::map($proeprty_type,'id','name');
                              echo $form->field($searchModel, 'property_type_id')->dropDownList($listData,['prompt' => '-- همه موارد --', 'class' => 'select2']);
                        ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>قیمت کل (تومان)</label>
                            <?= $form->field($searchModel, 'max_price', [
                                    'inputOptions' => [
                                        'placeholder' => "حداکثر",
                                    ],
                                ]); ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>قیمت کل (تومان)</label>
                          <?= $form->field($searchModel, 'min_price', [
                                  'inputOptions' => [
                                      'placeholder' => "حداقل",
                                  ],
                              ]); ?>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label>تعداد اتاق خواب</label>
                            <div class="btn-group btn-group-justified" data-toggle="buttons">
                                <label class="btn">
                                    <input type="checkbox" name="number_of_rooms[]" id="bed1" value="1">1
                                </label>
                                <label class="btn">
                                    <input type="checkbox" name="number_of_rooms[]" id="bed2" value="2">2
                                </label>
                                <label class="btn">
                                    <input type="checkbox" name="number_of_rooms[]" id="bed3" value="3">3
                                </label>
                                <label class="btn">
                                    <input type="checkbox" name="number_of_rooms[]" id="bed4" value="4">4
                                </label>
                                <label class="btn">
                                    <input type="checkbox" name="number_of_rooms[]" id="bed5" value="4+">4+
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6">

                      <div class="form-group">
                          <label>متراژ</label>

                          <select class="select2" name="PropertySearch[area_size]">
                              <option value="">-- همه موارد --</option>
                              <option value="50">تا 50 متر</option>
                              <option value="50-100"> از 50 تا 100 متر</option>
                              <option value="100-150">از 100  تا 150 متر</option>
                              <option value="150-200">از 150 تا 200 متر</option>
                              <option value="200">از 200 متر به بالا</option>
                          </select>
                      </div>

                    </div>

                    <div class="col-xs-12 m-t-10">
                        <button class="btn btn-primary">Search</button>
                        <button class="btn btn-link" data-rmd-action="advanced-search-close">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
