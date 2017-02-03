<?php
namespace console\controllers;

use Yii;
// use \yii\web\User;
use common\models\User;
use common\models\Publication;
use \yii\console\Controller;
use \yii\helpers\ArrayHelper;
use \yii\helpers\Console;

class RbacController extends Controller
{

	public function actionInit()
	{
		$auth = Yii::$app->getAuthManager();
		// Удаляем роли (и разрешения) и правила
		$auth->removeAll();

		// Создаем роли
		$user = $auth->createRole('user');
		$auth->add($user);

		$admin = $auth->createRole('admin');
		$auth->add($admin);

		// Роль admin - наследник
		$auth->addChild($admin, $user);

		// Создаем разрешения
		$createPublication = $auth->createPermission('Создать публикацию');
		$createPublication->description = 'Создать публикацию';
		$auth->add($createPublication);

		$updatePublication = $auth->createPermission('Редактировать публикацию');
		$updatePublication->description = 'Редактировать публикацию';
		$auth->add($updatePublication);

		// Создаем правило
		$updateOwnPublicationRule = new \frontend\components\rbac\rules\UpdateOwnPublicationRule();
		$auth->add($updateOwnPublicationRule);

		// Создаем разрешение
		$updateOwnPublication = $auth->createPermission('Редактировать свою публикацию');
		$updateOwnPublication->description = 'Редактировать свою публикацию';
		// Добавляем правило к разрешению
		$updateOwnPublication->ruleName = $updateOwnPublicationRule->name;
		$auth->add($updateOwnPublication);

		$auth->addChild($updateOwnPublication, $updatePublication);

		$auth->addChild($user, $createPublication);
		$auth->addChild($user, $updateOwnPublication);

		$auth->addChild($admin, $updatePublication);


		$this->stdout('Done' . PHP_EOL);
	}

	public function actionTest()
	{
		/*
		// создаем пользователя, логиним, разлогиним
		Yii::$app->set('request', new \yii\web\Request());

		$user = new User(['id' => 1, 'username' => 'Username']);
		// $user = new User();
		// $user->id = 1;
		// $user->username = 'Username';

		var_dump(Yii::$app->user->id);
		var_dump(Yii::$app->user->identity);

		Yii::$app->user->login($user);
		
		var_dump(Yii::$app->user);
		var_dump(Yii::$app->user->identity);
		// var_dump(Yii::$app->user->id);
		// var_dump(Yii::$app->user->identity->id);

		Yii::$app->user->logout();

		var_dump(Yii::$app->user->id);
		var_dump(Yii::$app->user->identity);
		*/

		/*
		// Создаем пользователя, удаляем все роли, привязываем роли, выводим роли
		Yii::$app->set('request', new \yii\web\Request());

		$user = new User(['id' => 1, 'username' => 'Username']);
		$auth = Yii::$app->getAuthManager();

		$auth->revokeAll($user->id);

		echo 'Roles for user ' . PHP_EOL;
		print_r($auth->getRolesByUser($user->id));

		$auth->assign($auth->getRole('user'),$user->id);
		$auth->assign($auth->getRole('admin'),$user->id);

		echo 'New Roles for user ' . PHP_EOL;
		print_r($auth->getRolesByUser($user->id));

		echo 'New Roles for user ' . PHP_EOL;
		print_r(implode(', ', ArrayHelper::map($auth->getRolesByUser($user->id), 'name', 'name')));

		echo PHP_EOL;
		*/

		/*
		// Логинимся пользователем и проверяем
		Yii::$app->set('request', new \yii\web\Request());

		$user = new User(['id' => 1, 'username' => 'Username']);

		Yii::$app->user->login($user);

		var_dump(Yii::$app->user->can('admin'));
		// Или // Но тогда это не кешируется, а ->can() - кешируется
		// var_dump(Yii::$app->authManager->checkAccess($user->id,'admin'));

		echo PHP_EOL;
		*/

		//
		Yii::$app->set('request', new \yii\web\Request());
		$auth = Yii::$app->getAuthManager();
		
		$user = new User(['id' => 1, 'username' => 'Username']);
		$admin = new User(['id' => 2, 'username' => 'Adminname']);

		$auth->revokeAll($user->id);
		$auth->revokeAll($admin->id);

		$auth->assign($auth->getRole('user'),$user->id);
		$auth->assign($auth->getRole('admin'),$admin->id);

		// ############################################
		
		$publication = new Publication([
			'header' => 'header',
			'sid' => 'sid',
			'user_id' => $user->id,
		]);

		$publication2 = new Publication([
			'header' => 'header2',
			'sid' => 'sid2',
			'user_id' => $admin->id,
		]);

		// ############################################

		$this->stdout('Проверка разрешений для ' . $user->username . ' и первой публикации' . PHP_EOL, Console::FG_BLUE);
		Yii::$app->user->login($user);

		$this->stdout('Создание публикации ' . (string)Yii::$app->user->can('Создать публикацию') . PHP_EOL, Console::FG_GREEN);
		$this->stdout('Редактирование публикации ' . (string)Yii::$app->user->can('Редактировать публикацию', [
			'publication' => $publication,
		]) . PHP_EOL, Console::FG_GREEN);
		$this->stdout('Редактирование своей публикации ' . (string)Yii::$app->user->can('Редактировать свою публикацию', [
			'publication' => $publication,
		]) . PHP_EOL, Console::FG_GREEN);

		// ############################################

		$this->stdout('Проверка разрешений для ' . $admin->username . ' и первой публикации' . PHP_EOL, Console::FG_BLUE);
		Yii::$app->user->login($admin);

		$this->stdout('Создание публикации ' . (string)Yii::$app->user->can('Создать публикацию') . PHP_EOL, Console::FG_GREEN);
		$this->stdout('Редактирование публикации ' . (string)Yii::$app->user->can('Редактировать публикацию', [
			'publication' => $publication,
		]) . PHP_EOL, Console::FG_GREEN);
		$this->stdout('Редактирование своей публикации ' . (string)Yii::$app->user->can('Редактировать свою публикацию', [
			'publication' => $publication,
		]) . PHP_EOL, Console::FG_GREEN);

		// ############################################

		$this->stdout('Проверка разрешений для ' . $user->username . ' и второй публикации' . PHP_EOL, Console::FG_BLUE);
		Yii::$app->user->login($user);

		$this->stdout('Создание публикации ' . (string)Yii::$app->user->can('Создать публикацию') . PHP_EOL, Console::FG_GREEN);
		$this->stdout('Редактирование публикации ' . (string)Yii::$app->user->can('Редактировать публикацию', [
			'publication' => $publication2,
		]) . PHP_EOL, Console::FG_GREEN);
		$this->stdout('Редактирование своей публикации ' . (string)Yii::$app->user->can('Редактировать свою публикацию', [
			'publication' => $publication2,
		]) . PHP_EOL, Console::FG_GREEN);

		// ############################################

		$this->stdout('Проверка разрешений для ' . $admin->username . ' и второй публикации' . PHP_EOL, Console::FG_BLUE);
		Yii::$app->user->login($admin);

		$this->stdout('Создание публикации ' . (string)Yii::$app->user->can('Создать публикацию') . PHP_EOL, Console::FG_GREEN);
		$this->stdout('Редактирование публикации ' . (string)Yii::$app->user->can('Редактировать публикацию', [
			'publication' => $publication2,
		]) . PHP_EOL, Console::FG_GREEN);
		$this->stdout('Редактирование своей публикации ' . (string)Yii::$app->user->can('Редактировать свою публикацию', [
			'publication' => $publication2,
		]) . PHP_EOL, Console::FG_GREEN);

	}

}