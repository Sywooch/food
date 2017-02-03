<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Message */

$this->title = $model->author;
$this->params['breadcrumbs'][] = ['label' => 'Messages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="message-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('К списку', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить новое', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'author' => $model->author, 'recipient' => $model->recipient, 'created_at' => $model->created_at], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'author' => $model->author, 'recipient' => $model->recipient, 'created_at' => $model->created_at], [
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
            'author',
            'recipient',
            'created_at',
            'read',
            'text:ntext',
        ],
    ]) ?>

</div>
