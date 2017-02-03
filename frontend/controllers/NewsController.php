<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\News;
use yii\data\Pagination;

use yii\web\ForbiddenHttpException;

class NewsController extends Controller
{

	public function actionList()
	{
		$limit = 17;
		$page = (is_null(Yii::$app->request->get('page')))?1:Yii::$app->request->get('page');
		$offset = ((int)$page-1)*$limit;

		$order = ['created_at' => SORT_DESC,'id' => SORT_DESC];

		if (is_null(Yii::$app->request->get('tag'))) {
			$news = News::find()
				->select([
					'news.*',
					'if ( 30<LENGTH(news.text), CONCAT(SUBSTRING(news.text, 1, 30),\'&#8230;\'), news.text ) AS `shorttext`',
				])
				// ->select(['news.id','news.sid','news.header','updated_at','created_at','sec'])
				// ->select()
				// ->innerJoinWith('sec0')
				->orderBy($order)
				->offset($offset)
				->limit($limit)
				->all();
			$pagination = new Pagination([
				'totalCount' => News::find()->count(), 
				'pageSize' => $limit,
			]);
		}else{
			$news = News::find()
				// ->select(['news.id','news.sid','news.header','updated_at','created_at','sec'])
				// ->innerJoinWith('newsNewstag')
				->innerJoinWith('newsTag')
				->where(['news_tag.sid' => Yii::$app->request->get('tag')])
				->orderBy($order)
				->offset($offset)
				->limit($limit)
				->all();
			$pagination = new Pagination([
				'totalCount' => News::find()
					->innerJoinWith('newsTag')
					->where(['news_tag.sid' => Yii::$app->request->get('tag')])
					->count(), 
				'pageSize' => $limit,
			]);
		}

		$pagination->pageSizeParam = false;

		return $this->render('list', [
			'news' => $news,
			'pagination' => $pagination,
		]);
	}

	public function actionView($sid,$id)
	{
		$news = News::find()->where(['sid'=>$sid,'id'=>$id])->one();
		return $this->render('view', [
			'news' => $news,
		]);
	}

}

