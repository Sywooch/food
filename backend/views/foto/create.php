<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Foto */

$this->title = 'Добавить фото';
$this->params['breadcrumbs'][] = ['label' => 'Фотографии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="foto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
