<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Phonenumber */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Номера телефонов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phonenumber-view">

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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_id',
            'viber',
            'vibernumber',
            'whatsapp',
            'whatsappnumber',
            'phonenumber',
            'show',
            'checked',
        ],
    ]) ?>

</div>
