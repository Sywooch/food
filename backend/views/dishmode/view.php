<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Dishmode */

$this->title = $model->header;
$this->params['breadcrumbs'][] = ['label' => 'Виды блюд', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dishmode-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('К списку', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить', ['create', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить этот элемент?',
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
        ],
    ]) ?>

</div>
