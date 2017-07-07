<?php
use yii\bootstrap\ActiveForm;
?>
</header>
<div class="action-header">
    <div class="container">
        <div class="action-header__item action-header__item--search pull-left">
            <?php
            $searchModel = new \frontend\models\PropertySearch();
            $form = ActiveForm::begin([
                'action' => ['property/search'],
                'method' => 'post',
                'fieldConfig' => [
                  'template' => '{input}', // Leave only input (remove label, error and hint)
                  'options' => [
                      'tag' => false,
                  ],
              ],
            ]); ?>
            <?= $form->field($searchModel, 'q', [
                    'inputOptions' => [
                        'placeholder' => " استان، شهر یا محله مورد نظر خود را وارد کنید",
                        'class' => 'hidden-xs',
                    ],
                ])->label(false); ?>
                <?= $form->field($searchModel, 'q', [
                        'inputOptions' => [
                            'placeholder' => "جستجو کنید...",
                            'class' => 'visible-xs',
                        ],
                    ])->label(false); ?>
                    <button class="hidden-xs hidden-sm hidden-lg hidden-xl">Search</button>
              <?php ActiveForm::end(); ?>
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
              $myModels = $dataProvider->getModels();
              foreach ($myModels as $listings):
              $pictures = \backend\models\Pictures::find()->where(['agahi_id' => $listings->id])->asArray()->all();
            ?>
            <div class="col-sm-6 col-md-3">
            <div class="listings-grid__item">
                <a href="<?=\yii\helpers\Url::to(['property/listing-detail','id'=>$listings->id]) ?>">
                    <div class="listings-grid__main">
                      <?php if($pictures==null): ?>
                          <img src="<?=Yii::$app->homeUrl;?>uploads/no_image.jpg" class="img-responsive" alt="<?= $listings->dealingType->name ?> <?= $listings->propertyType->name ?> <?= $listings->area_size ?> متری در <?= $listings->city->name?>">
                      <?php else: ?>
                          <?php
                            $pic = explode(',', $pictures[0]['src']);?>
                          <img src="<?= '/'.$pic[1] ?>" alt="<?= $listings->dealingType->name ?> <?= $listings->propertyType->name ?> <?= $listings->area_size ?> متری در <?= $listings->city->name?>">

                      <?php endif ?>
                        <div class="listings-grid__price"><?=$listings->total_price?> تومان</div>
                    </div>

                    <div class="listings-grid__body">
                        <small><?= $listings->city->name?>، <?= $listings->region->name; ?></small>
                        <h5><?= $listings->dealingType->name ?> <?= $listings->propertyType->name ?> <?= $listings->area_size ?> متری</h5>
                    </div>

                    <ul class="listings-grid__attrs">
                        <li><i class="listings-grid__icon listings-grid__icon--bed"></i> <?= $listings->number_of_rooms; ?> خوابه </li>
                        <li><i class="listings-grid__icon listings-grid__icon--parking"></i> <?= $listings->number_of_parkings; ?> </li>
                    </ul>
                </a>

                <div class="actions listings-grid__favorite">
                  <?php
                  $reqcookies = Yii::$app->request->cookies;
                  if ($reqcookies->has('fav-'.$listings->id)) {
                    $checked = 'checked';
                  }
                  else {
                    $checked = '';
                  }
                  ?>
                    <div class="actions__toggle">
                        <input type="checkbox" class="fav" id="<?=$listings->id?>" <?=$checked?>>
                        <i class="zmdi zmdi-favorite-outline"></i>
                        <i class="zmdi zmdi-favorite"></i>
                    </div>
                </div>
            </div>
            </div>
          <?php endforeach; ?>

        </div>
    </div>
</section>

<!-- Advanced Listing Search -->
<button class="btn btn--action btn--circle" data-rmd-action="block-open" data-rmd-target="#advanced-search">
    <i class="zmdi zmdi-search-for"></i>
</button>

