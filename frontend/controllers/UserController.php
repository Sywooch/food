<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use frontend\models\ProfileUserForm;
use frontend\models\ProfileCookForm;
use frontend\models\AlbumForm;
use frontend\models\FotoForm;
use frontend\models\FotoUpdateForm;
use frontend\models\DishAddForm;
use frontend\models\DishForm;
use frontend\models\SetForm;
use frontend\models\OrderCreateForm;
use common\models\User;
use common\models\ProfileUser;
use common\models\ProfileCook;
use common\models\Phonenumber;
use common\models\Metrostation;
use common\models\Kitchen;
use common\models\KitchenUser;
use common\models\Address;
use common\models\Album;
use common\models\Foto;
use common\models\Dishtype;
use common\models\Diet;
use common\models\Product;
use common\models\Dish;
use common\models\Set;
use common\models\SetDish;
use common\models\Fotokitchen;
use common\models\Fotodoc;
use common\models\Order;
use common\models\Notice;
use common\models\Publication;
use common\models\Publicationtag;
use common\models\PublicationPublicationtag;
use yii\helpers\ArrayHelper;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\data\Pagination;

class UserController extends Controller
{

	public function actionChangePassword()
	{
	}

	public function actionProfile()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		switch ($user->usertype) {
			case 'user':
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
			case 'cook':
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
				]);
				break;
		}
	}

	public function actionProfileupdate()
	{
		$user = User::findOne(Yii::$app->user->identity->id);


		switch ($user->usertype) {
			case 'user':

				$profileUserForm = new ProfileUserForm();
				$user = User::findOne(Yii::$app->user->identity->id);
				$profile = $user->profile;
				$addresses = $user->address;
				$newaddresses = [];
				$phonenumbers = $user->phonenumber;
				$newphonenumbers = [];
				$userkitchens = $user->kitchen;
				if (Yii::$app->request->post()) {


					if ( $count = count(Yii::$app->request->post('Phonenumber')) ) {
						if (!Model::loadMultiple($phonenumbers, Yii::$app->request->post(), 'Phonenumber')) {
							$phonenumbers = [];
						}
					}

					if ( $count = count(Yii::$app->request->post('Newphonenumber')) ) {
						for ($i=0; $i < $count; $i++) { 
							$newphonenumbers[] = new Phonenumber();
						}
						if (!Model::loadMultiple($newphonenumbers, Yii::$app->request->post(), 'Newphonenumber')) {
							$newphonenumbers = [];
						}
					}

					if ( $count = count(Yii::$app->request->post('Address')) ) {
						if (!Model::loadMultiple($addresses, Yii::$app->request->post(), 'Address')) {
							$addresses = [];
						}
					}

					if ( $count = count(Yii::$app->request->post('Newaddress')) ) {
						for ($i=0; $i < $count; $i++) { 
							$newaddresses[] = new Address();
						}
						if (!Model::loadMultiple($newaddresses, Yii::$app->request->post(), 'Newaddress')) {
							$newaddresses = [];
						}
					}

					if (
						$profileUserForm->load(Yii::$app->request->post()) &&
						$user->load(Yii::$app->request->post()) &&
						$profile->load(Yii::$app->request->post())
					) {
						if ($profileUserForm->update(
							$user,
							$profile,
							$addresses,
							$newaddresses,
							$phonenumbers,
							$newphonenumbers,
							$userkitchens
						)) {
							$this->redirect('/profile/');
						} else {
							// echo "<pre>";
							// print_r($user->errors);
							// print_r($profile->errors);
							// print_r($addresses->errors);
							// print_r($newaddresses->errors);
							// print_r($phonenumbers->errors);
							// print_r($newphonenumbers->errors);
							// print_r($userkitchens->errors);
							// echo "</pre>";
							// die();
						}
					} else {
						// echo "<pre>";
						// print_r($_POST);
						// echo "</pre>";
						// echo "<pre>";
						// print_r('profileUserForm ' . $profileUserForm->load(Yii::$app->request->post()) );
						// print_r('user ' . $user->load(Yii::$app->request->post()) );
						// print_r('profile ' . $profile->load(Yii::$app->request->post()) );
						// echo "</pre>";
						// die();
					}
				}
				return $this->render('profileuserupdate', [
					'profileUserForm' => $profileUserForm,
					'user' => $user,
					'profile' => $profile,
					'phonenumbers' => $phonenumbers,
					'newphonenumbers' => $newphonenumbers,
					'addresses' => $addresses,
					'newaddresses' => $newaddresses,
					'userkitchens' => $userkitchens,
					'kitchens' => Kitchen::find()->all(),
					'metrostations' => Metrostation::find()->all(),
				]);

				break;
			case 'cook':
				$profileCookForm = new ProfileCookForm();
				$user = User::findOne(Yii::$app->user->identity->id);
				$profile = $user->profile;
				$address = $profile->address;
				if (!$address) {
					$address = new Address(['user_id' => $user->id]);
				}
				$phonenumber = $user->phonenumber;
				$newphonenumber = [];
				$fotokitchen = $user->fotokitchen;
				$newfotokitchen = [];
				$fotodoc = $user->fotodoc;
				$newfotodoc = [];
				if (Yii::$app->request->post()) {
					if ( $countPhonenumber = count(Yii::$app->request->post('Phonenumber')) ) {
						if (!Model::loadMultiple($phonenumber, Yii::$app->request->post(), 'Phonenumber')) {
							$phonenumber = [];
						}
					}
					if ($countNewphonenumber = count(Yii::$app->request->post('Newphonenumber'))) {
						for ($i=0; $i < $countNewphonenumber; $i++) { 
							$newphonenumber[] = new Phonenumber();
						}
						if (!Model::loadMultiple($newphonenumber, Yii::$app->request->post(), 'Newphonenumber')) {
							$newphonenumber = [];
						}
					}
					$profileCookForm->fotokitchen = UploadedFile::getInstances($profileCookForm, 'fotokitchen');
					if ($count = count($profileCookForm->fotokitchen)) {
						for ($i=0; $i < $count; $i++) {
							$fk = new Fotokitchen();
							$fk->file = $profileCookForm->fotokitchen[$i];
							$newfotokitchen[] = $fk;
						}
					}
					$profileCookForm->fotodoc = UploadedFile::getInstances($profileCookForm, 'fotodoc');
					if ($count = count($profileCookForm->fotodoc)) {
						for ($i=0; $i < $count; $i++) {
							$fk = new Fotodoc();
							$fk->file = $profileCookForm->fotodoc[$i];
							$newfotokitchen[] = $fk;
						}
					}
					if (
						$profileCookForm->load(Yii::$app->request->post()) &&
						$user->load(Yii::$app->request->post()) &&
						$address->load(Yii::$app->request->post()) &&
						$profile->load(Yii::$app->request->post())
					) {
						if ($profileCookForm->update(
							$phonenumber,
							$newphonenumber,
							$user,
							$address,
							$profile,
							$newfotokitchen,
							$fotokitchen,
							$newfotodoc,
							$fotodoc
						)) {
							$this->redirect('/profile/');
						} else {
							// echo "<pre>";
							// print_r($_POST);
							// echo "</pre>";
							// die();
							// echo "<pre>";
							// $phonenumber?print_r($phonenumber->error):'';
							// $newphonenumber?print_r($newphonenumber->errors):'';
							// echo 'user'; $user?print_r($user->errors):'';
							// $address?print_r($address->errors):'';
							// $profile?print_r($profile->errors):'';
							// $newfotokitchen?print_r($newfotokitchen->errors):'';
							// $fotokitchen?print_r($fotokitchen->errors):'';
							// $newfotodoc?print_r($newfotodoc->errors):'';
							// $fotodoc?print_r($fotodoc->errors):'';
							// echo "</pre>";
							// die();
						}
					} else {
						// echo "<pre>";
						// print_r($_POST);
						// echo "</pre>";
						// echo "<pre>";
						// print_r('no load');
						// print_r( '1-' . $profileCookForm->load(Yii::$app->request->post()) );
						// print_r( '2-' . $user->load(Yii::$app->request->post()) );
						// print_r( '3-' . $address->load(Yii::$app->request->post()) );
						// print_r( '4-' . $profile->load(Yii::$app->request->post()) );
						// echo "</pre>";
						// die();
					}
				}
				return $this->render('profilecookupdate', [
					'profileCookForm' => $profileCookForm,
					'user' => $user,
					'profile' => $profile,
					'address' => $address,
					'phonenumber' => $phonenumber,
					'newphonenumber' => $newphonenumber,
					'fotokitchen' => $fotokitchen,
					'newfotokitchen' => $newfotokitchen,
					'fotodoc' => $fotodoc,
					'newfotodoc' => $newfotodoc,
					'metrostations' => Metrostation::find()->all(),
				]);
				break;
		}
	}

	public function actionProfileIconUpdate()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$profile = $user->profile;
		if (Yii::$app->request->post()) {
			// echo "<pre>";
			// var_dump($_POST);
			// echo "</pre>";
			// die();
			$profile->icon = UploadedFile::getInstance($profile, 'icon');
			if (Yii::$app->request->post('del_icon')) {
				$profile->delIcon();
			} else {
				if ($profile->icon) {
					$profile->addIcon();
				}
			}
		}
		return $this->renderPartial('profile-icon-update', [
			'user' => $user,
		]);
	}

	public function actionFoto()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$model = $user->album;
		return $this->render('foto', [
			'model' => $model,
			'user' => $user,
		]);
	}

	public function actionFotoadd()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$model = new AlbumForm();
		if ($model->load(Yii::$app->request->post())) {
			if ($album = $model->valid()) {
				$this->redirect(['user/fotoview', 'id' => $album->id]);
			}
		}
		return $this->render('fotoadd', [
			'model' => $model,
			'user' => $user,
		]);
	}

	public function actionFotoview($id)
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$album = Album::findOne($id);
		$albums = $user->album;
		$fotoform = new FotoForm();

		if (!$album) {
			throw new NotFoundHttpException('Такой альбом не найден');
		}
		if (Yii::$app->request->post()) {
			if (Yii::$app->request->post('fotodel')) {
				$foto = Foto::findOne(Yii::$app->request->post('fotodel'));
				if ($foto) {
					$foto->delete();
				}
			}
			if (Yii::$app->request->post('fotocover')) {
				$foto = Foto::findOne(Yii::$app->request->post('fotocover'));
				if ($foto) {
					$album->foto_id = $foto->id;
					$album->updateAttributes(['foto_id']);
				}
			}
			if (Yii::$app->request->post('FotoForm')) {
				if ($fotoform->load(Yii::$app->request->post())) {
					if ($fotoform->valid()) {
						$this->redirect(['user/fotoview', 'id' => $album->id]);
					}
				}
				return $this->renderPartial('fotoview/photographyadd', [
					'fotoform' => $fotoform,
					'albums' => $albums,
					'album' => $album,
					'user' => $user,
				]);
			}
		}
		return $this->render('fotoview', [
			'fotoform' => $fotoform,
			'albums' => $albums,
			'album' => $album,
			'user' => $user,
		]);
	}

	public function actionFotodel($id)
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$model = Album::findOne($id);
		if (!$model) {
			throw new NotFoundHttpException('Такой альбом не найден');
		}
		$model->delete();
		return $this->redirect(['user/foto']);
	}

	public function actionFotoupdate($album_id,$foto_id)
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$fotoform = new FotoForm();
		$album = Album::find()->where(['user_id' => $user->id])->one();
		if (!$album) {
			throw new NotFoundHttpException('Такой альбом не найден.');
		}
		$albums = $user->album;
		$foto = Foto::find()->where(['album_id' => $album->id, 'id' => $foto_id])->one();
		if (!$foto) {
			throw new NotFoundHttpException('Такая фотография не надена.');
		}
		$fotoupdateform = new FotoUpdateForm();
		$fotoupdateform->text = $foto->text;

		if (Yii::$app->request->post()) {
			if ($fotoform->load(Yii::$app->request->post())) {
				if ($fotoform->update($foto)) {
					$this->redirect(['user/fotoview', 'id' => $album->id]);
				}
				// return $this->renderPartial('fotoview/photographyadd', [
				// 	'model' => $model,
				// 	'user' => $user,
				// ]);
				// echo "<pre>";
				// print_r($fotoform->errors);
				// echo "</pre>";
				// die();
			}
		}
		return $this->render('fotoupdate', [
			'user' => $user,
			'album' => $album,
			'albums' => $albums,
			'foto' => $foto,
			'fotoupdateform' => $fotoupdateform,
		]);
	}

	public function actionMenu()
	{
		$user = Yii::$app->user->identity;
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

	public function actionMenuadd()
	{
		$user = Yii::$app->user->identity;
		$dishaddform = new DishAddForm();
		if (Yii::$app->request->post()) {
			if ($dishaddform->load(Yii::$app->request->post())) {
				if ($product = $dishaddform->valid()) {
					$this->redirect(['user/menuview', 'id' => $product->id]);
				}
			}
		}
		return $this->render('menuadd', [
			'user' => $user,
			'dishaddform' => $dishaddform,
			'kitchens' => Kitchen::find()->orderBy('header')->all(),
			'dishtypes' => Dishtype::find()->orderBy('header')->all(),
			'diets' => Diet::find()->orderBy('header')->all(),
			'measures' => Dish::getMeasures(),
		]);
	}

	public function actionMenuview($id)
	{
		$user = Yii::$app->user->identity;
		$product = Product::find()->where(['id' => $id, 'user_id' => $user->id])->one();
		$dish = $product->dish;
		return $this->render('menuview', [
			'user' => $user,
			'product' => $product,
			'dish' => $dish,
		]);
	}

	public function actionProductDelete($id)
	{
		$user = Yii::$app->user->identity;
		$product = Product::find()->where(['id' => $id, 'user_id' => $user->id])->one();
		$product->delete();
		return $this->redirect(['user/menu']);
	}

	public function actionMenuupdate($id)
	{
		$product = Product::findOne($id);
		$dish = Dish::findOne($id);
		$dishForm = new DishForm();
		$dishForm->kitchens = $product->kitchens;
		if (Yii::$app->request->post()) {
			if (
				$dishForm->load(Yii::$app->request->post()) &&
				$product->load(Yii::$app->request->post()) &&
				$dish->load(Yii::$app->request->post())
			) {
				if ($returnproduct = $dishForm->update($product,$dish)) {
					$this->redirect(['user/menuview', 'id' => $returnproduct->id]);
				}
			}
		}
		return $this->render('dishupdate', [
			'product' => $product,
			'dish' => $dish,
			'dishForm' => $dishForm,
			'kitchens' => Kitchen::find()->orderBy('header')->all(),
			'dishtypes' => Dishtype::find()->orderBy('header')->all(),
			'diets' => Diet::find()->orderBy('header')->all(),
			'measures' => Dish::getMeasures(),
		]);
	}


	public function actionSetadd()
	{
		$user = Yii::$app->user->identity;
		$setForm = new SetForm();
		$product = new Product();
		$set = new Set();
		$products = Yii::$app->db->createCommand('call cook_menu_all(:id)')
			->bindValue(':id', $user->id)
			->queryAll();
		if (Yii::$app->request->post()) {
			if (
				$product->load(Yii::$app->request->post()) &&
				$setForm->load(Yii::$app->request->post()) &&
				$set->load(Yii::$app->request->post())
			) {
				if ($newproduct = $setForm->create()) {
					$this->redirect(['user/menuview', 'id' => $newproduct->id]);
				}
			}
		}
		return $this->render('setadd', [
			'products' => $products,
			'product' => $product,
			'set' => $set,
			'setForm' => $setForm,
			'kitchens' => Kitchen::find()->orderBy('header')->all(),
			'dishtypes' => Dishtype::find()->orderBy('header')->all(),
			'diets' => Diet::find()->orderBy('header')->all(),
		]);
	}

	public function actionMycooks()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		if (Yii::$app->request->get('delid')) {
			$delcook = User::findOne(Yii::$app->request->get('delid'));
			if ($delcook) {
				$delcook->unlink('users', $user, true);
			}
		}
		$cooks = $user->cooks;
		return $this->render('mycooks', [
			'user' => $user,
			'cooks' => $cooks,
		]);
	}

	public function actionBlog()
	{
		$user = User::findOne(Yii::$app->user->identity->id);

		$limit = 10;
        $page = (is_null(Yii::$app->request->get('page')))?1:(int)Yii::$app->request->get('page');
        $offset = ($page-1)*$limit;

        $order = ['created_at' => SORT_DESC,'id' => SORT_DESC];

		$publications = Publication::find()
			->select([
				'publication.*',
				'if ( 30<LENGTH(publication.text), CONCAT(SUBSTRING(publication.text, 1, 200),\'…\'), publication.text ) AS `shorttext`',
			])
			->where(['user_id' => $user->id])
            ->orderBy($order)
            ->offset($offset)
            ->limit($limit)
            ->all();

        $pagination = new Pagination([
            'totalCount' => Publication::find()->count(), 
            'pageSize' => $limit,
        ]);

        $pagination->pageSizeParam = false;

		return $this->render('blog', [
			'user' => $user,
			'publications' => $publications,
			'pagination' => $pagination,
		]);
	}

	public function actionPublicationView($id)
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$publication = Publication::findOne($id);
		return $this->render('publication-view', [
			'user' => $user,
			'publication' => $publication,
		]);
	}

	public function actionPublicationCreate()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$publication = new Publication();
		$publication->scenario = Publication::SCENARIO_CREATE;
		$publication->user_id = $user->id;
		if (Yii::$app->request->post()) {
			$publication->file = UploadedFile::getInstance($publication, 'file');
			if ($publication->load(Yii::$app->request->post())) {
				if ($publication->validate() && $publication->save()) {
					if (Yii::$app->request->post('tagheader')) {
						foreach (Yii::$app->request->post('tagheader') as $header) {
							if ($pt = Publicationtag::find()->where(['header' => $header])->one()) {
								// $publication->link('publicationtags', $pt);
								$ppt = new PublicationPublicationtag();
								$ppt->publication_id = $publication->id;
								$ppt->publicationtag_id = $pt->id;
								$ppt->save();
							} else {
								$pt = new Publicationtag();
								$pt->header = $header;
								$pt->save();
								// $publication->link('publicationtags', $pt);
								$ppt = new PublicationPublicationtag();
								$ppt->publication_id = $publication->id;
								$ppt->publicationtag_id = $pt->id;
								$ppt->save();
							}
						}
					}
					return $this->redirect(['user/publication-view', 'id' => $publication->id]);
				}
			}
		}
		return $this->render('publication-create', [
			'user' => $user,
			'publication' => $publication,
		]);
	}

	public function actionPublicationUpdate($id)
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$publication = Publication::findOne($id);
		$publication->scenario = Publication::SCENARIO_UPDATE;
		if (Yii::$app->request->post()) {
			$publication->file = UploadedFile::getInstance($publication, 'file');
			if ($publication->load(Yii::$app->request->post())) {
				if ($publication->validate() && $publication->save()) {
					return $this->redirect(['user/publication-view', 'id' => $publication->id]);
				}
			}
		}
		return $this->render('publication-update', [
			'user' => $user,
			'publication' => $publication,
		]);
	}

	public function actionPublicationSearchTag($q)
	{
		$tags = Publicationtag::find()
			->where(['like', 'header', $q])
			->all();
		if ($tags) {
			return $this->renderPartial('publication-search-tag', [
				'tags' => $tags,
			]);
		} else {
			return '';
		}
	}

	public function actionPay()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		return $this->render('pay', [
			'user' => $user,
		]);
	}

	public function actionNotice()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		$notices = Notice::find()
			->with(['author'])
			->where(['user_id' => $user->id])
			->orderBy('created_at desc, id desc')
			->all();
		return $this->render('notice', [
			'user' => $user,
			'notices' => $notices,
		]);
	}

	// public function actionMessages()
	// {
	// 	$user = User::findOne(Yii::$app->user->identity->id);
	// 	return $this->render('messages', [
	// 		'user' => $user,
	// 	]);
	// }

	public function actionReviews()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		return $this->render('reviews', [
			'user' => $user,
		]);
	}

	public function actionRating()
	{
		$user = User::findOne(Yii::$app->user->identity->id);
		return $this->render('rating', [
			'user' => $user,
		]);
	}

}