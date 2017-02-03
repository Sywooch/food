<?php
namespace frontend\controllers;

use common\models\PublicationPublicationtag;
use Yii;

use yii\helpers\ArrayHelper;
use common\models\User;
use common\models\Favoritecook;
use common\models\Address;
use common\models\Diet;
use common\models\Product;
use common\models\Publication;
use yii\data\Pagination;
use common\models\Dishtype;
use common\models\Phonenumber;
use common\models\Kitchen;
use common\models\Mainpage;
use common\components\ctrait\DateTimeRu;
use common\models\LoginForm;
use common\models\Metrostation;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * Site controller
 */
class SiteController extends Controller
{
	use DateTimeRu;

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'only' => ['logout', 'signup'],
				'rules' => [
					[
						'actions' => ['signup'],
						'allow' => true,
						'roles' => ['?'],
					],
					[
						'actions' => ['logout'],
						'allow' => true,
						'roles' => ['@'],
					],
				],
			],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					// 'logout' => ['post'],
				],
			],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'captcha' => [
				'class' => 'yii\captcha\CaptchaAction',
				'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
			],
		];
	}

	/**
	 * Displays homepage.
	 *
	 * @return mixed
	 */
	public function actionIndex()
	{
		$mainpage = Mainpage::find()
			->one();

		$this->layout = 'mainpage';

		$productkitchen = Yii::$app->db->createCommand('
				select
					product.id
				from product
				left join dish d on d.product_id = product.id
				left join user u on u.id = product.user_id
				where
					d.diet_id is null
					and product.type = :producttype
					and u.usertype = :usertype
					and u.role = :role
					and u.status = :status
				order by product.id desc
				limit 1
			')
			->bindValue(':usertype', User::TYPE_COOK)
			->bindValue(':producttype', Product::PRODUCT_DISH)
			->bindValue(':role', User::ROLE_USER)
			->bindValue(':status', User::STATUS_ACTIVE)
			->queryOne();
		$productdiet = Yii::$app->db->createCommand('
				select
					product.id
				from product
				left join dish d on d.product_id = product.id
				left join user u on u.id = product.user_id
				where
					d.diet_id is not null
					and product.type = :producttype
					and u.usertype = :usertype
					and u.role = :role
					and u.status = :status
				order by product.id desc
				limit 1
			')
			->bindValue(':usertype', User::TYPE_COOK)
			->bindValue(':producttype', Product::PRODUCT_DISH)
			->bindValue(':role', User::ROLE_USER)
			->bindValue(':status', User::STATUS_ACTIVE)
			->queryOne();

		$productkitchen = Product::findOne($productkitchen['id']);
		$productdiet = Product::findOne($productdiet['id']);

		// $popularCook = User::find()
		// 	->where([
		// 		'usertype' => User::TYPE_COOK,
		// 		'status' => User::STATUS_ACTIVE,
		// 		'role' => User::ROLE_USER,
		// 		'showonmain' => '1',
		// 	])
		// 	->limit(7)
		// 	->all();

		// $popularCookIds = Yii::$app->db->createCommand('SELECT r1.`id`, r1.`usertype`, r1.`role`, r1.`status`
		// 		FROM user AS r1 JOIN
		// 			(SELECT CEIL(RAND() *
		// 							(SELECT MAX(id)
		// 								FROM user)) AS id)
		// 				AS r2
		// 		WHERE r1.id >= r2.id
		// 			and r1.usertype = :usertype
		// 			and r1.role = :role
		// 			and r1.status = :status
		// 		ORDER BY r1.id ASC
		// 		LIMIT 20;
		// 	')
		// 	->bindValue(':usertype', User::TYPE_COOK)
		// 	->bindValue(':role', User::ROLE_USER)
		// 	->bindValue(':status', User::STATUS_ACTIVE)
		// 	->queryAll();

		$popularCookIds = Yii::$app->db->createCommand('SELECT id
				FROM `user`
				WHERE
					`showonmain` = 1
		 			and `user`.`usertype` = :usertype
		 			and `user`.`role` = :role
		 			and `user`.`status` = :status
				ORDER BY RAND()
				LIMIT 5;
			')
			->bindValue(':usertype', User::TYPE_COOK)
			->bindValue(':role', User::ROLE_USER)
			->bindValue(':status', User::STATUS_ACTIVE)
			->queryAll();
		$popularCookIds = ArrayHelper::getColumn($popularCookIds,'id');
		$popularCook = User::findAll($popularCookIds);
		// $popularCook = ArrayHelper::getColumn($popularCook,'id');
		// echo "<pre>";
		// print_r($popularCook);
		// echo "</pre>";
		// die();


		return $this->render('index', [
			'mainpage' => $mainpage,
			'productkitchen' => $productkitchen,
			'productdiet' => $productdiet,
			'popularCook' => $popularCook,
			'diets' => Diet::find()->orderBy('header')->all(),
			'kitchens' => Kitchen::find()->orderBy('header')->all(),
			'dishtypes' => Dishtype::find()->orderBy('header')->all(),
		]);
	}

	/**
	 * Get items for main map.
	 *
	 * @return mixed
	 */
	public function actionMainmapitems()
	{
      		$address = Address::find()
                        ->select(['*'])
                        ->where(['not', ['longitude' => null]])
                        ->andWhere(['not', ['latitude' => null]])
                        ->all();
            
            $coords = array();
            foreach($address as $one){
                $coords[md5($one["longitude"].$one["latitude"])] =['map_icon'=>'min', 'din_type'=>'food', 'dinamic'=>1, "map_longitude"=>$one["longitude"], "map_latitude"=>$one["latitude"]];
            }
            $coords1 = array();
            foreach($coords as $one){
                $coords1[] =$one;
            }
            
            
            return json_encode($coords1);
	}

	/**
	 * Get items for main map.
	 *
	 * @return mixed
	 */
	public function actionGetOneContent4map()
	{
            $lat = Yii::$app->request->get('latitude');
            $long = Yii::$app->request->get('longitude');
        
      		$address = Address::find()
                        ->select(['*'])
                        ->where(['longitude' => $long])
                        ->andWhere( ['latitude' => $lat])
                        ->all();
            
            $text = '';
            foreach($address as $one){
                $text.=$one["address"];
            }
            
            
            
            return json_encode(array('content'=>$text));
	}
    
    

	/**
	 * Logs in a user.
	 *
	 * @return mixed
	 */
	public function actionLogin()
	{
		if (!\Yii::$app->user->isGuest) {
			return $this->goHome();
		}

		$model = new LoginForm();
		if ($model->load(Yii::$app->request->post()) && $model->login()) {
			return $this->goBack();
		} else {
			return $this->render('login', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Logs out the current user.
	 *
	 * @return mixed
	 */
	public function actionLogout()
	{
		Yii::$app->user->logout();

		return $this->goHome();
	}

	/**
	 * Displays contact page.
	 *
	 * @return mixed
	 */
	public function actionContact()
	{
		$model = new ContactForm();
		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
				Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
			} else {
				Yii::$app->session->setFlash('error', 'There was an error sending email.');
			}

			return $this->refresh();
		} else {
			return $this->render('contact', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Displays about page.
	 *
	 * @return mixed
	 */
	public function actionAbout()
	{
		return $this->render('about');
	}

	public function actionSignup()
	{
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }

		$popup = false;
		$message = null;
		$signupForm = new SignupForm();
		$user = new User();
		$phonenumber = new Phonenumber();
		if (Yii::$app->request->post()) {

			if (Yii::$app->request->post('form') === 'signup') {
				if (
					$user->load(Yii::$app->request->post()) &&
					$phonenumber->load(Yii::$app->request->post()) &&
					$signupForm->load(Yii::$app->request->post())
				) {
					if ($signupForm->signupValid($user, $phonenumber)) {
						$popup = true;
					}
				}
			} elseif (Yii::$app->request->post('form') === 'phonenumber') {

		        if (!isset($_SESSION['signup']['sms_code'])||!isset($_SESSION['signup']['sms_time'])) {
		            throw new \yii\web\BadRequestHttpException("Неверный запрос.");
		        }

		        $phonenumber->phonenumber = $_SESSION['signup']['phonenumber'];

		        $now = new \DateTime('now');

		        $diff = $now->getTimestamp() - $_SESSION['signup']['sms_time'];
		        if ($diff > 240) {
		        	$message = 'time is over.';
		        } else {
			        if (Yii::$app->request->post('code')) {
			            if ($_POST['code'] === $_SESSION['signup']['sms_code']) {
							if ($returnuser = $signupForm->signupBySms($user, $phonenumber)) {
								if (Yii::$app->getUser()->login($returnuser)) {
									// return $this->goHome();
									return $this->redirect(['/user/profile']);
								}
							} else {
								$popup = false;
							}
			            } else {
							$popup = true;
			            	$message = 'Введен неверный код.';
			            }
			        }
		        }

			}


		}
		return $this->render('signup', [
			'user' => $user,
			'popup' => $popup,
			'phonenumber' => $phonenumber,
			'signupForm' => $signupForm,
			'message' => $message,
		]);
	}

	/**
	 * Requests password reset.
	 *
	 * @return mixed
	 */
	public function actionRequestPasswordReset()
	{
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		$model = new PasswordResetRequestForm();

		$message = null;
		if (isset($session['sms_time_is_over'])) {
			$message = 'Вышло время действия sms кода. Повторите попытку снова.';
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$method = $model->methodByQuery();
			switch ($method) {
				case 'email':
					if ($model->sendEmail()) {
						Yii::$app->session->setFlash('success', 'Проверьте свою электронную почту для получения дальнейших инструкций.');
						$message = 'Проверьте свою электронную почту для получения дальнейших инструкций.';
						// return $this->goHome();
					} else {
						$message = 'К сожалению, мы не можем сбросить пароль для данного адреса электронной почты.';
					}
					break;

				case 'phonenumber':
					$user = $model->user;
					$code = '';
					for ($i = 0; $i<5; $i++) {
						$code .= (string)mt_rand(0,9);
					}
					\Yii::$app->sms->sms_send( $model->email, $code );
					// $user->sms_code = md5($code.Yii::$app->sms->api_id);
					// $user->updateAttributes(['smscode']);
					$session['sms_user_id'] = $user->id;
					$session['sms_code'] = $code;
					$session['sms_time'] = new \DateTime();
					return $this->redirect(['site/code-in-sms']);
					break;

				default:
					$message = 'Не найден пользователь с таким телефоном или email';
					break;
			}
		}

		return $this->render('requestPasswordResetToken', [
			'message' => $message,
			'model' => $model,
		]);
	}

	public function actionCodeInSms()
	{
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		if (!isset($session['sms_user_id'])||!isset($session['sms_code'])||!isset($session['sms_time'])) {
			throw new \yii\web\BadRequestHttpException("Неверный запрос.");
		}

		$now = new \DateTime('now');

		$diff = $now->getTimestamp() - $session['sms_time']->getTimestamp();
		$user = User::findOne($session['sms_user_id']);

		if (!$user) {
			throw new \yii\web\BadRequestHttpException("Неверный запрос.");
		}
		if ($diff > 240) {
			$session['sms_time_is_over'] = true;
			$this->redirect(['site/request-password-reset']);
		}

		if (Yii::$app->request->post('code')) {
			if ($_POST['code'] === $session['sms_code']) {
				$session['sms_code_right'] = true;
				return $this->redirect(['site/reset-password-by-sms']);
			}
		}
		return $this->render('code-in-sms', [
		]);
	}

	public function actionResetPasswordBySms()
	{
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}

		if (!isset($session['sms_user_id'])||!isset($session['sms_code'])||!isset($session['sms_time'])) {
			throw new \yii\web\BadRequestHttpException("Неверный запрос.");
		}

		if (!isset($session['sms_code_right'])) {
			throw new \yii\web\BadRequestHttpException("Неверный запрос.");
		}

		$user = User::findOne($session['sms_user_id']);

		if (!$user) {
			throw new \yii\web\BadRequestHttpException("Неверный запрос.");
		}

		if (Yii::$app->request->post()) {
			if (isset($_POST['password'])&&(mb_strlen($_POST['password'])>5)) {
		        $user->setPassword($_POST['password']);
		        $user->removePasswordResetToken();
		        $user->save(false);
		        unset($session['sms_code']);
		        unset($session['sms_time']);
		        unset($session['sms_code_right']);
		        unset($session['sms_user_id']);
		        unset($session['sms_time_is_over']);
				return $this->goHome();
			}
		}

		return $this->render('reset-password-by-sms');

	}

	/**
	 * Resets password.
	 *
	 * @param string $token
	 * @return mixed
	 * @throws BadRequestHttpException
	 */
	public function actionResetPassword($token)
	{
		try {
			$model = new ResetPasswordForm($token);
		} catch (InvalidParamException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
			Yii::$app->session->setFlash('success', 'New password was saved.');

			return $this->goHome();
		}

		return $this->render('resetPassword', [
			'model' => $model,
		]);
	}

	public function actionSearch()
	{
		// Два обязательных параметра страницы (ищем блюдо или диету, в какой секции - если есть)
		$producttype = (Yii::$app->request->get('producttype'))?Yii::$app->request->get('producttype'):'dish';
		$section = Yii::$app->request->get('section');

		// Параметры, кторых если нет, то берутся из БД (максимальный и минимальный уровень цен)
		$dbParams = Yii::$app->db->createCommand('call product_filters()')->queryOne();

		// Параметры страницы
		$limit = 8;
		$page = (is_null(Yii::$app->request->get('page')))?1:(int)Yii::$app->request->get('page');
		$offset = ($page-1)*$limit;

		// Стартуем сессию если ее небыло
		$session = Yii::$app->session;
		if (!$session->isActive) {
			$session->open();
		}
		// Запоминаем параметры _POST и _GET в сесию
		if (Yii::$app->request->post()) {
			$ss = $session->get($producttype);
			// Первое Второе Компот
			if (Yii::$app->request->post('form_dishtype_id')) {
				if (isset($_POST['dishtype_id'])) {
					// $ss['dishtype_id'] = ($_POST['dishtype_id']=='any')?null:$_POST['dishtype_id'];
					$ss['dishtype_id'] = Yii::$app->request->post('dishtype_id');
				} else {
					$ss['dishtype_id'] = null;
				}
			}
			// Секция (Кухня или Диета)
			if (Yii::$app->request->post('form_kitchen_ids')) {
				if (isset($_POST['kitchen_ids'])) {
					// $ss['kitchen_ids'] = ($_POST['kitchen_ids']=='any')?null:$_POST['kitchen_ids'];
					$ss['kitchen_ids'] = Yii::$app->request->post('kitchen_ids');
				} else {
					$ss['kitchen_ids'] = null;
				}
			}
			// Показывать поваров или только блюда
			if (Yii::$app->request->post('viewType')) {
				$ss['viewType'] = Yii::$app->request->post('viewType');
			}
			// Блюда или диеты
			if (isset($_GET['dishordiet'])) {
				$ss['dishordiet'] = Yii::$app->request->post('dishordiet');
			}
			//ингридиенты (ingredients)
            /*if(Yii::$app->request->post('ingredients')){
                if (isset($_POST['ingredients'])) {
                    // $ss['dishtype_id'] = ($_POST['dishtype_id']=='any')?null:$_POST['dishtype_id'];
                    $ss['ingredients'] = Yii::$app->request->post('ingredients');
                } else {
                    $ss['ingredients'] = null;
                }

        }*/

			// салат "весенний"
			if (isset($_POST['searchquery'])) {
				// echo "<pre>";
				//print_r($_POST);
				// echo "</pre>";
				// die();
				if (Yii::$app->request->post('searchquery') === '') {
					$ss['searchquery'] = null;
				} else {
					$ss['searchquery'] = Yii::$app->request->post('searchquery');
				}
			}
			// с ценой от
			if (isset($_POST['price_from'])) {
				if ( $_POST['price_from'] === '' ) {
					$ss['price_from'] = null;
				} else {
					$ss['price_from'] = Yii::$app->request->post('price_from');
				}
			}
			// с ценой до
			if (isset($_POST['price_to'])) {
				if ($_POST['price_to'] === '') {
					$ss['price_to'] = null;
				} else {
					$ss['price_to'] = $_POST['price_to'];
				}
			}
			// самовывоз
			if (isset($_POST['pickup'])) {
				if ($_POST['pickup'] == 1) {
					$ss['pickup'] = 1;
				} else {
					$ss['pickup'] = null;
				}
			}
			// Выезд на дом
			if (isset($_POST['workhome'])) {
				if ($_POST['workhome'] == 1) {
					$ss['workhome'] = 1;
				} else {
					$ss['workhome'] = null;
				}
			}
			// Стоимость доставки от
			if (isset($_POST['costdeliveryfrom'])) {
				if ($_POST['costdeliveryfrom'] === '') {
					$ss['costdeliveryfrom'] = null;
				} else {
					$ss['costdeliveryfrom'] = Yii::$app->request->post('costdeliveryfrom');
				}
			}
			// Стоимость доставки до
			if (isset($_POST['costdeliveryto'])) {
				if ($_POST['costdeliveryto'] === '') {
					$ss['costdeliveryto'] = null;
				} else {
					$ss['costdeliveryto'] = Yii::$app->request->post('costdeliveryto');
				}
			}
			$session->set($producttype,$ss);
		}

		// Собираем из сессии или из других источников
		$bindedValues = [
			'offset' => $offset,
			'limit' => $limit,
			'dishordiet' => $producttype,
			'price_from' => isset($session[$producttype]['price_from'])?$session[$producttype]['price_from']:(int)$dbParams['price_min'],
			'price_to' => isset($session[$producttype]['price_to'])?$session[$producttype]['price_to']:(int)$dbParams['price_max'],
			'dishtype_id' => isset($session[$producttype]['dishtype_id'])?implode(',',$session[$producttype]['dishtype_id']):null,
			'kitchen_ids' => isset($session[$producttype]['kitchen_ids'])?implode(',',$session[$producttype]['kitchen_ids']):null,
            //'ingredients' => isset($session[$producttype]['ingredients'])?implode(',', $session[$producttype]['ingredients']):null,
			'searchquery' => isset($session[$producttype]['searchquery'])?$session[$producttype]['searchquery']:null,
			'viewType' => isset($session[$producttype]['viewType'])?$session[$producttype]['viewType']:'dish',
			'pickup' => isset($session[$producttype]['pickup'])?(int)$session[$producttype]['pickup']:null,
			'workhome' => isset($session[$producttype]['workhome'])?(int)$session[$producttype]['workhome']:null,
			'costdeliveryfrom' => isset($session[$producttype]['costdeliveryfrom'])?(int)$session[$producttype]['costdeliveryfrom']:null,
			'costdeliveryto' => isset($session[$producttype]['costdeliveryto'])?(int)$session[$producttype]['costdeliveryto']:null,
		];

        //var_dump($bindedValues);


		$cooksAndProducts = null;
		$cooks = null;
        $products = null;


		$dishtypes = ArrayHelper::index(Dishtype::find()->orderBy('header')->all(), 'id');
		$kitchens = ArrayHelper::index(Kitchen::find()->orderBy('header')->all(), 'id');
		$diets = ArrayHelper::index(Diet::find()->orderBy('header')->all(), 'id');

		$h1 = 'Заказ ';
		if ($producttype==='dish') {
			if (
				isset($_SESSION['dish'])&&isset($_SESSION['dish']['dishtype_id']) || 
				isset($_SESSION['dish'])&&isset($_SESSION['dish']['kitchen_ids'])
			) {
				$h1.= 'домашних блюд: ';
			} else {
				$h1.= 'домашних блюд';
			}
			if (isset($_SESSION['dish'])&&isset($_SESSION['dish']['dishtype_id'])) {
				if ($count = count($_SESSION['dish']['dishtype_id'])):
					end($_SESSION['dish']['dishtype_id']);
					$last = key($_SESSION['dish']['dishtype_id']);
					prev($_SESSION['dish']['dishtype_id']);
					$preLast = key($_SESSION['dish']['dishtype_id']);
					foreach ($_SESSION['dish']['dishtype_id'] as $key => $value):
						if ($key == $preLast && $count >= 2):
							$h1.= $dishtypes[$value]->header.' и ';
						elseif ($key == $last):
							$h1.= $dishtypes[$value]->header.' ';
						else:
							$h1.= $dishtypes[$value]->header.', ';
						endif;
					endforeach;
				endif;
			}
			if (isset($_SESSION['dish'])&&isset($_SESSION['dish']['kitchen_ids'])) {
				if ($count = count($_SESSION['dish']['kitchen_ids'])):
					end($_SESSION['dish']['kitchen_ids']);
					$last = key($_SESSION['dish']['kitchen_ids']);
					prev($_SESSION['dish']['kitchen_ids']);
					$preLast = key($_SESSION['dish']['kitchen_ids']);
					foreach ($_SESSION['dish']['kitchen_ids'] as $key => $value):
						if ($key == $preLast && $count >= 2):
							$h1.= $kitchens[$value]->header.' и ';
						elseif ($key == $last):
							$h1.= $kitchens[$value]->header.' кухни';
						else:
							$h1.= $kitchens[$value]->header.', ';
						endif;
					endforeach;
				endif;
			}
		} elseif ($producttype==='diet') {
			if (
				isset($_SESSION['diet'])&&isset($_SESSION['diet']['dishtype_id']) || 
				isset($_SESSION['diet'])&&isset($_SESSION['diet']['kitchen_ids'])
			) {
				$h1.= 'диет: ';
			} else {
				$h1.= 'диет';
			}
			if (isset($_SESSION['diet'])&&isset($_SESSION['diet']['dishtype_id'])) {
				if ($count = count($_SESSION['diet']['dishtype_id'])):
					end($_SESSION['diet']['dishtype_id']);
					$last = key($_SESSION['diet']['dishtype_id']);
					prev($_SESSION['diet']['dishtype_id']);
					$preLast = key($_SESSION['diet']['dishtype_id']);
					foreach ($_SESSION['diet']['dishtype_id'] as $key => $value):
						if ($key == $preLast && $count >= 2):
							$h1.= $dishtypes[$value]->header.' и ';
						elseif ($key == $last):
							$h1.= $dishtypes[$value]->header.' ';
						else:
							$h1.= $dishtypes[$value]->header.', ';
						endif;
					endforeach;
				endif;
			}
			if (isset($_SESSION['diet'])&&isset($_SESSION['diet']['kitchen_ids'])) {
				if ($count = count($_SESSION['diet']['kitchen_ids'])):
					end($_SESSION['diet']['kitchen_ids']);
					$last = key($_SESSION['diet']['kitchen_ids']);
					prev($_SESSION['diet']['kitchen_ids']);
					$preLast = key($_SESSION['diet']['kitchen_ids']);
					foreach ($_SESSION['diet']['kitchen_ids'] as $key => $value):
						if ($key == $preLast && $count >= 2):
							$h1.= $diets[$value]->header.' и ';
						elseif ($key == $last):
							$h1.= $diets[$value]->header.'';
						else:
							$h1.= $diets[$value]->header.', ';
						endif;
					endforeach;
				endif;
			}
		}

		switch ($bindedValues['viewType']) {
			case 'dish':

				$products = Yii::$app->db->createCommand('
					call search_dish(
						:offset, 
						:limit, 
						:dishordiet, 
						:price_from, 
						:price_to, 
						:dishtype_id, 
						:kitchen_ids, 
						:searchquery,
						:pickup,
						:workhome,
						:costdeliveryfrom,
						:costdeliveryto
					)
				')
					->bindValue(':offset',$bindedValues['offset'])
					->bindValue(':limit',$bindedValues['limit'])
					->bindValue(':dishordiet',$bindedValues['dishordiet'])
					->bindValue(':price_from',$bindedValues['price_from'])
					->bindValue(':price_to',$bindedValues['price_to'])
					->bindValue(':dishtype_id',$bindedValues['dishtype_id'])
					->bindValue(':kitchen_ids',$bindedValues['kitchen_ids'])
					->bindValue(':searchquery',$bindedValues['searchquery'])
					->bindValue(':pickup',$bindedValues['pickup'])
					->bindValue(':workhome',$bindedValues['workhome'])
					->bindValue(':costdeliveryfrom',$bindedValues['costdeliveryfrom'])
					->bindValue(':costdeliveryto',$bindedValues['costdeliveryto'])
      //          $result = $products->queryAll();
					->queryAll();

                //print_r($products->queryRow());
    //print_r($result);
                //var_dump($products);

// echo "<pre>";
//print_r($products->getRawSql());
// echo "</pre>";
// die();

// $a = $products->queryAll();
// print_r($bindedValues['dishtype_id']);
// print_r($a);
// echo "</pre>";
// die();

				$totalCount = Yii::$app->db->createCommand('SELECT FOUND_ROWS() as FOUND_ROWS;')
					->queryOne();

				$pagination = new Pagination([
					'totalCount' => $totalCount['FOUND_ROWS'],
					'pageSize' => $limit,
					'pageSizeParam' => false,
				]);

				$ids = ArrayHelper::getColumn($products, 'id');

				$products = Product::find()
					->with('dish')
					->where(['id' => $ids])
					->all();

                //print_r($products);








				// return $this->render('searchDish', [
				// 	'producttype' => $producttype,
				// 	'session' => $session,
				// 	'bindedValues' => $bindedValues,
				// 	'products' => $products,
				// 	'pagination' => $pagination,
				// 	'h1' => $h1,
				// 	'dishtypes' => $dishtypes,
				// 	'kitchens' => $kitchens,
				// 	'diets' => $diets,
				// ]);



				break;
			case 'cook':

				$cooksAndProducts = Yii::$app->db->createCommand('
					call search_cook(
						:offset, 
						:limit, 
						:dishordiet, 
						:price_from, 
						:price_to, 
						:dishtype_id, 
						:kitchen_ids, 
						:searchquery,
						:pickup,
						:workhome,
						:costdeliveryfrom,
						:costdeliveryto
					)
				')
					->bindValue(':offset',$bindedValues['offset'])
					->bindValue(':limit',$bindedValues['limit'])
					->bindValue(':dishordiet',$bindedValues['dishordiet'])
					->bindValue(':price_from',$bindedValues['price_from'])
					->bindValue(':price_to',$bindedValues['price_to'])
					->bindValue(':dishtype_id',$bindedValues['dishtype_id'])
					->bindValue(':kitchen_ids',$bindedValues['kitchen_ids'])
					->bindValue(':searchquery',$bindedValues['searchquery'])
					->bindValue(':pickup',$bindedValues['pickup'])
					->bindValue(':workhome',$bindedValues['workhome'])
					->bindValue(':costdeliveryfrom',$bindedValues['costdeliveryfrom'])
					->bindValue(':costdeliveryto',$bindedValues['costdeliveryto'])
					->queryAll();

// echo "<pre>";
// print_r($cooksAndProducts->getRawSql());
// echo "</pre>";
// die();

// echo "<pre>";
// print_r($cooksAndProducts->getRawSql());
// print_r($cooksAndProducts->queryAll());
// echo "</pre>";
// die();

// echo "<pre>";
// var_dump($bindedValues);
// print_r($cooksAndProducts);
// echo "</pre>";
// die();

				$totalCount = Yii::$app->db->createCommand('SELECT FOUND_ROWS() as FOUND_ROWS;')
					->queryOne();

				$pagination = new Pagination([
					'totalCount' => $totalCount['FOUND_ROWS'],
					'pageSize' => $limit,
					'pageSizeParam' => false,
				]);

				if ($cooksAndProducts) {
					$cookIds = ArrayHelper::getColumn($cooksAndProducts, 'u_id');
					$productIds = [];
					$cooksAndProducts = ArrayHelper::index($cooksAndProducts, 'u_id');
					foreach ($cooksAndProducts as $key => $value) {
						$ids = explode(',', $value['p_id']);
						$cooksAndProducts[$key] = $ids;
						$productIds = array_merge($productIds,$ids);
					}

					// echo "<pre>";
					// print_r($productIds);
					// echo "</pre>";
					// die();

					$cooks = User::find()->where(['id' => $cookIds])->all();
					$cooks = ArrayHelper::index($cooks, 'id');

					$products = Product::find()->where(['id' => $productIds])->all();
					$products = ArrayHelper::index($products, 'id');

					// echo "<pre>";
					// print_r($products);
					// echo "</pre>";
					// die();

				} else {
					$cooks = [];
					$products = [];
				}

				// return $this->render('searchCook', [
				// 	'bindedValues' => $bindedValues,
				// 	'cooks' => $cooks,
				// 	'products' => $products,
				// 	'cooksAndProducts' => $cooksAndProducts,
				// 	'pagination' => $pagination,
				// 	'dishtypes' => Dishtype::find()->orderBy('header')->all(),
				// 	'kitchens' => Kitchen::find()->orderBy('header')->all(),
				// ]);
				break;
			default:
				break;
		}



		//print_r($bindedValues);

		return $this->render('search', [
			'producttype' => $producttype,
			'session' => $session,
			'bindedValues' => $bindedValues,
			'products' => $products,
			'cooks' => $cooks,
			'cooksAndProducts' => $cooksAndProducts,
			'pagination' => $pagination,
			'h1' => $h1,
			'dishtypes' => $dishtypes,
			'kitchens' => $kitchens,
			'diets' => $diets,
		]);




	}

	public function actionSearchHeader($q)
	{
		$products = Product::find()
			->where(['like', 'header', $q])
			->limit(50)
			->all();
		$arrayOfHeader = ArrayHelper::getColumn($products, 'header');
		echo json_encode($arrayOfHeader);
	}

	public function actionSearchCookUsername($q)
	{
		$cooks = User::find()
			->select(['username'])
			->where(['like', 'username', $q])
			->andWhere(['usertype' => User::TYPE_COOK])
			->andWhere(['status' => User::STATUS_ACTIVE])
			->andWhere(['role' => User::ROLE_USER])
			->limit(50)
			->all();
		$cooks = ArrayHelper::getColumn($cooks, 'username');
		echo json_encode($cooks);
	}

	public function actionSearchMetrostationHeader($q)
	{
		$products = Metrostation::find()
			->where(['like', 'header', $q])
			->limit(50)
			->all();
		$arrayOfHeader = ArrayHelper::getColumn($products, 'header');
		echo json_encode($arrayOfHeader);
	}

	public function actionBasketadd($id)
	{
		$product = Product::findOne($id);
		if (!$product) {
			return null;
		}

		$session = Yii::$app->session;
		if ( !$session->isActive ) $session->open();
		if ( !$session->has('basket') ) $session->set('basket', []);
		$basket = $session->get('basket');

		if (isset($basket[$id])) {
			$basket[$id]['count']++;
			$basket[$id]['sum'] = round($product->pricesale?$product->pricesale:$product->price)*$basket[$id]['count'];
		} else {
			$basket[$id]['count'] = 1;
			$basket[$id]['cookid'] = $product->user->id;
			$basket[$id]['sum'] = round($product->pricesale?$product->pricesale:$product->price);
		}

		$session->set('basket', $basket);

		return $this->renderPartial('basketed');
	}

	public function actionBasketdel($id)
	{
		$session = Yii::$app->session;
		$basket = $session->get('basket');

		if (isset($basket[$id])) {
			unset($basket[$id]);
		}

		$session->set('basket', $basket);

		return $this->redirect(['site/basket']);
	}

	public function actionBasket()
	{
		$session = Yii::$app->session;
		$basket = $session->get('basket');
		$productids = $basket?array_keys($basket):[];
		$prods = Product::findAll($productids);
		$products = [];
		if ($basket) {
			foreach ($prods as $key => $p) {
				$products[$p->id] = $p;
			}
			$userids = [];
			foreach ($basket as $key => $b) {
				$userids[] = $b['cookid'];
			}
			$userids = array_unique($userids);
			$newbasket = [];
			foreach ($userids as $key => $uid) {
				foreach ($basket as $key2 => $b) {
					if ($b['cookid']===$uid) {
						$newbasket[$key2] = $b;
					}
				}
			}
			$basket = $newbasket;
		}

		return $this->render('basket', [
			'products' => $products,
			'basket' => $basket,
		]);
	}

	public function actionBlogs()
	{
		$limit = 10;
		$page = (is_null(Yii::$app->request->get('page')))?1:Yii::$app->request->get('page');
		$offset = ((int)$page-1)*$limit;

		$blogs = Publication::find()
			->select([
				'publication.*',
				'if ( 30<LENGTH(publication.text), CONCAT(SUBSTRING(publication.text, 1, 200),\'&#8230;\'), publication.text ) AS `shorttext`',
			])
			->orderBy(['created_at' => SORT_DESC,'id' => SORT_DESC])
			->offset($offset)
			->limit($limit)
			->all();

		$pagination = new Pagination([
			'totalCount' => Publication::find()->count(), 
			'pageSize' => $limit,
		]);

		$pagination->pageSizeParam = false;

		// $blogs = Publication::find()->limit(10)->all();

		return $this->render('blogs', [
			'blogs' => $blogs,
			'pagination' => $pagination,
		]);
	}

	public function actionUserprofile($id)
	{
		$user = User::findOne($id);
		$lookingUser = (Yii::$app->user->identity)?User::findOne(Yii::$app->user->identity->id):null;
		switch ($user->usertype) {
			case User::TYPE_USER:
				$addresses = $user->address;
				$profile = $user->profile;
				$phonenumbers = $user->phonenumber;
				$kitchens = $user->kitchen;
				return $this->render('profileuser', [
					'user' => $user,
					'profile' => $profile,
					'addresses' => $addresses,
					'phonenumbers' => $phonenumbers,
					'kitchens' => $kitchens,
				]);
				break;
			case User::TYPE_COOK:
				if (Yii::$app->request->post('toFavorite')) {
					if ($lookingUser && $lookingUser->usertype == User::TYPE_USER) {
						$favoritecook = new Favoritecook();
						$favoritecook->cook_id = $user->id;
						$favoritecook->user_id = $lookingUser->id;
						if ($favoritecook->validate() && $favoritecook->save()) {
						}
					}
				}
				$isFavorite = false;
				if ($lookingUser) {
					$isFavorite = (Favoritecook::find()->where(['cook_id' => $user->id, 'user_id' => $lookingUser->id])->one())?true:false;
				}
				$profile = $user->profile;
				$fotodocs = $user->fotodoc;
				$address = $profile->address;
				$products = $user->getProducts()->limit(5)->all();
				$phonenumbers = $user->phonenumber;
				$cookkitchens = Yii::$app->db->createCommand('call cook_kitchens(:id);')
					->bindValue(':id', $user->id)
					->queryAll();
				$fotokitchens = $user->fotokitchen;
				return $this->render('profilecook', [
					'user' => $user,
					'profile' => $profile,
					'address' => $address,
					'products' => $products,
					'phonenumbers' => $phonenumbers,
					'cookkitchens' => $cookkitchens,
					'fotokitchens' => $fotokitchens,
					'fotodocs' => $fotodocs,
					'isFavorite' => $isFavorite,
				]);
				break;
		}
	}

    public function actionUserblog($id)
    {
        $user = User::findOne($id);
        $publication = Publication::findAll(['user_id' => $id]);
        $lookingUser = (Yii::$app->user->identity)?User::findOne(Yii::$app->user->identity->id):null;
        switch ($user->usertype) {
            case User::TYPE_USER:
                $addresses = $user->address;
                $profile = $user->profile;
                $phonenumbers = $user->phonenumber;
                $kitchens = $user->kitchen;
                return $this->render('profileuser', [
                    'user' => $user,
                    'profile' => $profile,
                    'addresses' => $addresses,
                    'phonenumbers' => $phonenumbers,
                    'kitchens' => $kitchens,
                ]);
                break;
            case User::TYPE_COOK:
                if (Yii::$app->request->post('toFavorite')) {
                    if ($lookingUser && $lookingUser->usertype == User::TYPE_USER) {
                        $favoritecook = new Favoritecook();
                        $favoritecook->cook_id = $user->id;
                        $favoritecook->user_id = $lookingUser->id;
                        if ($favoritecook->validate() && $favoritecook->save()) {
                        }
                    }
                }
                $isFavorite = false;
                if ($lookingUser) {
                    $isFavorite = (Favoritecook::find()->where(['cook_id' => $user->id, 'user_id' => $lookingUser->id])->one())?true:false;
                }
                $profile = $user->profile;
                $fotodocs = $user->fotodoc;
                $address = $profile->address;
                $products = $user->getProducts()->limit(5)->all();
                $phonenumbers = $user->phonenumber;
                $cookkitchens = Yii::$app->db->createCommand('call cook_kitchens(:id);')
                    ->bindValue(':id', $user->id)
                    ->queryAll();
                $fotokitchens = $user->fotokitchen;
                return $this->render('userblog', [
                    'user' => $user,
                    'publication' => $publication,
                    'profile' => $profile,
                    'address' => $address,
                    'products' => $products,
                    'phonenumbers' => $phonenumbers,
                    'cookkitchens' => $cookkitchens,
                    'fotokitchens' => $fotokitchens,
                    'fotodocs' => $fotodocs,
                    'isFavorite' => $isFavorite,
                ]);
                break;
        }
    }

	public function actionUsermenu($id)
	{
		$user = User::findOne($id);
		$dishtypes = Dishtype::find()->all();
		$products = Product::find()
			->select([
				'product.id',
				'product.user_id',
				'product.header',
				'product.price',
				'product.pricesale',
				'product.type',
				'product.foto_id',
				'if ( 30<LENGTH(d.text), CONCAT(SUBSTRING(d.text, 1, 30),\'&#8230;\'), d.text ) AS `shorttext`',
			])
			->leftJoin('set s', '`s`.`product_id` = `product`.`id`')
			->leftJoin('set_dish sd', '`sd`.`set_id` = `s`.`product_id`')
			->leftJoin('dish d', '`d`.`product_id` = `product`.`id`')
			->leftJoin('dish_kitchen dk', '`dk`.`dish_id` = `d`.`product_id`')
			->leftJoin('dish_kitchen dks', '`dks`.`dish_id` = `d`.`product_id`')
			->where(['product.user_id' => $user->id])
			->all();
		return $this->render('menu', [
			'user' => $user,
			'products' => $products,
			'dishtypes' => $dishtypes,
		]);
	}

	public function actionUserproduct($id)
	{
		$product = Product::findOne($id);
		$user = $product->user;
		switch ($product->type) {
			case Product::PRODUCT_DISH:
				$dish = $product->dish;
				return $this->render('productdish', [
					'user' => $user,
					'product' => $product,
					'dish' => $dish,
				]);
				break;
			case Product::PRODUCT_SET:
				$set = $product->set;
				return $this->render('productset', [
					'user' => $user,
					'product' => $product,
					'set' => $set,
				]);
				break;
		}
	}

}
