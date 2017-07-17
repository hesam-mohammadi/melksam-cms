<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<section id="main__content">
    <div class="row quick-stats-c clearfix">
      <div class="col-xs-3">
          <div class="rmd-stats__item mdc-bg-teal-400">
              <h2>374</h2>
              <small><i class="zmdi zmdi-eye"></i> کل بازدید ها </small>
          </div>
      </div>
      <div class="col-xs-3">
          <div class="rmd-stats__item mdc-bg-amber-400">
              <h2><?= $messages ?></h2>
              <small><i class="zmdi zmdi-email"></i> کل پیام ها</small>
          </div>
      </div>
      <div class="col-xs-3">
          <div class="rmd-stats__item mdc-bg-purple-400">
              <h2><?= $properties ?></h2>
              <small><i class="zmdi zmdi-folder"></i> کل املاک  </small>
          </div>
      </div>
      <div class="col-xs-3">
          <div class="rmd-stats__item mdc-bg-cyan-400">
              <h2><?= $users ?></h2>
              <small><i class="zmdi zmdi-accounts"></i>  کل کاربران</small>
          </div>
      </div>
    </div>

        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card__header">
                        <h2>جدید ترین املاک</h2>
                        <small>لیست آخرین املاک ثبت شده در سایت</small>
                    </div>

                    <div class="list-group">
                        <?php foreach($latestpr as $property): ?>
                          <?php $pictures = \backend\models\Pictures::find()->where(['agahi_id' => $property->id])->asArray()->all(); ?>
                        <a href="/admin/property/view?id=<?=$property->id?>" class="list-group-item media">
                            <div class="pull-right">
                              <?php if($pictures==null): ?>
                                  <img src="<?=Yii::$app->homeUrl;?>uploads/no_image.jpg" class="list-group__img" width="60" alt="<?= $property->dealingType->name ?> <?= $property->propertyType->name ?> <?= $property->area_size ?> متری در <?= $property->city->name?>">
                              <?php else: ?>
                                  <?php
                                    $pic = explode(',', $pictures[0]['src']);?>
                                  <img src="<?= '/'.$pic[1] ?>" alt="<?= $property->dealingType->name ?> <?= $property->propertyType->name ?> <?= $property->area_size ?> متری در <?= $property->city->name?>" class="list-group__img" width="60">
                              <?php endif ?>
                            </div>
                            <div class="media-body list-group__text">
                                <strong><?= $property->dealingType->name ?> <?= $property->propertyType->name ?> <?= $property->area_size ?> متری</strong>
                                <small><?= $property->city->name?>، <?= $property->region->name; ?> - کد ملک: <?= $property->id; ?> (<?= Yii::$app->formatter->asRelativeTime($property->created_at); ?>)</small>
                            </div>
                        </a>
                      <?php endforeach; ?>

                        <a class="view-more" href="/admin/property">
                            مشاهده لیست کامل
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header">
                        <h2>Upcoming Appointments</h2>
                        <small>Etiam porta sem malesuada magna mollis euismod</small>
                    </div>

                    <div class="list-group">
                        <a class="list-group-item media" href="index.html">
                            <div class="pull-right">
                                <div class="event-date">
                                    <span class="event-date__day">24</span>
                                    <span class="event-date__month-time">Jul 05:00</span>
                                </div>
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Vestibulum ligula porta felis euismod</strong>
                                <small>Praesent commodo cursus magnavel scelerisque nisl consectetur</small>
                            </div>
                        </a>

                        <a class="list-group-item media" href="index.html">
                            <div class="pull-right">
                                <div class="event-date">
                                    <span class="event-date__day">30</span>
                                    <span class="event-date__month-time">Jul 14:15</span>
                                </div>
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Porta gravida eget metus</strong>
                                <small>Consectetur adipiscing elit</small>
                            </div>
                        </a>

                        <a class="list-group-item media" href="index.html">
                            <div class="pull-right">
                                <div class="event-date">
                                    <span class="event-date__day">02</span>
                                    <span class="event-date__month-time">Aug 08:30</span>
                                </div>
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Maecenas faucibus mollis</strong>
                                <small>Ligula idporta felis euismod semper</small>
                            </div>
                        </a>

                        <a class="list-group-item media" href="index.html">
                            <div class="pull-right">
                                <div class="event-date">
                                    <span class="event-date__day">13</span>
                                    <span class="event-date__month-time">Aug 09:00</span>
                                </div>
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Lorem ipsum dolor sit amet</strong>
                                <small>Etiam porta sem malesuada magna mollis euismod</small>
                            </div>
                        </a>

                        <a class="list-group-item media" href="index.html">
                            <div class="pull-right">
                                <div class="event-date">
                                    <span class="event-date__day">15</span>
                                    <span class="event-date__month-time">Aug 14:10</span>
                                </div>
                            </div>
                            <div class="media-body list-group__text">
                                <strong>Donec sed odio dui</strong>
                                <small>Sagittis lacus augue laoreet rutrum faucibus</small>
                            </div>
                        </a>

                        <a class="view-more" href="index.html">
                            View all listings
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card__header">
                        <h2>Tasks Lists</h2>
                        <small>Duis mollis estnon commodo luctus nisi erat porttitor</small>
                    </div>

                    <div class="list-group tasks-lists">
                        <div class="list-group-item">
                            <div class="checkbox checkbox--char">
                                <label>
                                    <input type="checkbox">
                                    <span class="checkbox__helper"><i class="mdc-bg-amber-400">A</i></span>
                                    <span class="tasks-list__info">
                                        Aivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor
                                        <small class="text-muted">Today at 8.30 AM</small>
                                    </span>
                                </label>
                            </div>

                            <div class="list-group__attrs">
                                <div>#Apartments</div>
                                <div>!!!</div>
                            </div>

                            <div class="actions list-group__actions">
                                <div class="dropdown">
                                    <a href="index.html" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="index.html">Mark as done</a></li>
                                        <li><a href="index.html">Edit</a></li>
                                        <li><a href="index.html" data-demo-action="delete-listing">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="checkbox checkbox--char">
                                <label>
                                    <input type="checkbox">
                                    <span class="checkbox__helper"><i class="mdc-bg-blue-400">N</i></span>
                                    <span class="tasks-list__info">
                                        Nullam id dolor id nibh ultricies vehicula ut id elit
                                        <small class="text-muted">Today at 12.30 PM</small>
                                    </span>
                                </label>
                            </div>

                            <div class="list-group__attrs">
                                <div>#Clients</div>
                                <div>!!</div>
                            </div>

                            <div class="actions list-group__actions">
                                <div class="dropdown">
                                    <a href="index.html" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="index.html">Mark as done</a></li>
                                        <li><a href="index.html">Edit</a></li>
                                        <li><a href="index.html" data-demo-action="delete-listing">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="checkbox checkbox--char">
                                <label>
                                    <input type="checkbox">
                                    <span class="checkbox__helper"><i class="mdc-bg-purple-400">C</i></span>
                                    <span class="tasks-list__info">
                                        Cras mattis consectetur purus sit amet fermentum
                                        <small class="text-muted">Tomorrow at 10.30 AM</small>
                                    </span>
                                </label>
                            </div>

                            <div class="list-group__attrs">
                                <div>#Clients</div>
                                <div>!!</div>
                            </div>

                            <div class="actions list-group__actions">
                                <div class="dropdown">
                                    <a href="index.html" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="index.html">Mark as done</a></li>
                                        <li><a href="index.html">Edit</a></li>
                                        <li><a href="index.html" data-demo-action="delete-listing">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="checkbox checkbox--char">
                                <label>
                                    <input type="checkbox">
                                    <span class="checkbox__helper"><i class="mdc-bg-green-400">M</i></span>
                                    <span class="tasks-list__info">
                                        Maecenas sed diam eget risus varius blandit sit amet non magna aecen faucibus mollis interdum Aenean.
                                        <small class="text-muted">Tomorrow at 05.10 PM</small>
                                    </span>
                                </label>
                            </div>

                            <div class="list-group__attrs">
                                <div>#Marketing</div>
                                <div>!!!</div>
                            </div>

                            <div class="actions list-group__actions">
                                <div class="dropdown">
                                    <a href="index.html" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="index.html">Mark as done</a></li>
                                        <li><a href="index.html">Edit</a></li>
                                        <li><a href="index.html" data-demo-action="delete-listing">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="list-group-item">
                            <div class="checkbox checkbox--char">
                                <label>
                                    <input type="checkbox">
                                    <span class="checkbox__helper"><i class="mdc-bg-blue-grey-400">I</i></span>
                                    <span class="tasks-list__info">
                                        Integer posuere erat a ante venenatis dapibus posuere velit aliquet
                                        <small class="text-muted">05/08/2016 at 08.00 AM</small>
                                    </span>
                                </label>
                            </div>

                            <div class="list-group__attrs">
                                <div>#Mortgage</div>
                                <div>!</div>
                            </div>

                            <div class="actions list-group__actions">
                                <div class="dropdown">
                                    <a href="index.html" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="index.html">Mark as done</a></li>
                                        <li><a href="index.html">Edit</a></li>
                                        <li><a href="index.html" data-demo-action="delete-listing">Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <a class="view-more" href="tasks-lists.html">
                            View all tasks lists
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
              <div class="card">
                  <div class="card__header">
                      <h2>جدیدترین کاربران</h2>
                      <small>لیست آخرین کاربران ثبت نام شده در سایت</small>
                  </div>

                  <div class="list-group">
                      <?php foreach($latestuser as $user): ?>
                      <a class="list-group-item media" href="/admin/user/view?id=<?=$user->id?>">
                          <div class="media-body list-group__text">
                              <strong><?=$user->email?></strong>
                              <small><?= Yii::$app->formatter->asRelativeTime($user->created_at); ?></small>
                          </div>
                      </a>
                    <?php endforeach; ?>

                      <a class="view-more" href="/admin/user">
                          مشاهده لیست کامل
                      </a>
                  </div>
              </div>
              
                <div class="card">
                    <div class="card__header">
                        <h2>جدیدترین پیام ها</h2>
                        <small>لیست آخرین پیام های ارسال شده توسط کاربران</small>
                    </div>

                    <div class="list-group">
                        <?php foreach($latestmsg as $message): ?>
                        <div class="list-group-item media">
                            <div class="pull-right">
                                <?php if($message->status == 1): ?>
                                <div class="leads-status-alt mdc-bg-green-400">
                                    <i class="zmdi zmdi-check-all"></i>
                                </div>
                              <?php else: ?>
                                <div class="leads-status-alt mdc-bg-red-400">
                                    <i class="zmdi zmdi-close-circle"></i>
                                </div>
                              <?php endif; ?>
                            </div>

                            <div class="media-body list-group__text">
                                <strong><?= $message->name; ?> (بخش  <?= $message->section; ?>)</strong>

                                <small class="leads-info">
                                    <?= Yii::$app->formatter->asRelativeTime($message->created_at); ?>
                                </small>
                            </div>

                            <div class="actions list-group__actions">
                                <a href="index.html" data-toggle="dropdown"><i class="zmdi zmdi-more-vert"></i></a>

                                <ul class="dropdown-menu pull-right">
                                    <li><a href="/admin/inbox/view?id=<?=$message->id?>">نمایش پیام</a></li>
                                    <li><a href="/admin/property/view?id=<?=$message->property_id?>">نمایش ملک مربوطه</a></li>
                                </ul>
                            </div>
                        </div>
                      <?php endforeach; ?>
                        <a class="view-more" href="/admin/inbox">
                            مشاهده لیست کامل
                        </a>
                    </div>
                </div>

                <!-- Calendar -->
                <div class="card" id="calendar-widget">
                    <div class="card__header mdc-bg-teal-500">
                        <div class="calendar-widget__year"></div>
                        <div class="calendar-widget__day"></div>

                        <a class="btn mdc-bg-light-green-500 btn--circle btn--float" href="calendar.html">
                            <i class="zmdi zmdi-plus"></i>
                        </a>
                    </div>

                    <div class="calendar-widget__body"></div>
                </div>
            </div>
        </div>
        </section>
