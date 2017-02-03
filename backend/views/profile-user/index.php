<?php

use yii\helpers\Html;
use yii\grid\GridView;
use common\models\User;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ProfileUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Профили покупателей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить профиль покупателя', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'user_id',
            [
                'label'=>'Имя покупателя',
                'attribute'=>'username',
                'value' => 'user.username',
            ],
            [
                'label'=>'Роль покупателя',
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
