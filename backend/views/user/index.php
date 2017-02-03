<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- <div class="user-index"> -->

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'contentOptions' => ['style' => 'width:100px;'],
            ],
            // 'username',
            [
                'attribute'=>'username',
                'value' => function ($data) {
                    return Html::a(Html::encode($data->username) . '<br />' . Html::img($data->getIconsrc('icon')?Yii::getAlias('@webfrontend') . $data->getIconsrc('icon'):'/img/usericon.png'), Url::to(['view', 'id' => $data->id]));
                },
                'format' => 'raw',
            ],
            'email:email',
            [
                'attribute'=>'created_at',
                'value'=>function($data)
                {
                    return date('Y-m-d h:i:s', $data->created_at);
                },
                // 'filter' => \yii\jui\DatePicker::widget(['language' => 'ru', 'dateFormat' => 'yyyy-MM-dd']),
                // 'format' => 'html',
            ],
            // [
            //     'format' => 'image',
            //     'label' => 'Аватар',
            //     'value' => function($data)
            //     {
            //         return $data->getIconsrc('icon')?Yii::getAlias('@webfrontend') . $data->getIconsrc('icon'):null;
            //     },
            // ],

            [
                'attribute'=>'status',
                'value' => function($data)
                {
                    return User::$statusName[$data->status];
                },
                'filter' => User::$statusName,
            ],

            [
                'attribute'=>'usertype',
                'value' => function($data)
                {
                    return User::$usertypeName[$data->usertype];
                },
                'filter' => User::$usertypeName,
            ],
            [
                'attribute'=>'role',
                'value' => function($data)
                {
                    return User::$roleName[$data->role];
                },
                'filter' => User::$roleName,
            ],

            [
                'class' => 'yii\grid\ActionColumn',
            ],
        ],
    ]); ?>
<!-- </div> -->
