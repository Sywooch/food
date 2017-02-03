<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\TypeDish */

$this->title = $model->header;
$this->params['breadcrumbs'][] = ['label' => 'Типы блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-dish-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('К списку', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавть', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
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
