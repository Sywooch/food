<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\News;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->header;
$this->params['breadcrumbs'][] = ['label' => 'Новости', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1>Новость: <?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Список Новостей', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Создать', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sid',
            'header',
            'text:ntext',
            'updated_at',
            'created_at',
            [
                'label' => 'Теги',
                'value' => implode(', ',ArrayHelper::getColumn($model->newsTag,'header')),
            ],
            // [
            //     'label' => 'Изображение',
            //     'value' => $model->existimg?Html::img(Yii::getAlias('@webfrontend') . $model->imgsrc, ['class'=>'img-responsive']):'',
            // ],
            [
                'attribute'=>'Изображение',
                'value'=>Yii::getAlias('@webfrontend') . $model->srcOf('full'),
                'format' => ['image',['width'=>News::$images['full']['width'],'height'=>News::$images['full']['height']]],
                'visible' => $model->imgsrc? true:false,
            ],
            // 'existimg',
        ],
    ]) ?>

</div>
