<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use common\models\News;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Новости';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать новость', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            'sid',
            'header',
            // 'text:ntext',
            'updated_at',
            'created_at',
            [
                'label' => 'Изображение',
                'value' => function($data) {
                    return $data->srcOf('icon')?Yii::getAlias('@webfrontend') . $data->srcOf('icon'):null;
                },
                'format' => 'image',
            ],
            [
                'attribute'=>'tag',
                'label' => 'Теги',
                'value' => function($data) {
                    if (count($data->newsTag)) {
                        $return = [];
                        foreach ($data->newsTag as $newsTag) {
                            $return[] = $newsTag->header;
                        }
                        return implode(' ', $return);
                    } else {
                        return null;
                    }
                },
                'format' => 'raw',
                'filter' => $tags,
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
