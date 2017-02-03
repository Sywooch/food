<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\PhonenumberSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Номера телефонов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phonenumber-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Добавить номер телефона', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'phonenumber',
            'user_id',
            // 'user.username',
            [
                'label' => 'Имя пользователя',
                'value' => 'user.username',
                'attribute' => 'user_name',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
