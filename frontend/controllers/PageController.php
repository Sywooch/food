<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\Page;
use common\components\Tree;

class PageController extends Controller
{

	public function actionMainpage()
	{
		return $this->render('mainpage', [
		]);
	}
	
	public function actionView($sid)
	{
		$page = Page::find()->where(['sid'=>$sid])->one();
		$models = Page::find()->select(['id','pid','sid','header'])->asArray()->indexBy('id')->all();
		$mode = $models[$page->id];
		$branch[] = $mode;
		while (!is_null($mode['pid'])) {
			$mode = $models[$mode['pid']];
			$branch[] = $mode;
		}
		krsort($branch);
		$db = Yii::$app->db;
		$current_menu = $db->createCommand('call current_menu(:sid)')
			->bindValue(':sid',$page->sid)
			->queryAll();
		$current_menu = Tree::level($current_menu,$page->pid);
		return $this->render('view', [
			'page' => $page,
			'current_menu' => $current_menu,
			'branch' => $branch,
		]);
	}

    protected function findModel($id)
    {
        if (($model = Dish::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}

