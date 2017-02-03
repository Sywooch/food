<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\ProfileUser */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Профили покупателей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('К списку', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить новый', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->user_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->user_id], [
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
                'value'=> $model->iconsrc?Yii::getAlias('@webfrontend') . $model->iconsrc:null,
                'format' => ['image',['width' => $model->icons['full']['width'],'height'=>$model->icons['full']['height']]],
                // 'visible' => $model->iconsrc? true:false,
            ],
            [
                'label' => 'Номера телефонов ' . Html::a('Добавить номер', ['phonenumber/createwithuser', 'id' => $model->user->id], ['class' => 'btn btn-success btn-xs']),
                'value' => $model->user->phonenumberlist,
                'format' => 'raw'
            ],
            [
                'label' => 'Предпочтение к кухням',
                'value' => implode(', ',ArrayHelper::getColumn($model->user->kitchen,'header')),
            ],
        ],
    ]) ?>

</div>
