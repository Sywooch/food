<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfileCookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Профили кулинаров';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-cook-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить профиль кулинара', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'user_id',
            // 'user.username',
            [
                'label' => 'Имя пользователя',
                'attribute'=>'username',
                'value' => function($data)
                {
                    return $data->user->username;
                }
            ],
            [
                'label' => 'Роль',
                'attribute'=>'role',
                'value' => function($data)
                {
                    return User::$roleName[$data->user->role];
                },
                'filter' => User::$roleName,
            ],
            [
                'format' => 'image',
                'label' => 'Аватар',
                'value' => function($data) {
                    return $data->iconsrc?Yii::getAlias('@webfrontend') . $data->getIconsrc('icon'):null;
                },
            ],
            // 'region',
            // 'about:ntext',
            // 'costmin',
            // 'costfree',
            // 'costdelivery',
            // 'pickup',
            // 'workhome',
            // 'workevent',
            // 'callfrom',
            // 'callto',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
