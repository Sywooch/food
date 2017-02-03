<?php

namespace backend\controllers;

use Yii;
use common\models\Message;
use backend\models\MessageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\components\ctrait\AccessController;

/**
 * MessageController implements the CRUD actions for Message model.
 */
class MessageController extends Controller
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
        $return = array_merge($return,$this->accessController());
        return $return;
    }

    /**
     * Lists all Message models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MessageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Message model.
     * @param integer $author
     * @param integer $recipient
     * @param string $created_at
     * @return mixed
     */
    public function actionView($author, $recipient, $created_at)
    {
        return $this->render('view', [
            'model' => $this->findModel($author, $recipient, $created_at),
        ]);
    }

    /**
     * Creates a new Message model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Message();
        $model->read = 0;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'author' => $model->author, 'recipient' => $model->recipient, 'created_at' => $model->created_at]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Message model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $author
     * @param integer $recipient
     * @param string $created_at
     * @return mixed
     */
    public function actionUpdate($author, $recipient, $created_at)
    {
        $model = $this->findModel($author, $recipient, $created_at);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'author' => $model->author, 'recipient' => $model->recipient, 'created_at' => $model->created_at]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Message model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $author
     * @param integer $recipient
     * @param string $created_at
     * @return mixed
     */
    public function actionDelete($author, $recipient, $created_at)
    {
        $this->findModel($author, $recipient, $created_at)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Message model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $author
     * @param integer $recipient
     * @param string $created_at
     * @return Message the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($author, $recipient, $created_at)
    {
        if (($model = Message::findOne(['author' => $author, 'recipient' => $recipient, 'created_at' => $created_at])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
