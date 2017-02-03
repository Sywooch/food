<?php

namespace backend\controllers;

use Yii;
use common\models\ProfileCook;
use common\models\User;
use backend\models\ProfileCookSearch;
use backend\models\ProfileCookForm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

use backend\components\ctrait\AccessController;

class ProfileCookController extends Controller
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
        $searchModel = new ProfileCookSearch();
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

    public function actionCreate()
    {
        $profileCookForm = new ProfileCookForm();
        $profileCook = new ProfileCook();
        if (!empty(Yii::$app->request->get('id'))) {
            $profileCook->user_id = Yii::$app->request->get('id');
        }
        if (Yii::$app->request->post()) {
            if (
                $profileCook->load(Yii::$app->request->post())
            ) {
                if ($model = $profileCookForm->create($profileCook)) {
                    return $this->redirect(['view', 'id' => $model->user_id]);
                }
            }
        }
        return $this->render('create', [
            'profileCookForm' => $profileCookForm,
            'profileCook' => $profileCook,
        ]);
    }

    // public function actionCreatewithuser($id)
    // {
    //     $model = new ProfileCook();
    //     $user = User::findOne($id);
    //     $model->user_id = $user->id;

    //     if ($model->load(Yii::$app->request->post())) {
    //         $model->save();
    //         return $this->redirect(['user/view', 'id' => $model->user_id]);
    //     } else {
    //         return $this->render('createwithuser', [
    //             'model' => $model,
    //         ]);
    //     }
    // }

    public function actionUpdate($id)
    {
        $profileCookForm = new ProfileCookForm();
        $profileCook = ProfileCook::findOne($id);
        $user = User::findOne($id);
        if (Yii::$app->request->post()) {
            if (
                // $profileCookForm->load(Yii::$app->request->post()) &&
                $profileCook->load(Yii::$app->request->post())
            ) {
                if ($model = $profileCookForm->update($user, $profileCook)) {
                    return $this->redirect(['view', 'id' => $model->user_id]);
                }
            }
        }
        return $this->render('update', [
            // 'user' => $user,
            // 'profileCookForm' => $profileCookForm,
            'profileCook' => $profileCook,
            // 'kitchens' => ArrayHelper::map(Kitchen::find()->select(['id','header'])->all(),'id','header'),
        ]);
        // try {
        //     $model = $this->findModel($id);
        //     if ($model->load(Yii::$app->request->post())) {
        //         $model->save();
        //         $model->icon = UploadedFile::getInstance($model, 'icon');
        //         if ($model->del_icon) {
        //             $model->delFile();
        //             $model->save();
        //         }
        //         if ($model->icon && $model->validate(['icon'])) {
        //             $model->addFile();
        //             $model->save();
        //         }
        //         return $this->redirect(['view', 'id' => $model->user_id]);
        //     } else {
        //         return $this->render('update', [
        //             'model' => $model,
        //         ]);
        //     }
        // } catch (ErrorException $e) {
        //     $model->e = $e;
        //     return $this->render('update', [
        //         'model' => $model,
        //     ]);
        // }

    }

    /**
     * Deletes an existing ProfileCook model.
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
     * Finds the ProfileCook model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ProfileCook the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ProfileCook::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
