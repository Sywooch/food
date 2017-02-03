<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AlbumSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Альбомы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <p>
        <?= Html::a('Добавить альбом', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'header',
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
            'foto_id',
            [
                'format' => 'image',
                'label' => 'Обложка',
                'value' => function($data)
                {
                    return $data->foto_id?Yii::getAlias('@webfrontend') . $data->getSource('icon'):null;
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
