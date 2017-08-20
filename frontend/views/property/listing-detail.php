</header>
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;
use yii\widgets\ListView;
$this->title = \frontend\models\Property::get_option('عنوان سایت').' | '.$model->dealingType->name.' '.$model->propertyType->name.' '.$model->area_size . ' متری در '.$model->city->name.' ، '.$model->region->name;
$this->registerMetaTag([
    'name' => 'description',
    'content' => $model->descriptions,
]);
?>
<section class="section">
    <div class="container">
        <header class="section__title section__title-alt">
            <h2><?= $model->dealingType->name ?> <?= $model->propertyType->name ?> <?= $model->area_size ?> متری</h2>
            <small><?= $model->city->name?>، <?= $model->region->name; ?></small>

            <div class="actions actions--section">
              <?php
              $reqcookies = Yii::$app->request->cookies;
              if ($reqcookies->has('fav-'.$model->id)) {
                $checked = 'checked';
              }
              else {
                $checked = '';
              }
              ?>
                <div class="actions__toggle">
                  <?php echo Html::hiddenInput('property_id', $model->id, ['class' => 'property_id']); ?>
                  <input type="checkbox" id="fav" <?=$checked?>>
                  <i class="zmdi zmdi-favorite-outline"></i>
                  <i class="zmdi zmdi-favorite"></i>
                </div>
                <a href="listing-detail.html" data-rmd-action="print"><i class="zmdi zmdi-print"></i></a>
                <div class="dropdown">
                    <a href="listing-detail.html" data-toggle="dropdown"><i class="zmdi zmdi-share"></i></a>

                    <div class="dropdown-menu pull-right rmd-share">
                        <div></div>
                    </div>
                </div>

            </div>
        </header>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="detail-media">
                        <div class="tab-content">
                            <div class="tab-pane fade in active light-gallery" id="detail-media-images">

                              <?php if($pictures==null): ?>
                                  <img src="<?=Yii::$app->homeUrl;?>uploads/no_image.jpg" class="img-responsive" alt="<?= $model->dealingType->name ?> <?= $model->propertyType->name ?> <?= $model->area_size ?> متری در <?= $model->city->name?>">
                              <?php else: ?>
                                  <?php
                                  foreach($pictures as $picture):
                                  $pic = explode(',', $picture->src);?>
                                  <a href="<?= '/'.$pic[0] ?>">
                                      <img src="<?= '/'.$pic[3] ?>" alt="<?= $model->dealingType->name ?> <?= $model->propertyType->name ?> <?= $model->area_size ?> متری در <?= $model->city->name?>">
                                      <div class="caption hidden-print"> برای مشاهده تصویر در اندازه بزرگتر روی آن کلیک کنید</div>
                                  </a>
                                <?php endforeach; ?>
                              <?php endif ?>

                            </div>
                        </div>

                        <ul class="detail-media__nav hidden-print">
                            <li class="active"><a href="listing-detail.html#detail-media-images" data-toggle="tab"><i class="zmdi zmdi-collection-image"></i> <?= count($pictures); ?></a></li>
                        </ul>
                    </div>

                    <div class="detail-info">
                        <div class="detail-info__header clearfix">
                            <strong>
                                <?php
                                  switch($model->dealing_type_id) {
                                    case 1:
                                    echo 'قیمت کل: '.$model->total_price.' تومان' ;
                                    break;

                                    case 2:
                                    echo 'ودیعه: '.$model->total_price.' تومان';
                                    break;

                                    case 3:
                                    echo 'مبلغ رهن کامل: '.$model->total_price.' تومان';
                                    break;

                                    default:
                                    echo 'قیمت کل: '.$model->total_price.' تومان';
                                  }
                                ?>
                            </strong>
                            <small>
                              <?php
                                switch($model->dealing_type_id) {
                                  case 1:
                                  echo ' متری: '.$model->price_per_meter_rent.' تومان';
                                  break;

                                  case 2:
                                  echo ' مبلغ اجاره ماهیانه: '.$model->price_per_meter_rent.' تومان';
                                  break;

                                  case 8:
                                    echo ' مبلغ اجاره روزانه: '.$model->price_per_meter_rent.' تومان';
                                  break;

                                  default:
                                    echo ' متری: '.$model->price_per_meter_rent.' تومان';
                                }
                              ?>
                            </small>

                            <span><?= $model->dealingType->name ?></span>
                        </div>

                        <ul class="detail-info__list clearfix">
                            <?php
                            if(isset($model->documentType->name)):?>
                              <li>
                                  <span>نوع سند</span>
                                  <span><?= $model->documentType->name ?></span>
                              </li>
                          <?php endif;
                            if(isset($model->area_size)):?>
                            <li>
                                <span>متراژ بنا</span>
                                <span><?= $model->area_size.' متر مربع ' ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->residence_status)):?>
                            <li>
                                <span>وضعیت سکونت</span>
                                <span><?= $model->residence_status ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->proeperty_age)):?>
                            <li>
                                <span>سن بنا</span>
                                <span><?= $model->proeperty_age ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->view->name)):?>
                            <li>
                                <span> نما</span>
                                <span><?= $model->view->name ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->geographical_pos)):?>
                            <li>
                                <span> موقعیت جغرافیایی</span>
                                <span><?= $model->geographical_pos ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->floorCovering->name)):?>
                            <li>
                                <span> کف پوش</span>
                                <span><?= $model->floorCovering->name ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->cabinet->name)):?>
                            <li>
                                <span> کابینت </span>
                                <span><?= $model->cabinet->name ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->number_of_floors)):?>
                            <li>
                                <span>تعداد طبقات</span>
                                <span><?= $model->number_of_floors ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->number_of_units_in_floor)):?>
                            <li>
                                <span>واحد در هر طبقه </span>
                                <span><?= $model->number_of_units_in_floor ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->number_of_units)):?>
                            <li>
                                <span>جمع واحدها</span>
                                <span><?= $model->number_of_units ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->floor_num)):?>
                            <li>
                                <span>طبقه</span>
                                <span><?= $model->floor_num ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->number_of_rooms)):?>
                            <li>
                                <span>تعداد اتاق</span>
                                <span><?= $model->number_of_rooms ?></span>
                            </li>
                          <?php endif;
                            if(isset($model->toilet_type)):?>
                            <li>
                                <span>سرویس بهداشتی</span>
                                <span><?= $model->toilet_type ?></span>
                            </li>
                          <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="card detail-amenities">
                    <div class="card__header">
                        <h2>امکانات</h2>
                        <small>این ملک دارای امکانات زیر می باشد</small>
                    </div>

                    <div class="card__body">
                        <ul class="detail-amenities__list">
                          <?php
                            $faci = explode(',', $model->facilities_id);
                            foreach ($faci as $facil) {
                              $facilities = \frontend\models\Facilities::find()->where(['id' => $facil])->all();
                              foreach ($facilities as $facility) {
                                if($facility->css_class != null) {
                                  echo '<li class="'.$facility->css_class.'">'.$facility->name.'</li>';
                                }
                                else {
                                  echo '<li class="mdc-bg-blue-grey-400">'.$facility->name.'</li>';
                                }

                              }

                            }
                          ?>
                        </ul>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header">
                        <h2>بررسی اجمالی ملک</h2>
                    </div>
                    <div class="card__body">
                        <p><?= $model->descriptions ?></p>

                        <h4>آدرس ملک</h4>
                        <?= $model->address ?>
                    </div>
                </div>

            </div>

            <div id="inquire" class="col-md-4 rmd-sidebar-mobile">
                <?php Pjax::begin(); ?>
                <?php $form = ActiveForm::begin(['options' => ['class' => 'card']]); ?>
                    <div class="card__header">
                        <h2>پرس و جو درباره این ملک</h2>
                        <small>برای دریافت اطلاعات بیشتر و بازدید از این ملک فرم زیر را تکمیل نموده و یا با شماره ی ذکر شده تماس بگیرید.</small>
                    </div>

                    <div class="card__body">
                        <div class="inquire__number">
                            <i class="zmdi zmdi-phone"></i>
                            <?= $model->phone_number1 ?>
                        </div>
                        <?= $form->field($inbox, 'name')->textInput(['placeHolder' => 'نام و نام خانوادگی'])->label(false) ?>
                        <?= $form->field($inbox, 'phone_number')->textInput(['placeHolder' => 'شماره تماس'])->label(false) ?>
                        <?= $form->field($inbox, 'message')->textarea(['rows' => 2, 'placeHolder' => 'متن پیام خود را وارد کنید'])->label(false) ?>
                    </div>

                    <div class="card__footer">
                        <?= Html::submitButton('ارسال پیام', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        <button class="btn btn-link hidden-lg hidden-md" data-rmd-action="block-close" data-rmd-target="#inquire">لغو ارسال</button>
                    </div>
                <?php ActiveForm::end(); ?>
                <?php Pjax::end(); ?>

                <div class="card hidden-xs hidden-sm hidden-print">
                    <div class="card__header">
                        <h2>املاک مشابه</h2>
                        <small>شاید از موارد زیر هم خوشتان بیاید...</small>
                    </div>

                    <div class="list-group">
                        <?php
                        echo ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemOptions' => ['class' => 'item'],
                            'itemView' => '_similar_item',
                            'summary'=> false,
                        ]);
                        ?>
                        <div class="p-10"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Listing Search -->
<button class="btn btn--action btn--circle hidden-md hidden-lg" data-rmd-action="block-open" data-rmd-target="#inquire">
    <i class="zmdi zmdi-phone"></i>
</button>

<?php
$js = <<< 'SCRIPT'
$("#fav").change(function(){
  var id = $(".property_id").val();
  $.ajax({
   url: "/property/fav",
   type: 'post',
   data: {
      id: id,
    },
 });
});
SCRIPT;
$this->registerJs($js);
?>
