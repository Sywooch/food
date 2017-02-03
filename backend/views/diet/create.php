<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Diet */

$this->title = 'Добавление диеты';
$this->params['breadcrumbs'][] = ['label' => 'Диеты', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="diet-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
