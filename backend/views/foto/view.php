<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Foto */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Фотографии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="foto-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('К списку', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?php if ($model->e): ?>
        <p><?= $model->e->getMessage(); ?></p>
    <?php endif ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'album_id',
            'src',
            [
                'attribute'=>'Фотография',
                'value'=>Yii::getAlias('@webfrontend') . $model->src,
                'format' => ['image',],
                'visible' => $model->src? true:false,
            ],
        ],
    ]) ?>

</div>
