<?php

namespace backend\controllers;

use Yii;
use common\models\Phonenumber;
use backend\models\PhonenumberSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use common\models\User;

use backend\components\ctrait\AccessController;

/**
 * PhonenumberController implements the CRUD actions for Phonenumber model.
 */
class PhonenumberController extends Controller
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
     * Lists all Phonenumber models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PhonenumberSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Phonenumber model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Phonenumber();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionCreatewithuser($id)
    {
        try {
            $model = new Phonenumber();
            $user = User::findOne($id);
            if (!$user) throw new ErrorException("Пользователь с таким идентификатором не найден.");
            // $model->user = $user;
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('createwithuser', [
                    'model' => $model,
                    'user' => $user,
                ]);
            }
        } catch (ErrorException $e) {
            $model->e = $e;
            return $this->render('createwithuser', [
                'model' => $model,
                'user' => $user,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Phonenumber::findOne(['id' => $id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемый телефон с id ' . $id . ' не найден.');
        }
    }
}
