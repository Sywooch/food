<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model common\models\Album */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="album-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>
    
    <?= $form->field($model, 'foto_id')->radioList(
        ArrayHelper::map($model->fotos, 'id', 'src'),
        [
            'item' => function($index, $label, $name, $checked, $value) {
                return '<label style="display:inline">' .
                    '<input type="radio" name="' . $name . '" value="' . $value . '">' .
                    '<i></i>' .
                    '<span>' . Html::img(Yii::getAlias('@webfrontend') . $label, []) . '</span>';
                    '</label>';
            },
        ]
    ) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
