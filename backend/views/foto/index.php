<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\FotoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Фотографии';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="foto-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить фото', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'album_id',
            'src',
            [
                'format' => 'image',
                'label' => 'Иконка фото',
                'value' => function($data) {
                    return Yii::getAlias('@webfrontend') . $data->getSource('icon');
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
