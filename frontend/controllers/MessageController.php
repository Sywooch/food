<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use common\models\User;
use common\models\Message;
use yii\helpers\ArrayHelper;
use yii\base\Model;

class MessageController extends Controller
{

	public function actionList()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$recipient = null;

		if (Yii::$app->request->post('messagesCount')) {
			$messagesCount = Yii::$app->request->post('messagesCount');
		} else {
			$messagesCount = 10;
		}
		if (Yii::$app->request->post('scrollToMessage')) {
			$scrollToMessage = Yii::$app->request->post('scrollToMessage');
		} else {
			$scrollToMessage = null;
		}
		$scrollToNewLast = null;

		$messagesLast = Yii::$app->db->createCommand('
				SELECT 
					m.author_id,
					m.recipient_id,
					m.created_at,
					m.text,
					sum(m.notread) as countnotread
				from
				(
					select
						message.*,
						if (message.read, 0, 1) as notread
					from message
					where message.recipient_id = :recipient_id
					order by message.created_at desc
				) m
				group by m.author_id;
			')
			->bindValue(':recipient_id', $user->id)
			->queryAll();
		$authorsLastIds = ArrayHelper::getColumn($messagesLast, 'author_id');
		$authorsLastIds = array_unique($authorsLastIds);
		$authorsLast = User::findAll($authorsLastIds);
		$authorsLast = ArrayHelper::index($authorsLast, 'id');

		if (Yii::$app->request->get('id')) {
			$recipient = User::findOne(Yii::$app->request->get('id'));
		} elseif ($messagesLast) {
			$recipient = User::findOne($messagesLast[0]['author_id']);
		}

		if (Yii::$app->request->post('Message') && $recipient) {
			$message = new Message();
			$message->author_id = $user->id;
			$message->recipient_id = $recipient->id;
			$message->created_at = date('Y-m-d H:i:s');
			if ($message->load(Yii::$app->request->post()) && $message->save()) {
			}
		}

		if ($recipient) {
			$messages = Message::find()
				->with(['author'])
				->where(
				[
					'or',
					[
						'and',
						'author_id =' . $user->id,
						'recipient_id =' . $recipient->id,
					],
					[
						'and',
						'author_id =' . $recipient->id,
						'recipient_id =' . $user->id,
					]
				])
				->orderBy('message.created_at desc')
				->limit($messagesCount)
				->all();
				krsort($messages);
				foreach ($messages as $key => $m) {
					$m->read = 1;
					$m->updateAttributes(['read']);
				}
				if (Yii::$app->request->post('scrollLast') != $messages[0]->created_at) {
					$scrollToNewLast = true;
				}
		} else {
			$messages = [];
		}

		return $this->render('list', [
			'messagesLast' => $messagesLast,
			'authorsLast' => $authorsLast,
			'messages' => $messages,
			'messagesCount' => $messagesCount,
			'scrollToMessage' => $scrollToMessage,
			'scrollToNewLast' => $scrollToNewLast,
			'recipient' => $recipient,
			'user' => $user,
		]);
	}

	public function actionNewMessages($recipient_id)
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$recipient = User::findOne($recipient_id);
		$lastMessageDateTime = Yii::$app->request->post('lastMessageDateTime');
		$lastMessageAuthorId = Yii::$app->request->post('lastMessageAuthorId');
		$messages = Message::find()
			->with(['author'])
			->where(
			[
				'or',
				[
					'and',
					'author_id =' . $user->id,
					'recipient_id =' . $recipient->id,
				],
				[
					'and',
					'author_id =' . $recipient->id,
					'recipient_id =' . $user->id,
				]
			])
			->andWhere(['>=','message.created_at',$lastMessageDateTime])
			->orderBy('message.created_at desc')
			// ->limit($messagesCount)
			->all();
		$newMessages = [];
		foreach ($messages as $key => $m) {
			if ($m->created_at == $lastMessageDateTime && $m->author->id == $lastMessageAuthorId) {
				break;
			}
			$newMessages[] = $m;
		}
		krsort($newMessages);

		$messages = $newMessages;
		if ($messages) {
			return $this->renderPartial('new-messages', [
				'messages' => $messages,
			]);
		} else {
			return '';
		}
	}

	public function actionOldMessages($recipient_id)
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$recipient = User::findOne($recipient_id);
		$firstMessageDateTime = Yii::$app->request->post('firstMessageDateTime');
		$firstMessageAuthorId = Yii::$app->request->post('firstMessageAuthorId');
		$messages = Message::find()
			->with(['author'])
			->where(
			[
				'or',
				[
					'and',
					'author_id =' . $user->id,
					'recipient_id =' . $recipient->id,
				],
				[
					'and',
					'author_id =' . $recipient->id,
					'recipient_id =' . $user->id,
				]
			])
			->andWhere(['<=','message.created_at',$firstMessageDateTime])
			->orderBy('message.created_at desc')
			->limit(20)
			->all(); // 998876543210
		krsort($messages); //012345678899
		$newMessages = [];
		foreach ($messages as $key => $m) {
			if ($m->created_at == $firstMessageDateTime && $m->author->id == $firstMessageAuthorId) {
				break;
			}
			$newMessages[] = $m; //01234567889
		}
		$messages = array_slice($newMessages,-10); //1234567889
		if ($messages) {
			return $this->renderPartial('new-messages', [
				'messages' => $messages,
			]);
		} else {
			return '';
		}
	}

}