<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DietSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Диеты';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diet-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить диету', ['create'], ['class' => 'btn btn-success']) ?>
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
