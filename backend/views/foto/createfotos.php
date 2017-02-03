<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Foto */

$this->title = 'Добавить фотографии в альбом ' . $album->header;
$this->params['breadcrumbs'][] = ['label' => 'Фотографии', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="foto-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formfotos', [
        'model' => $model,
        'album' => $album,
    ]) ?>

</div>
