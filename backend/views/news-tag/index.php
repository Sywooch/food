<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewsTagSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Тэги новостей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-tag-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Создать тег новостей', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h2>Список тегов новостей</h2>
    <?php /*= ListView::widget([
        'dataProvider' => $dataProvider,
        'itemOptions' => ['class' => 'item'],
        'itemView' => function ($model, $key, $index, $widget) {
            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
        },
    ]) */?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sid',
            'header',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
