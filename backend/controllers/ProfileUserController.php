<?php

namespace backend\controllers;

use Yii;
use common\models\ProfileUser;
use common\models\User;
use common\models\Kitchen;
use common\models\KitchenUser;
use backend\models\ProfileUserSearch;
use backend\models\ProfileUserForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\base\ErrorException;

use backend\components\ctrait\AccessController;

class ProfileUserController extends Controller
{
    use AccessController;

    public function behaviors()
    {
        $return = [
            'verbs' => [
                'class' => VerbFilter::className(),
            ],
        ];
        $return = array_merge($return,$this->accessController());
        return $return;
    }

    public function actionIndex()
    {
        $searchModel = new ProfileUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $kitchenList = Kitchen::find()->select(['id','header'])->all();
        $kitchenList = ArrayHelper::map($kitchenList,'id','header');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'kitchenList' => $kitchenList,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionCreate()
    {
        $profileUserForm = new ProfileUserForm();
        $profileUser = new ProfileUser();
        if (!empty(Yii::$app->request->get('id'))) {
            $profileUser->user_id = Yii::$app->request->get('id');
        }
        if (Yii::$app->request->post()) {
            if (
                $profileUserForm->load(Yii::$app->request->post()) &&
                $profileUser->load(Yii::$app->request->post())
            ) {
                if ($model = $profileUserForm->create($profileUser)) {
                    return $this->redirect(['view', 'id' => $model->user_id]);
                }
            }
        }
        return $this->render('create', [
            'profileUserForm' => $profileUserForm,
            'profileUser' => $profileUser,
            'kitchens' => ArrayHelper::map(Kitchen::find()->select(['id','header'])->all(),'id','header'),
        ]);
    }

    public function actionUpdate($id)
    {
        $profileUserForm = new ProfileUserForm();
        $profileUser = ProfileUser::findOne($id);
        $user = User::findOne($id);
        $profileUserForm->kitchen = $user->kitchen;
        if (Yii::$app->request->post()) {
            if (
                $profileUserForm->load(Yii::$app->request->post()) &&
                $profileUser->load(Yii::$app->request->post())
            ) {
                if ($model = $profileUserForm->update($user, $profileUser)) {
                    return $this->redirect(['view', 'id' => $model->user_id]);
                }
            }
        }
        return $this->render('update', [
            'user' => $user,
            'profileUserForm' => $profileUserForm,
            'profileUser' => $profileUser,
            'kitchens' => ArrayHelper::map(Kitchen::find()->select(['id','header'])->all(),'id','header'),
        ]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = ProfileUser::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Запрашиваемая страница не найдена.');
        }
    }
}
