<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\ProfileUser */

$this->title = 'Редактирование профиля покупатля с ид.: ' . $profileUser->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Профили покупателе', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $profileUser->user_id, 'url' => ['view', 'id' => $profileUser->user_id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="profile-user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'profileUserForm' => $profileUserForm,
        'profileUser' => $profileUser,
        'kitchens' => $kitchens,
    ]) ?>

</div>
