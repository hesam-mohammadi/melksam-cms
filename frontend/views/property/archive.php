<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\ListView;
use frontend\models\PropertySearch;
?>
</header>
<div class="action-header">
    <div class="container">
        <div class="action-header__item action-header__item--search pull-right">
          <form action="search">
              <input class="hidden-xs" type="text" name="q" placeholder="استان، شهر یا محله مورد نظر خود را وارد کنید"><!-- For desktop -->
              <input class="visible-xs" type="text" placeholder="Search..."><!-- For mobile -->
              <button class="hidden-xs hidden-sm hidden-lg hidden-xl">Search</button>
          </form>
        </div>

        <div class="action-header__item action-header__views hidden-xs">
            <a href="listings-grid.html" class="zmdi zmdi-apps active"></a>
            <a href="listings-list.html" class="zmdi zmdi-view-list"></a>
            <a href="listings-map.html" class="zmdi zmdi-map"></a>
        </div>

        <div class="action-header__item action-header__item--sort hidden-xs">
            <span class="action-header__small">Sort by :</span>

            <select class="select2">
                <option>Featured listings</option>
                <option>Newest to oldest</option>
                <option>Oldest to Newest</option>
                <option>Price hight to low</option>
                <option>Price low to high</option>
                <option>Newest to Oldest</option>
                <option>No. of photos</option>
            </select>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <header class="section__title">
            <h2>Duis mollisest non commodo luctus nisierat porttito</h2>
            <small>Vestibulum id ligula porta felis euismod semper</small>
        </header>

        <div class="row listings-grid">
          <?php
              echo ListView::widget([
              'dataProvider' => $dataProvider,
              'itemView' => 'item_show',
          ]); ?>
        </div>
    </div>
</section>

<!-- Advanced Listing Search -->
<button class="btn btn--action btn--circle" data-rmd-action="block-open" data-rmd-target="#advanced-search">
    <i class="zmdi zmdi-search-for"></i>
</button>

<aside id="advanced-search" class="rmd-sidebar">
    <?php
    $searchModel = new PropertySearch();
    $form = ActiveForm::begin([
        'action' => ['search'],
        'method' => 'get',
        'fieldConfig' => [
          'template' => '{input}', // Leave only input (remove label, error and hint)
          'options' => [
              'tag' => false,
              'class' => 'card',
          ],
      ],
    ]); ?>
        <div class="card__header">
            <h2>جستجوی پیشرفته</h2>
        </div>

        <div class="card__body m-t-20">
            <div class="form-group">
              <label>نوع معامله</label>
              <?php  $dealing_type= \frontend\models\DealingType::find()->all();
                     $listData=ArrayHelper::map($dealing_type,'id','name');
                    echo $form->field($searchModel, 'dealing_type_id')->dropDownList($listData,['prompt' => '-- همه موارد --', 'class' => 'select2']);
              ?>
            </div>

            <div class="form-group">
              <label>نوع ملک    </label>
            <?php  $proeprty_type= \frontend\models\PropertyType::find()->all();
                   $listData=ArrayHelper::map($proeprty_type,'id','name');
                  echo $form->field($searchModel, 'property_type_id')->dropDownList($listData,['prompt' => '-- همه موارد --', 'class' => 'select2']);
            ?>
            </div>

            <div class="form-group">
              <label>قیمت کل (تومان)</label>
            <?= $form->field($searchModel, 'min_price', [
                    'inputOptions' => [
                        'placeholder' => "حداقل",
                    ],
                ]); ?>
            </div>

            <div class="form-group">
              <label>قیمت کل (تومان)</label>
              <?= $form->field($searchModel, 'max_price', [
                      'inputOptions' => [
                          'placeholder' => "حداکثر",
                      ],
                  ]); ?>
            </div>

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

        <div class="card__footer">
            <button class="btn btn-sm btn-primary">جستجو</button>
            <a href="#" class="btn btn-sm btn-link" data-rmd-action="block-close" data-rmd-target="#advanced-search">لغو</a>
        </div>
    <?php ActiveForm::end(); ?>
</aside>
