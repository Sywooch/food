<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\jui\AutoComplete;
use common\models\NewsTag;

use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model common\models\News */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="news-form">

<?php  

// $listdata=NewsTag::find()
//     ->select(['id as value', 'header as label'])
//     ->asArray()
//     ->all();
// echo "<pre>";
// print_r($listdata);
// echo "</pre>";
// die();

?>


<?php
$this->registerJsFile(
    'js/newstagsearch.js',
    ['depends'=>'backend\assets\AppAsset']
);
?>

    <?php if ($model->e): ?>
        <p><?= $model->e->getMessage() ?></p>
    <?php endif ?>

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'header')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sid')->textInput(['maxlength' => true]) ?>

    <?php //= $form->field($model, 'text')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'text')->widget(CKEditor::className(), [
        'options' => ['rows' => 12],
        'preset' => 'basic'
    ]) ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>
    
    <?php //= $form->field($model, 'selectedNewstag')->checkboxList($newsTagAll) ?>

    <div class="form-group field-news-selectednewstag">
    <label class="control-label" for="news-selectednewstag">Теги новости</label>
    <div id="news-selectednewstag">
        <?= Html::checkboxList('News[selectedNewstag]', $newsTagAll, $newsTagAll, ['tag'=>false]); ?>
    <!-- <label><input type="checkbox" name="News[selectedNewstag][]" value="Акцизы"> Акцизы</label> -->
    </div>
    </div>


    <div class="form-group">
        <label class="control-label" for="searchnewstag">Добавление тега</label>
        <input type="text" id="searchnewstag" class="form-control" name="searchnewstag" value="" list="datanewstag">
        <datalist id="datanewstag"></datalist>
    </div>

    <?php
        if($model->imgsrc && file_exists(Yii::getAlias('@frontend/web/', $model->imgsrc)))
        { 
            echo Html::img(Yii::getAlias('@webfrontend') . $model->imgsrc, ['class'=>'img-responsive', 'id' => 'photo']);
            echo $form->field($model,'del_img')->checkBox(['class'=>'span-1']);
        }
    ?>

    <!-- Загрузка файла c Jcrop -->

    <!-- hidden crop params -->
    
    <?= $form->field($model, 'file')->fileInput(['id' => 'fileinput']) ?>

    <div class="form-group" id="filediv" style="display: none;">
        <img src="" id="fileimg">
        <!-- <div class="fileinfo"> -->
            <!-- <label>File size</label>  -->
            <input type="hidden" id="filesize" name="filesize">
            <!-- <label>File type</label>  -->
            <input type="hidden" id="filetype" name="filetype">

            <!-- <label>Image Width</label> -->
            <input type="hidden" id="iw" name="iw">
            <!-- <label>Image Height</label> -->
            <input type="hidden" id="ih" name="ih">
            <!-- <label>Preview Width</label> -->
            <input type="hidden" id="pw" name="pw">
            <!-- <label>Preview Height</label> -->
            <input type="hidden" id="ph" name="ph">

            <!-- <label>Area Width</label> -->
            <input type="hidden" id="aw" name="aw">
            <!-- <label>Area Height</label> -->
            <input type="hidden" id="ah" name="ah">
            <!-- <label>x1</label> -->
            <input type="hidden" id="x1" name="x1">
            <!-- <label>y1</label> -->
            <input type="hidden" id="y1" name="y1">
            <!-- <label>x2</label> -->
            <input type="hidden" id="x2" name="x2">
            <!-- <label>y2</label> -->
            <input type="hidden" id="y2" name="y2">
        <!-- </div> -->
    </div>

    <?php $this->registerJsFile('/js/previewFile.js', ['depends' => ['yii\web\YiiAsset','yii\bootstrap\BootstrapAsset'], 'position' => \yii\web\View::POS_END]); ?>
    
    <?php // $this->registerJsFile('/Jcrop/js/jquery.Jcrop.min.js', ['depends' => ['yii\web\YiiAsset','yii\bootstrap\BootstrapAsset'], 'position' => \yii\web\View::POS_END]); ?>
    <?php // $this->registerCssFile('/Jcrop/css/jquery.Jcrop.css', ['depends' => ['yii\web\YiiAsset','yii\bootstrap\BootstrapAsset'], 'position' => \yii\web\View::POS_END]); ?>
    <?php // $this->registerJsFile('/jQuery-File-Upload-master/js/vendor/jquery.ui.widget.js', ['depends' => ['yii\web\YiiAsset','yii\bootstrap\BootstrapAsset'], 'position' => \yii\web\View::POS_END]); ?>
    <?php // $this->registerJsFile('/jQuery-File-Upload-master/js/jquery.iframe-transport.js', ['depends' => ['yii\web\YiiAsset','yii\bootstrap\BootstrapAsset'], 'position' => \yii\web\View::POS_END]); ?>
    <?php // $this->registerJsFile('/jQuery-File-Upload-master/js/jquery.fileupload.js', ['depends' => ['yii\web\YiiAsset','yii\bootstrap\BootstrapAsset'], 'position' => \yii\web\View::POS_END]); ?>
    

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Добавить новость' : 'Сохранить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
