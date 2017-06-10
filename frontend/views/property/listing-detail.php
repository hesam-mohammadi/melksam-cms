</header>
<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\widgets\Pjax;

$this->title = \Yii::$app->name.' | '.$listing->dealingType->name.' '.$listing->propertyType->name.' '.$listing->area_size . ' متری در '.$listing->city->name.' ، '.$listing->region->name;

?>
<section class="section">
    <div class="container">
        <header class="section__title section__title-alt">
            <h2><?= $listing->dealingType->name ?> <?= $listing->propertyType->name ?> <?= $listing->area_size ?> متری</h2>
            <small><?= $listing->city->name?>، <?= $listing->region->name; ?></small>

            <div class="actions actions--section">
                <div class="actions__toggle">
                    <input type="checkbox">
                    <i class="zmdi zmdi-favorite-outline"></i>
                    <i class="zmdi zmdi-favorite"></i>
                </div>
                <a href="listing-detail.html" data-rmd-action="print"><i class="zmdi zmdi-print"></i></a>
                <div class="dropdown actions__email">
                    <a href="listing-detail.html" data-toggle="dropdown"><i class="zmdi zmdi-email"></i></a>

                    <div class="dropdown-menu stop-propagate">
                        <form>
                            <p><strong>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</strong></p>

                            <div class="clearfix"></div>

                            <div class="form-group form-group--float m-t-10">
                                <input type="text" class="form-control">
                                <label>Recipient Email Address</label>
                                <i class="form-group__bar"></i>
                            </div>
                            <div class="form-group form-group--float">
                                <textarea class="form-control textarea-autoheight">I came across this listing from Roost and thought of sharing with you.</textarea>
                                <label>Message (optional)</label>
                                <i class="form-group__bar"></i>
                            </div>

                            <div class="clearfix"></div>

                            <div class="m-t-15">
                                <button class="btn btn-primary">Send</button>
                                <a href="email/listing-mail.html" target="_blank" class="btn btn-link">View Email</a>
                            </div>
                        </form>
                    </div>
                </div>
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

                              <?php if($listing->pic==null): ?>
                                  <img src="<?=Yii::$app->homeUrl;?>uploads/no_image.jpg" class="img-responsive" alt="<?= $listing->dealingType->name ?> <?= $listing->propertyType->name ?> <?= $listing->area_size ?> متری در <?= $listing->city->name?>">
                              <?php else: ?>

                                  <?php $picture= explode(',',$listing->pic);
                                  $pic_count = count($picture);
                                    foreach($picture as $pic):
                                  ?>
                                  <a href="<?=Yii::$app->homeUrl;?><?= $pic ?>">
                                      <img src="<?=Yii::$app->homeUrl;?><?= $pic ?>" alt="<?= $listing->dealingType->name ?> <?= $listing->propertyType->name ?> <?= $listing->area_size ?> متری در <?= $listing->city->name?>">
                                      <div class="caption"> <i class="zmdi zmdi-collection-image"></i> <span class="img-count"><?= $pic_count ?></span> برای مشاهده تصویر در اندازه بزرگتر روی آن کلیک کنید</div>
                                  </a>
                              <?php endforeach;
                              endif ?>

                            </div>
                            <div class="tab-pane fade light-gallery" id="detail-media-floorplan">
                                <a href="<?=Yii::$app->homeUrl;?>img/demo/floor-plan.png">
                                    <img src="<?=Yii::$app->homeUrl;?>img/demo/floor-plan.png" alt="">
                                </a>
                            </div>
                            <div class="tab-pane fade" id="detail-media-map">
                                <div id="listing-map"></div>
                            </div>
                        </div>

                        <ul class="detail-media__nav hidden-print">
                            <li class="active"><a href="listing-detail.html#detail-media-images" data-toggle="tab"><i class="zmdi zmdi-collection-image"></i></a></li>
                            <li><a href="listing-detail.html#detail-media-floorplan" data-toggle="tab"><i class="zmdi zmdi-view-dashboard"></i></a></li>
                            <li><a href="listing-detail.html#detail-media-map" data-toggle="tab"><i class="zmdi zmdi-map"></i></a></li>
                        </ul>
                    </div>

                    <div class="detail-info">
                        <div class="detail-info__header clearfix">
                            <strong>
                                <?php
                                  switch($listing->dealing_type_id) {
                                    case 1:
                                    echo 'قیمت کل: '.$listing->total_price.' تومان' ;
                                    break;

                                    case 2:
                                    echo 'ودیعه: '.$listing->total_price.' تومان';
                                    break;

                                    case 3:
                                    echo 'مبلغ رهن کامل: '.$listing->total_price.' تومان';
                                    break;

                                    default:
                                    echo 'قیمت کل: '.$listing->total_price.' تومان';
                                  }
                                ?>
                            </strong>
                            <small>
                              <?php
                                switch($listing->dealing_type_id) {
                                  case 1:
                                  echo ' متری: '.$listing->price_per_meter_rent.' تومان';
                                  break;

                                  case 2:
                                  echo ' مبلغ اجاره ماهیانه: '.$listing->price_per_meter_rent.' تومان';
                                  break;

                                  case 8:
                                    echo ' مبلغ اجاره روزانه: '.$listing->price_per_meter_rent.' تومان';
                                  break;

                                  default:
                                    echo $listing->price_per_meter_rent;
                                }
                              ?>
                            </small>

                            <span><?= $listing->dealingType->name ?></span>
                        </div>

                        <ul class="detail-info__list clearfix">
                            <li>
                                <span>نوع سند</span>
                                <span><?= $listing->documentType->name ?></span>
                            </li>
                            <li>
                                <span>متراژ بنا</span>
                                <span><?= $listing->area_size.' متر مربع ' ?></span>
                            </li>
                            <li>
                                <span>وضعیت سکونت</span>
                                <span><?= $listing->residence_status ?></span>
                            </li>
                            <li>
                                <span>سن بنا</span>
                                <span><?= $listing->proeperty_age ?></span>
                            </li>
                            <li>
                                <span> نما</span>
                                <span><?= $listing->view->name ?></span>
                            </li>
                            <li>
                                <span> موقعیت جغرافیایی</span>
                                <span><?= $listing->geographical_pos ?></span>
                            </li>
                            <li>
                                <span> کف پوش</span>
                                <span><?= $listing->floorCovering->name ?></span>
                            </li>
                            <li>
                                <span> کابینت </span>
                                <span><?= $listing->cabinet->name ?></span>
                            </li>
                            <li>
                                <span>تعداد طبقات</span>
                                <span><?= $listing->number_of_floors ?></span>
                            </li>
                            <li>
                                <span>واحد در هر طبقه </span>
                                <span><?= $listing->number_of_units_in_floor ?></span>
                            </li>
                            <li>
                                <span>جمع واحدها</span>
                                <span><?= $listing->number_of_units ?></span>
                            </li>
                            <li>
                                <span>طبقه</span>
                                <span><?= $listing->floor_num ?></span>
                            </li>
                            <li>
                                <span>تعداد اتاق</span>
                                <span><?= $listing->number_of_rooms ?></span>
                            </li>
                            <li>
                                <span>سرویس بهداشتی</span>
                                <span><?= $listing->toilet_type ?></span>
                            </li>
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
                            $faci = explode(',', $listing->facilities_id);
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
                        <p><?= $listing->descriptions ?></p>

                        <h4>آدرس ملک</h4>
                        <?= $listing->address ?>
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
                            013 - 44511234
                        </div>


                            <?= $form->field($model, 'name')->textInput(['placeHolder' => 'نام و نام خانوادگی'])->label(false) ?>

                            <?= $form->field($model, 'phone_number')->textInput(['placeHolder' => 'شماره تماس'])->label(false) ?>

                            <?= $form->field($model, 'message')->textarea(['rows' => 2, 'placeHolder' => 'متن پیام خود را وارد کنید'])->label(false) ?>
                    </div>

                    <div class="card__footer">
                        <?= Html::submitButton('ارسال پیام', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        <button class="btn btn-link hidden-lg hidden-md" data-rmd-action="block-close" data-rmd-target="#inquire">لغو ارسال</button>
                    </div>
                <?php ActiveForm::end(); ?>
                <?php Pjax::end(); ?>

                <div class="card hidden-xs hidden-sm hidden-print">
                    <div class="card__header">
                        <h2>Agents representing</h2>
                        <small>Etiam porta sem malesuada magna mollis</small>
                    </div>
                    <div class="list-group">
                        <a class="list-group-item media" href="listing-detail.html">
                            <div class="pull-left">
                                <img src="<?=Yii::$app->homeUrl;?>img/demo/people/1.jpg" alt="" class="list-group__img img-circle" width="65" height="65">
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Sarah Zelermyer Diaz</strong>
                                <small class="list-group__text">+1-202-555-0121</small>
                                <div class="rmd-rate" data-rate-value="5" data-rate-readonly="true"></div>
                            </div>
                        </a>

                        <a class="list-group-item media" href="listing-detail.html">
                            <div class="pull-left">
                                <img src="<?=Yii::$app->homeUrl;?>img/demo/people/3.jpg" alt="" class="list-group__img img-circle" width="65" height="65">
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Malinda Hollaway</strong>
                                <small class="list-group__text">+1-202-555-0188</small>
                                <div class="rmd-rate" data-rate-value="5" data-rate-readonly="true"></div>
                            </div>
                        </a>

                        <div class="p-10"></div>
                    </div>
                </div>

                <div class="card hidden-xs hidden-sm hidden-print">
                    <div class="card__header">
                        <h2>املاک مشابه</h2>
                        <small>شاید از موارد زیر هم خوشتان بیاید...</small>
                    </div>

                    <div class="list-group">
                        <a href="listing-detail.html" class="list-group-item media">
                            <div class="pull-right">
                                <img src="<?=Yii::$app->homeUrl;?>img/demo/listing/thumbs/2.jpg" alt="" class="list-group__img" width="65">
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Vivamus sagittis lacus vel augue laoreet rutrum faucibus</strong>
                                <small>$810,000 . 04 Beds . 03 Baths</small>
                            </div>
                        </a>

                        <a href="listing-detail.html" class="list-group-item media">
                            <div class="pull-right">
                                <img src="<?=Yii::$app->homeUrl;?>img/demo/listing/thumbs/3.jpg" alt="" class="list-group__img" width="65">
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Fusce dapibus tellusac cursus</strong>
                                <small>$910,300 . 03 Beds . 02 Baths</small>
                            </div>
                        </a>

                        <a href="listing-detail.html" class="list-group-item media">
                            <div class="pull-right">
                                <img src="<?=Yii::$app->homeUrl;?>img/demo/listing/thumbs/4.jpg" alt="" class="list-group__img" width="65">
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Praesent commodo cursus magnavel scelerisque nisl</strong>
                                <small>$2,560,000 . 08 Beds . 07 Baths</small>
                            </div>
                        </a>

                        <a href="listing-detail.html" class="list-group-item media">
                            <div class="pull-right">
                                <img src="<?=Yii::$app->homeUrl;?>img/demo/listing/thumbs/5.jpg" alt="" class="list-group__img" width="65">
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Lorem ipsum dolor sitamet consectetur adipiscing elit</strong>
                                <small>$1,140,650 . 06 Beds . 03 Baths</small>
                            </div>
                        </a>

                        <a href="listing-detail.html" class="list-group-item media">
                            <div class="pull-right">
                                <img src="<?=Yii::$app->homeUrl;?>img/demo/listing/thumbs/6.jpg" alt="" class="list-group__img" width="65">
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Fusce dapibus accursus commodo</strong>
                                <small>$780,900 . 02 Beds . 02 Baths</small>
                            </div>
                        </a>

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
