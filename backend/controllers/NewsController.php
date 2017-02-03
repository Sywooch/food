<?php

namespace backend\controllers;

use Yii;
use common\models\News;
use common\models\NewsTag;
use backend\models\NewsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

use yii\web\UploadedFile;
use yii\imagine\Image;
use common\components\resizeimg\ResizeImg;
use yii\base\ErrorException;

use backend\components\ctrait\AccessController;

class NewsController extends Controller
{
    use AccessController;

    public function behaviors()
    {
        $return = [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
        $return = array_merge($return,$this->accessController());
        return $return;
    }

    public function actionIndex()
    {
        $searchModel = new NewsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $tags = ArrayHelper::map(NewsTag::find()->all(), 'id' ,'header');
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tags' => $tags,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionCreate()
    {
        $model = new News();

        $newsTagAll = ArrayHelper::map($model->newsTag, 'header', 'header');

        try {
            if ($model->load(Yii::$app->request->post()) ) {
                if (!$model->save()) throw new ErrorException("Модель не сохранена");

                // Добавление тегов
                if (count($model->selectedNewstag)) {
                    $selectedNewstag = array_unique($model->selectedNewstag);
                    foreach ($selectedNewstag as $value) {
                        if (!empty($value)) {
                            if ( NewsTag::find()->where(['header'=>$value])->asArray()->one()) {
                                $newsTag = NewsTag::findOne(['header'=>$value]);
                                $model->link('newsTag',$newsTag);
                            }else
                            {
                                $newsTag = new NewsTag();
                                $newsTag->header = $value;
                                $newsTag->save();
                                $model->link('newsTag',$newsTag);
                            }
                        }
                    }
                }

                // Добавление изображения
                if (!$model->save()) throw new ErrorException("123");

                $model->file = UploadedFile::getInstance($model, 'file');
                if ($model->file != null)
                {
                    $model->addFile();
                    if (!$model->save()) throw new ErrorException("123");
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('create', [
                    'model' => $model,
                    'newsTagAll' => $newsTagAll,
                ]);
            }
        } catch (ErrorException $e) {
            echo $e->getMessage();
            die();
            return $this->render('create', [
                'model' => $model,
                'newsTagAll' => $newsTagAll,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->selectedNewstag = $model->newsTag;

        $newsTagAll = ArrayHelper::map($model->newsTag, 'header', 'header');

        try {
            if ($model->load(Yii::$app->request->post())) {
                if (!$model->save()) throw new ErrorException("Модель не сохранена");
                $model->unlinkAll('newsTag',true);
                $selectedNewstag = array_unique($model->selectedNewstag);
                foreach ($selectedNewstag as $value) {
                    if (!empty($value)) {
                        if ( NewsTag::find()->where(['header'=>$value])->asArray()->one()) {
                            $newsTag = NewsTag::findOne(['header'=>$value]);
                            $model->link('newsTag',$newsTag);
                        }else
                        {
                            $newsTag = new NewsTag();
                            $newsTag->header = $value;
                            $newsTag->save();
                            $model->link('newsTag',$newsTag);
                        }
                    }
                }
                $model->file = UploadedFile::getInstance($model, 'file');
                if($model->del_img)
                {
                    $model->delFile();
                }
                if ($model->file != null)
                {
                    $model->addFile();
                }
                if (!$model->save()) throw new ErrorException("123");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'newsTagAll' => $newsTagAll,
                ]);
            }
        } catch (ErrorException $e) {
            $model->e = $e;
            return $this->render('update', [
                'model' => $model,
                'newsTagAll' => $newsTagAll,
            ]);
        }
    }

    public function actionSearchnewstag($q)
    {
        $newsTag = NewsTag::find()
            ->select(['id','header'])
            ->filterWhere(['like', 'header', $q.'%', false])
            ->asArray()
            ->all();

        // echo $newsTag->createCommand()->sql;
        // echo $newsTag->createCommand()->getRawSql();

        foreach ($newsTag as $key => $value) {
            echo "<option>$value[header]</option>";
        }
    }

    /**
     * Deletes an existing News model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the News model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return News the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = News::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
