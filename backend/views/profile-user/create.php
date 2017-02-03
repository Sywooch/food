<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\ProfileUser */

$this->title = 'Добавление профиля покупателя';
$this->params['breadcrumbs'][] = ['label' => 'Профили покупателей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'profileUserForm' => $profileUserForm,
        'profileUser' => $profileUser,
        'kitchens' => $kitchens,
    ]) ?>

</div>