<aside id="advanced-search" class="rmd-sidebar">
    <form class="card">
        <div class="card__header">
            <h2>Advanced Property Search</h2>

            <div class="dropdown m-t-5">
                <a data-toggle="dropdown" href="listings-grid.html" class="text-muted">05 Saved Searches <i class="caret"></i></a>

                <ul class="dropdown-menu">
                    <li><a href="listings-grid.html">2012/05/01 - 1</a></li>
                    <li><a href="listings-grid.html">2012/05/01 - 2</a></li>
                    <li><a href="listings-grid.html">2012/06/12</a></li>
                    <li><a href="listings-grid.html">2012/08/19</a></li>
                    <li><a href="listings-grid.html">2012/08/20</a></li>
                </ul>
            </div>
        </div>

        <div class="card__body m-t-20">
            <div class="form-group form-group--float">
                <input type="text" class="form-control" value="New York, NY">
                <label class="fg-float">Location</label>
                <i class="form-group__bar"></i>
            </div>

            <div class="form-group">
                <label>Listing Type</label>
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn active">
                        <input type="radio" name="advanced-search-beds" id="rent" checked>Rent
                    </label>
                    <label class="btn">
                        <input type="radio" name="advanced-search-beds" id="buy">Buy
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Ownership Type</label>

                <select class="select2">
                    <option value="">Single Family Home</option>
                    <option value="">Condo</option>
                    <option value="">Townhome</option>
                    <option value="">Apartment Community</option>
                    <option value="">Room</option>
                </select>
            </div>

            <div class="form-group form-group--range">
                <label>Price Range</label>
                <div class="input-slider-values clearfix">
                    <div class="pull-left"><span>$</span><span id="property-price-upper"></span></div>
                    <div class="pull-right"><span>$</span><span id="property-price-lower"></span></div>
                </div>
                <div id="property-price-range"></div>
            </div>

            <div class="form-group form-group--range">
                <label>Area Size (sqft)</label>
                <div class="input-slider-values clearfix">
                    <div class="pull-left" id="property-area-upper"></div>
                    <div class="pull-right" id="property-area-lower"></div>
                </div>
                <div id="property-area-range"></div>
            </div>

            <div class="form-group">
                <label>Bedrooms</label>
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn">
                        <input type="checkbox" name="inner-search-beds" id="bed1">1
                    </label>
                    <label class="btn active">
                        <input type="checkbox" name="inner-search-beds" id="bed2" checked>2
                    </label>
                    <label class="btn">
                        <input type="checkbox" name="inner-search-beds" id="bed3">3
                    </label>
                    <label class="btn">
                        <input type="checkbox" name="inner-search-beds" id="bed4">4
                    </label>
                    <label class="btn">
                        <input type="checkbox" name="inner-search-beds" id="bed5">4+
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Bathrooms</label>
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn">
                        <input type="checkbox" name="inner-search-baths" id="bath1">1
                    </label>
                    <label class="btn active">
                        <input type="checkbox" name="inner-search-baths" id="bath2" checked>2
                    </label>
                    <label class="btn">
                        <input type="checkbox" name="inner-search-baths" id="bath3">3
                    </label>
                    <label class="btn">
                        <input type="checkbox" name="inner-search-baths" id="bath4">4
                    </label>
                    <label class="btn">
                        <input type="checkbox" name="inner-search-baths" id="bath5">4+
                    </label>
                </div>
            </div>

            <div class="form-group">
                <label>Garages</label>
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn">
                        <input type="checkbox" name="inner-search-garage" id="garage1">1
                    </label>
                    <label class="btn active">
                        <input type="checkbox" name="inner-search-garage" id="garage2" checked>2
                    </label>
                    <label class="btn">
                        <input type="checkbox" name="inner-search-garage" id="garage3">3
                    </label>
                    <label class="btn">
                        <input type="checkbox" name="inner-search-garage" id="garage4">4
                    </label>
                    <label class="btn">
                        <input type="checkbox" name="inner-search-garage" id="garage5">4+
                    </label>
                </div>
            </div>

            <div class="form-group form-group--range">
                <label>Lot Size (sqft)</label>
                <div class="input-slider-values clearfix">
                    <div class="pull-left" id="property-lot-upper"></div>
                    <div class="pull-right" id="property-lot-lower"></div>
                </div>
                <div id="property-lot-range"></div>
            </div>

            <div class="form-group form-group--range">
                <label>Year Built</label>
                <div class="input-slider-values clearfix">
                    <div class="pull-left" id="property-yb-upper"></div>
                    <div class="pull-right" id="property-yb-lower"></div>
                </div>
                <div id="property-year-built"></div>
            </div>
        </div>

        <div class="card__footer">
            <button class="btn btn-sm btn-primary">Search</button>
            <a href="listings-grid.html" class="btn btn-sm btn-link" data-rmd-action="block-close" data-rmd-target="#advanced-search">Save</a>
            <a href="listings-grid.html" class="btn btn-sm btn-link" data-rmd-action="block-close" data-rmd-target="#advanced-search">Cancel</a>
        </div>
    </form>
</aside>
