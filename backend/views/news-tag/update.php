<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NewsTag */

$this->title = 'Редактирование тега новостей: ' . $model->header;
$this->params['breadcrumbs'][] = ['label' => 'Теги новостей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="news-tag-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
