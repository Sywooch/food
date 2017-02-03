<?php

namespace backend\controllers;

use Yii;
use common\models\Product;
use common\models\Dish;
use common\models\Dishtype;
use common\models\Dishmode;
use common\models\Diet;
use common\models\Kitchen;
use backend\models\DishSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\web\Response;
use yii\base\ErrorException;

use backend\components\ctrait\AccessController;

class DishController extends Controller
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
     * Lists all Dish models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DishSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Dish model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Dish model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Dish();
        
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        $diets = Diet::find(['id', 'header'])->asArray()->all();
        $diets = ArrayHelper::map($diets,'id','header');

        $dishtypes = Dishtype::find(['id', 'header'])->asArray()->all();
        $dishtypes = ArrayHelper::map($dishtypes,'id','header');

        $dishmodes = Dishmode::find(['id', 'header'])->asArray()->all();
        $dishmodes = ArrayHelper::map($dishmodes,'id','header');

        $kitchens = Kitchen::find(['id', 'header'])->asArray()->all();
        $kitchens = ArrayHelper::map($kitchens,'id','header');

        if ($model->load(Yii::$app->request->post())) {
            // Сохраняем модели: product, dish, много ко многим: kitchen
            // $transaction = Yii::$app->db->beginTransaction();
            try {
                // echo "<pre>";
                // print_r($model->kitchens);
                // echo "</pre>";
                // die();
                // Product
                $product = new Product();
                if ($product->load(Yii::$app->request->post())) {
                    if (!$product->save()) {
                        throw new ErrorException("false save product");
                    }
                } else {
                    throw new ErrorException("false load product");
                }
                // Dish - model
                $model->product_id = $product->id;
                if (!$model->save()) {
                    throw new ErrorException("false save model");
                }
                // Kitchen - много ко многим
                $model->unlinkAll('kitchen',true);
                foreach ($model->kitchens as $value) {
                    $kitchen = Kitchen::findOne($value);
                    $model->link('kitchen',$kitchen);
                }
                // $transaction->commit();
            } catch (ErrorException $e) {
                // $transaction->rollback();
                // echo $e->getMessage();
                // die();
                return $this->render('create', [
                    'model' => $model,
                    'diets' => $diets,
                    'kitchens' => $kitchens,
                    'dishtypes' => $dishtypes,
                    'dishmodes' => $dishmodes,
                ]);
            }
            return $this->redirect(['view', 'id' => $model->product_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'diets' => $diets,
                'kitchens' => $kitchens,
                'dishtypes' => $dishtypes,
                'dishmodes' => $dishmodes,
            ]);
        }
    }

    /**
     * Updates an existing Dish model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $dishmodes = Dishmode::find(['id', 'header'])->asArray()->all();
        $dishmodes = ArrayHelper::map($dishmodes,'id','header');

        $diets = Diet::find(['id', 'header'])->asArray()->all();
        $diets = ArrayHelper::map($diets,'id','header');

        $kitchens = Kitchen::find(['id', 'header'])->asArray()->all();
        $kitchens = ArrayHelper::map($kitchens,'id','header');

        $dishtypes = Dishtype::find(['id', 'header'])->asArray()->all();
        $dishtypes = ArrayHelper::map($dishtypes,'id','header');

        try {
            $product = new Product();
            if (!$model->load(Yii::$app->request->post())) throw new ErrorException("false load model");
            if (!$product->load(Yii::$app->request->post())) throw new ErrorException("false load product");

            if (!$product->save()) throw new ErrorException("false save model");
            if (!$model->save()) throw new ErrorException("false save model");

            $model->unlinkAll('kitchen',true);
            foreach ($model->kitchens as $value) {
                $kitchen = Kitchen::findOne($value);
                $model->link('kitchen',$kitchen);
            }
            return $this->redirect(['view', 'id' => $model->product_id]);
        } catch (ErrorException $e) {
            return $this->render('update', [
                'model' => $model,
                'dishmodes' => $dishmodes,
                'diets' => $diets,
                'kitchens' => $kitchens,
                'dishtypes' => $dishtypes,
            ]);
        }

        // if ($model->load(Yii::$app->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'id' => $model->product_id]);
        // } else {
        //     return $this->render('update', [
        //         'model' => $model,
        //         'dishmodes' => $dishmodes,
        //         'diets' => $diets,
        //         'kitchens' => $kitchens,
        //         'dishtypes' => $dishtypes,
        //     ]);
        // }
    }

    /**
     * Deletes an existing Dish model.
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
     * Finds the Dish model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Dish the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Dish::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
