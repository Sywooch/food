<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Kitchen */

$this->title = 'Добавление кухни';
$this->params['breadcrumbs'][] = ['label' => 'Кухни', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="kitchen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
