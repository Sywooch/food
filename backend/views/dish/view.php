<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Dish */

$this->title = "Блюдо: " . $model->product->header . ", пользователя: " . $model->product->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dish-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('К списку', ['index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Редактировать', ['update', 'id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->product_id], [
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
            [
                'label' => 'Блюдо пользователя с именем',
                'value' => $model->product->user->username,
            ],
            [
                'label' => 'Ид. товара (блюда)',
                'value' => $model->product->id,
            ],
            [
                'label' => 'Наименование блюда',
                'value' => $model->product->header,
            ],
            'product.price',
            'product.pricesale',
            [
                'label' => 'Вид блюда',
                'value' => $model->dishmode->header,
            ],
            [
                'label' => 'Диета',
                // 'value' => $model->diet->header,
                'value' => $model->diet? $model->diet->header : Html::encode('<span class="not-set">(не задано)</span>'),
            ],
            'diet.header',
            [
                'label' => 'Кухни',
                'value' => implode(', ',ArrayHelper::getColumn($model->kitchen,'header')),
            ],
            [
                'label' => 'Тип блюда',
                'value' => $model->dishtype->header,
            ],
            'product.time',
            'weight',
            'text:ntext',
        ],
    ]) ?>

</div>
