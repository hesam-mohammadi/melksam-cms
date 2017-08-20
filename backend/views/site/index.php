<?php
/* @var $this yii\web\View */
use yii\widgets\listView;
use yii\widgets\Pjax;

$this->title = 'My Yii Application';
?>
<section id="main__content">
    <?php if(Yii::$app->user->can('مشاور')): ?>
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
  <?php endif; ?>

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
                        <h2>آخرین وظایف</h2>
                        <small>لیست جدید ترین وظایف ثبت شده</small>
                    </div>

                    <div class="list-group tasks-lists">
                        <?php $pjax= Pjax::begin(['id' => 'status_pjax']); ?>
                        <?= ListView::widget([
                            'dataProvider' => $tasksProvider,
                            'itemView' => '/tasks/_taskItem',
                            'summary' => false
                        ]); ?>
                        <?php Pjax::end(); ?>

                        <a class="view-more" href="admin/tasks">
                          مشاهده لیست کامل
                        </a>
                    </div>
                </div>
                <?php
                $script = <<< JS
                $('.checkbox input').click(function() {
                  var id = $(this).attr('id');
                  $.ajax({
                    type: "POST",
                    url: "admin/tasks/status",
                    data: {
                        id: id,
                        _csrf: yii.getCsrfToken(),
                    },
                    success: function() {
                      $.pjax.reload({container: '#status_pjax'});
                    }
                });
                });

                $('.done').click(function() {
                  var id = $(this).attr('id');
                  $.ajax({
                    type: "POST",
                    url: "admin/tasks/status",
                    data: {
                        id: id
                    },
                    success: function() {
                      $.pjax.reload({container: '#status_pjax'});
                    }
                });
                });
JS;
$this->registerJs($script);
                ?>
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
                                    <?php if($message->property_id != null):?><li><a href="/admin/property/view?id=<?=$message->property_id?>">نمایش ملک مربوطه</a></li><?php endif; ?>
                                </ul>
                            </div>
                        </div>
                      <?php endforeach; ?>
                        <a class="view-more" href="/admin/inbox">
                            مشاهده لیست کامل
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </section>
