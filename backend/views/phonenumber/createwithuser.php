<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Phonenumber */

$this->title = 'Добавление номера телефона для пользователя ' . $user->username;
$this->params['breadcrumbs'][] = ['label' => 'Номера телефонов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="phonenumber-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formwithuser', [
        'model' => $model,
        'user' => $user,
    ]) ?>

</div>
