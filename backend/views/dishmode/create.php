<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Dishmode */

$this->title = 'Добавление вида блюда';
$this->params['breadcrumbs'][] = ['label' => 'Виды блюд', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="dishmode-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
