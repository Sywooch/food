<?php
namespace frontend\components\rbac\rules;

use \yii\rbac\Rule;

class UpdateOwnPublicationRule extends Rule
{
	public $name = 'isAuthor';

	public function execute($userId, $item, $params)
	{
		return isset($params['publication'])? $params['publication']->user_id == $userId : false;
	}
}