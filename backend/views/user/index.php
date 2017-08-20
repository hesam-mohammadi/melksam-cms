<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Users');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create User'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'responsive'=>true,
        'hover'=>true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'username',
            'fname',
            'lname:ntext',
            // 'auth_key',
            // 'password_hash',
            // 'password_reset_token',
            'email:email',
            [
              'attribute' =>'userRole',
                    //filter is dropdown - static data
                    // 'filter'=> array('admin' => 'مدیر', 'user' => 'کاربر', 'agent' => 'مشاور'),
            ],
            // 'mobile',
            // 'gender',
            // 'city_id',
            'status:boolean',
            'created_at:date',
            // 'updated_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
