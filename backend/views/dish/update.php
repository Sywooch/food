<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Dish */

$this->title = 'Редактирование блюда: ' . $model->product->header . ' пользователя ' . $model->product->user->username;
$this->params['breadcrumbs'][] = ['label' => 'Блюда', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->product->header, 'url' => ['view', 'id' => $model->product_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="dish-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dishmodes' => $dishmodes,
        'diets' => $diets,
        'kitchens' => $kitchens,
        'dishtypes' => $dishtypes,
    ]) ?>

</div>
