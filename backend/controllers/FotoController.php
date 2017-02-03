<?php

namespace backend\controllers;

use Yii;
use common\models\Foto;
use backend\models\FotoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use yii\base\ErrorException;
use yii\web\UploadedFile;
use common\models\Album;

use backend\components\ctrait\AccessController;

/**
 * FotoController implements the CRUD actions for Foto model.
 */
class FotoController extends Controller
{
    use AccessController;
    /**
     * @inheritdoc
     */
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
        $return = array_merge($return, $this->accessController());
        return $return;
    }

    /**
     * Lists all Foto models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FotoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Foto model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Foto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Foto();

        try {
            if ($model->load(Yii::$app->request->post()) ) {

                $model->file = UploadedFile::getInstance($model, 'file');
                if (!$model->file) throw new ErrorException('2');

                $model->src = 'temp';
                if ($model->validate()) {
                    if (!$model->save()) throw new ErrorException('1');
                } else {
                    throw new ErrorException('11');
                }

                $model->addFile();
                if (!$model->save()) throw new ErrorException('3');

                return $this->redirect(['view', 'id' => $model->id]);
            }
            else
            {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        } catch (ErrorException $e) {
            return $this->render('create', [
                'model' => $model,
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }
    }

    public function actionCreatefotos($id)
    {
        try {
            $model = new Foto();

            $album = Album::findOne($id);
            if (!$album) throw new ErrorException("Альбом не найден");

            if ( Yii::$app->request->post() ) {

                $files = UploadedFile::getInstances($model, 'file');
                if (!$files) throw new ErrorException('2');

                foreach ($files as $value) {
                    $model = new Foto();
                    $model->load(Yii::$app->request->post());
                    $model->src = 'temp';
                    $model->file = $value;
                    if ($model->validate()) {
                        if (!$model->save()) throw new ErrorException('1');
                    } else {
                        throw new ErrorException('11');
                    }
                    $model->addFile();
                    if (!$model->save()) throw new ErrorException('3');
                }
                return $this->redirect(['album/view', 'id' => $album->id]);
            } else {
                return $this->render('createfotos', [
                    'model' => $model,
                    'album' => $album,
                ]);
            }
        } catch (ErrorException $e) {
            $model->e = $e;
            return $this->render('createfotos', [
                'model' => $model,
                'album' => $album,
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('create', [
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Updates an existing Foto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        try {
            if ($model->load(Yii::$app->request->post())) {

                $model->file = UploadedFile::getInstance($model, 'file');
                if ( $model->file && $model->file->tempName ) {
                    $model->addFile();
                }

                if (!$model->validate()) throw new ErrorException('11');
                if (!$model->save()) throw new ErrorException('1');

                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'e' => null,
                    'model' => $model,
                ]);
            }
        } catch (ErrorException $e) {
            return $this->render('update', [
                'e' => $e,
                'model' => $model,
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('update', [
        //         'e' => $e,
        //         'model' => $model,
        //     ]);
        // }
    }

    /**
     * Deletes an existing Foto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $transaction = Yii::$app->db->beginTransaction();
            $model = $this->findModel($id);
            if ($model->id == $model->album->foto_id) {
                throw new ErrorException("Это изображение удалить нельзя");
            }
            $model->delete();
            $model->delFile();
            $transaction->commit();
        } catch (ErrorException $e) {
            $transaction->rollBack();
            $model->e = $e;
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->render('view', [
                'model' => $model
            ]);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Foto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Foto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Foto::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
