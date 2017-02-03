<?php
namespace backend\components\ctrait;

use Yii;
use common\models\User;
use yii\filters\AccessControl;

trait AccessController
{
	public function accessController()
	{
		return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['view'],
                'rules' => [
                    // // Разрешить всем все в этом контроллере
                    // [
                    //     'allow' => true,
                    // ],

                    // // Разрешить залогиненным все в этом контроллере
                    // [
                    //     'allow' => true,
                    //     'roles' => ['@'],
                    // ],

                    // Разрешить админам все в этом контроллере
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->username);
                            // Или
                            //return Yii::$app->user->identity->admin;
                            // Или
                            //return Yii::$app->user->identity->role === User::ROLE_USER;
                        }
                    ],
                ],
            ],
        ];
	}	
}