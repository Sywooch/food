<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DishmodeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Виды блюд';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dishmode-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить вид блюда', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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
