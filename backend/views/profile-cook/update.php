<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProfileCook */

$this->title = 'Редактирование профиля кулинара: ' . $profileCook->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Профили кулинаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $profileCook->user_id, 'url' => ['view', 'id' => $profileCook->user_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="profile-cook-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        // 'model' => $model,
        'profileCook' => $profileCook,
    ]) ?>

</div>
