<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\ProfileCook */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Профили кулинаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-cook-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('К списку', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->user_id], [
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
            'user_id',
            [
                'attribute'=>'Аватар',
                'value'=> $model->iconsrc?Yii::getAlias('@webfrontend') . $model->getIconsrc('full'):null,
                'format' => [
                    'image',[
                        'width' => $model->icons['full']['width'],
                        'height' => $model->icons['full']['height'],
                    ]
                ],
            ],
            'region',
            'about:ntext',
            'costmin',
            'costfree',
            'costdelivery',
            'pickup',
            'workhome',
            'workevent',
            'callfrom',
            'callto',
        ],
    ]) ?>

</div>
