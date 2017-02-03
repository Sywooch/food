<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\User;

use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Пользователь: ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('К списку', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить (деактивировать)', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите деактивировать пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>


    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#user" data-toggle="tab">Пользователь</a></li>
        <li><a href="#profile" data-toggle="tab">Профиль</a></li>
        <?php if ($model->usertype === 'cook'): ?>
            <li><a href="#album" data-toggle="tab">Альбомы</a></li>
            <li><a href="#foto" data-toggle="tab">Фотографии</a></li>
            <li><a href="#publication" data-toggle="tab">Публикации</a></li>
        <?php endif ?>
        <li><a href="#message" data-toggle="tab">Сообщения</a></li>
        <li><a href="#notice" data-toggle="tab">Уведомлеиня</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div class="tab-pane active" id="user">
        <h2>Пользователь</h2>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'username',
                'auth_key',
                'password_hash',
                'password_reset_token',
                'email:email',
                // 'status',
                [
                    'label' => 'Статус',
                    'value' => USER::$statusName[$model->status],
                ],
                // 'created_at',
                [
                    'label' => 'Создан',
                    'value' => date('Y-m-d h:i:s', $model->created_at),
                ],
                // 'updated_at',
                [
                    'label' => 'Обновлен',
                    'value' => date('Y-m-d h:i:s', $model->updated_at),
                ],
                // 'usertype',
                [
                    'label' => 'Тип пользователя',
                    'value' => USER::$usertypeName[$model->usertype],
                ],
                [
                    'label' => 'Роль',
                    'value' => USER::$roleName[$model->role],
                ],
            ],
        ]) ?>

        </div>
        <div class="tab-pane" id="profile">

            <h2>Профиль <?= $model->usertype==='user'?'Покупателя':'Повара' ?></h2>
            <?php if (count($model->{'profile'.ucfirst($model->usertype)})): ?>
                <?php
                switch ($model->usertype) {
                    case 'cook':
                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'username',
                                [
                                    'label'=>'Аватар',
                                    'value'=> $model->iconsrc?$model->iconsrc:null,
                                    'format' => ['image',['width'=>80,'height'=>80]],
                                    // 'visible' => $model->iconsrc? true:false,
                                ],
                                'profileCook.region',
                                'profileCook.costmin',
                                'profileCook.costfree',
                                'profileCook.costdelivery',
                                'profileCook.pickup',
                                'profileCook.workhome',
                                'profileCook.workevent',
                                [
                                    'label' => 'Телефоны ' . 
                                        Html::a('Добавить номер', ['phonenumber/createwithuser', 'id' => $model->id], ['class' => 'btn btn-success btn-xs']) . ' ' . 
                                        Html::a('Просмотр номеров пользователя', ['phonenumber/index', 'PhonenumberSearch[user_id]' => $model->id], ['class' => 'btn btn-primary btn-xs']),
                                    'value' => $model->phonenumberlist,
                                ],
                                'profileCook.callfrom',
                                'profileCook.callto',
                                [
                                    'label' => 'Адреса ' . 
                                        Html::a('Добавить адрес', ['address/create', 'id' => $model->id], ['class' => 'btn btn-success btn-xs']) . ' ' . 
                                        Html::a('Просмотр адресов пользователя', ['address/index', 'AddressSearch[user_id]' => $model->id], ['class' => 'btn btn-primary btn-xs']),
                                    'value' => $model->addresslist,
                                ],
                                'profileCook.about:ntext',
                            ],
                        ]);
                        break;
                    case 'user':
                        echo DetailView::widget([
                            'model' => $model,
                            'attributes' => [
                                'username',
                                [
                                    'attribute'=>'Аватар',
                                    'value'=> $model->iconsrc?$model->iconsrc:null,
                                    'format' => ['image',['width'=>80,'height'=>80]],
                                    // 'visible' => $model->iconsrc? true:false,
                                ],
                                [
                                    'label' => 'Телефоны ' . 
                                        Html::a('Добавить номер', ['phonenumber/createwithuser', 'id' => $model->id], ['class' => 'btn btn-success btn-xs']) . ' ' . 
                                        Html::a('Просмотр номеров пользователя', ['phonenumber/index', 'PhonenumberSearch[user_id]' => $model->id], ['class' => 'btn btn-primary btn-xs']),
                                    'value' => $model->phonenumberlist,
                                ],
                                [
                                    'label' => 'Адреса ' . 
                                        Html::a('Добавить адрес', ['address/create', 'id' => $model->id], ['class' => 'btn btn-success btn-xs']) . ' ' . 
                                        Html::a('Просмотр адресов пользователя', ['address/index', 'AddressSearch[user_id]' => $model->id], ['class' => 'btn btn-primary btn-xs']),
                                    'value' => $model->addresslist,
                                ],
                                [
                                    'label' => 'Предпочтение к кухням',
                                    'value' => $model->kitchenlist,
                                    // implode(', ',ArrayHelper::getColumn($model->kitchen,'header')),
                                ],
                            ],
                        ]);

                        break;
                }
                ?>
                <p><?= Html::a('Редактировать профиль', ['profile-'.$model->usertype.'/update','id'=>$model->id], ['class' => 'btn btn-primary']) ?></p>
            <?php else: ?>
                <p class="not-set">нет профиля</p>
                <?= Html::a('Добавить профиль', ['profile-'.$model->usertype.'/create','id'=>$model->id], ['class' => 'btn btn-success']) ?>
            <?php endif ?>

        </div>
        <?php if ($model->usertype === 'cook'): ?>
            <div class="tab-pane" id="album">
                <h2>Альбомы</h2>
            </div>
            <div class="tab-pane" id="foto">
                <h2>Фотографии</h2>
            </div>
            <div class="tab-pane" id="publication">
                <h2>Публикации</h2>
                <?= GridView::widget([
                    'dataProvider' => $publicationDataProvider,
                    'columns' => [
                        'id',
                        'header',
                        'created_at',
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header'=>'Управление',
                            'template'=>'{view} {edit} {delete}',
                            'buttons' => [
                                'view' => function($url, $model)
                                {
                                    return Html::a(
                                        '<span class="glyphicon glyphicon-eye-open"></span>',
                                        [
                                            'publication/view',
                                            'id' => $model->id,
                                        ]
                                    );
                                },
                                'edit' => function($url, $model)
                                {
                                    return Html::a(
                                        '<span class="glyphicon glyphicon-pencil"></span>',
                                        [
                                            'publication/update',
                                            'id' => $model->id,
                                        ]
                                    );
                                },
                                'delete' => function($url, $model)
                                {
                                    return Html::a(
                                        '<span class="glyphicon glyphicon-trash"></span>',
                                        [
                                            'publication/delete',
                                            'id' => $model->id,
                                        ]
                                    );
                                },
                            ],
                        ],
                    ],
                ]); ?>
            </div>
        <?php endif ?>
        <div class="tab-pane" id="message">
            <h2>Сообщения</h2>
            <?= GridView::widget([
                'dataProvider' => $messageDataProvider,
                'columns' => [
                    'author',
                    'recipient',
                    'created_at',
                    'read',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header'=>'Управление',
                        'template'=>'{view} {edit} {delete}',
                        'buttons' => [
                            'view' => function($url, $model)
                            {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-eye-open"></span>',
                                    [
                                        'message/view',
                                        'author' => $model->author,
                                        'recipient' => $model->recipient,
                                        'created_at' => $model->created_at
                                    ]
                                );
                            },
                            'edit' => function($url, $model)
                            {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-pencil"></span>',
                                    [
                                        'message/edit',
                                        'author' => $model->author,
                                        'recipient' => $model->recipient,
                                        'created_at' => $model->created_at
                                    ]
                                );
                            },
                            'delete' => function($url, $model)
                            {
                                return Html::a(
                                    '<span class="glyphicon glyphicon-trash"></span>',
                                    [
                                        'message/delete',
                                        'author' => $model->author,
                                        'recipient' => $model->recipient,
                                        'created_at' => $model->created_at
                                    ]
                                );
                            },
                        ],
                    ],
                ],
            ]); ?>
        </div>
        <div class="tab-pane" id="notice">
            <h2>Последние уведомления пользователя, <?= Html::a('просмотреть все', ['notice/user', 'userid' => $model->id]) ?></h2>
            <?php if (count($notice)): ?>
                <?php foreach ($notice as $key => $value): ?>
                    <div>
                        <?= Html::a(Html::encode($value['text']), ['notice/view', 'id' => $value['id']], ['class' => 'profile-link']) ?>
                    </div>
                <?php endforeach ?>
            <?php else: ?>
                <p>Нет уведомлений.</p>
            <?php endif ?>
        </div>
    </div>

    <hr>




</div>
