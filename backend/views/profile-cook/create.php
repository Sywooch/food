<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProfileCook */

$this->title = 'Добавление профиля кулинара';
$this->params['breadcrumbs'][] = ['label' => 'Профили кулинаров', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-cook-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        // 'profileCookForm' => $profileCookForm,
        'profileCook' => $profileCook,
    ]) ?>

</div>
