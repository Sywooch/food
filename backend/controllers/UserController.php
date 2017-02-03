<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\Notice;
use common\models\Message;
use common\models\Publication;
use backend\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use backend\models\UserForm;

use yii\data\ActiveDataProvider;
use yii\base\ErrorException;

use backend\components\ctrait\AccessController;


class UserController extends Controller
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
        $return = array_merge($return, $this->accessController());
        return $return;
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $notice = Notice::find()
            ->where(['user_id'=>$model->id])
            ->orderBy(['created_at' => SORT_DESC])
            ->offset(0)
            ->limit(10)
            ->asArray()
            ->all();
        $messageDataProvider = new ActiveDataProvider([
            'query' => Message::find()->where(['author' => $id])->orWhere(['recipient' => $id,]),
        ]);
        $publicationDataProvider = new ActiveDataProvider([
            'query' => Publication::find()->where(['user_id' => $id]),
        ]);
        return $this->render('view', [
            'model' => $model,
            'notice' => $notice,
            'messageDataProvider' => $messageDataProvider,
            'publicationDataProvider' => $publicationDataProvider,
        ]);
    }

    public function actionCreate()
    {
        $modelform = new UserForm();
        $modelform->scenario = 'create';
        $modelform->status = USER::STATUS_ACTIVE;
        $modelform->role = USER::ROLE_USER;
        $modelform->usertype = USER::TYPE_USER;
        if ($modelform->load(Yii::$app->request->post())) {
            if ($user = $modelform->signup()) {
                return $this->redirect(['view', 'id' => $user->id]);
            }
        }
        return $this->render('create', [
            'modelform' => $modelform,
        ]);
    }

    public function actionUpdate($id)
    {
        try {
            $model = $this->findModel($id);
            $modelform = new UserForm();
            $modelform->scenario = 'update';

            $modelform->username = $model->username;
            $modelform->email = $model->email;
            $modelform->usertype = $model->usertype;
            $modelform->status = $model->status;
            $modelform->role = $model->role;

            if ( $modelform->load(Yii::$app->request->post()) ) {
                if ( !$modelform->validate() ) {
                    throw new ErrorException("sadfasdf");
                }
                $model->username = $modelform->username;
                $model->email = $modelform->email;
                $model->usertype = $modelform->usertype;
                $model->status = $modelform->status;
                $model->role = $modelform->role;
                if ( !empty($modelform->newpassword) ) {
                    $model->setPassword($modelform->newpassword);
                }
                if (!$model->save()) throw new ErrorException("sadasd");
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'modelform' => $modelform,
                ]);
            }    
        } catch (ErrorException $e) {
            $modelform->e = $e;
            return $this->render('update', [
                'model' => $model,
                'modelform' => $modelform,
            ]);
        }
        // if ( $model->load(Yii::$app->request->post()) && $model->save() ) {
        //     return $this->redirect(['view', 'id' => $model->id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //         'modelform' => $modelform,
        //     ]);
        // }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        // $this->findModel($id)->delete();
        $model = $this->findModel($id);
        $model->status = User::STATUS_DELETED;
        $model->save();

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
