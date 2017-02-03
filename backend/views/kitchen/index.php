<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\KitchenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Кухни';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kitchen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a('Добавть кухню', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!-- <h2>Поиск</h2> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <h2>Список</h2>
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
