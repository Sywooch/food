<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Album */

$this->title = $model->header;
$this->params['breadcrumbs'][] = ['label' => 'Альбомы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="album-view">

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
            'header',
            'user_id',
            // 'user.username',
            [
                'label' => 'Имя пользователя',
                'value' => $model->user->username,
            ],
            'foto_id',
            [
                'label' => 'Обложка альбома',
                'value' => $model->foto?Yii::getAlias('@webfrontend').$model->foto->src:null,
                'format' => 'image',
                'visible' => $model->foto?true:false,
            ],
            [
                'label' => 'Фотографии альбома ' . 
                    Html::a('Добавить фотографии', ['foto/createfotos', 'id' => $model->id], ['class' => 'btn btn-success btn-xs']),
                'value' => $model->listImg,
                'format' => 'raw'
            ],
        ],
    ]) ?>

</div>
