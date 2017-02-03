<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Publication */

$this->title = $model->header;
$this->params['breadcrumbs'][] = ['label' => 'Публикации', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="publication-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('К списку', ['index'], ['class' => 'btn btn-default']) ?>
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
    
    <?php 

    // echo "<pre>";
    // print_r($user->id);
    // echo "<pre>";
    // die();

     ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'sid',
            'header',
            'user_id',
            [
                'label' => 'Имя пользователя',
                // if code in controller: $user = $model->getUser()->asArray()->all(); // но так делать не надо:
                // 'value' => $user[0]['username'],
                // or
                'value' => $model->user->username,
            ],
            'created_at',
            'updated_at:datetime',
            'text:ntext',
        ],
    ]) ?>

</div>
