<?php

namespace common\models;

use Yii;
use yii\base\ErrorException;

class Product extends \yii\db\ActiveRecord
{

	const PRODUCT_DISH = 'dish';
	const PRODUCT_SET = 'set';

	public $fotos;
	public $shorttext;

	public static $typeName = [
		self::PRODUCT_DISH => 'Блюдо',
		self::PRODUCT_SET => 'Набор',
	];

    public function getShortText()
    {
    	return $this->dish->shortText;
    }

	public function getPricecurrent()
	{
		return ($this->pricesale)?$this->pricesale:$this->price;
	}

	public static function tableName()
	{
		return 'product';
	}

	public function rules()
	{
		return [
			['user_id', 'required'],
			['user_id', 'integer'],
			['user_id', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
			
			['header', 'required'],
			['header', 'string', 'tooShort' => 'Не менее 5 символов', 'max' => 160],
			[['user_id', 'header'], 'unique', 'targetAttribute' => ['user_id', 'header'], 'message' => 'В вашем меню уже есть блюдо с таким названием, придумайте что-то оригинальное.'],
			['price', 'required'],
			['price', 'number'],

			['pricesale', 'number'],
			['pricesale', 'default', 'value' => null],

			['type', 'required'],
			['type', 'string', 'max' => 255],
			['type', 'in', 'range' => [self::PRODUCT_DISH, self::PRODUCT_SET], 'strict' => true],

			['fotos', 'required', 'on' => ['create']],
			['fotos', 'each', 'rule' => ['file',
				'skipOnEmpty' => false,
				'extensions' => 'png, jpg, jpeg',
				'maxSize' => 9*1024*1024,
				'mimeTypes' => 'image/jpeg, image/png',
			]],

			['foto_id', 'integer', 'skipOnEmpty' => true],
			['foto_id', 'exist', 'targetClass' => Productfoto::className(), 'targetAttribute' => ['foto_id' => 'id'], 'skipOnError' => false, 'skipOnEmpty' => true],
			['foto_id', 'default', 'value' => null],
		];
	}

	public function attributeLabels()
	{
		return [
			'id' => 'ID',
			'user_id' => 'User ID',
			'header' => 'Header',
			'price' => 'Price',
			'pricesale' => 'Pricesale',
			'type' => 'Type',
		];
	}

	public function getDish()
	{
		return $this->hasOne(Dish::className(), ['product_id' => 'id']);
	}

	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}
	
	public function getSet()
	{
		return $this->hasOne(Set::className(), ['product_id' => 'id']);
	}

	public function getKitchens()
	{
		return $this->hasMany(Kitchen::className(), ['id' => 'kitchen_id'])->viaTable('dish_kitchen', ['dish_id' => 'id']);
	}

	public function getProductfotos()
	{
		return $this->hasMany(Productfoto::className(), ['product_id' => 'id']);
	}

	public function getProductfoto()
	{
		return $this->hasOne(Productfoto::className(), ['id' => 'foto_id']);
	}

	public function addFotos()
	{
		foreach ($this->fotos as $key => $foto) {
			$productfoto = new Productfoto();
			$productfoto->product_id = $this->id;
			$productfoto->file = $foto;
			if ($productfoto->validate()) {
				$productfoto->save();
				if ($key === 0) {
					if (!$this->foto_id) {
						$this->foto_id = $productfoto->id;
						$this->updateAttributes(['foto_id']);
					}
				}
			} else {
				throw new ErrorException("Не удалось добавить фотографию к продукту.");
			}
		}
	}

	public function getIconsrc($icon = null)
	{
		if ($this->foto_id) {
			if ($icon) {
				return $this->productfoto->getSource($icon);
			}
			return $this->productfoto->source;
		} else {
			return null;
		}
	}

	// return true|false
	public function getIsInBasket()
	{
		$session = Yii::$app->session;
		if ( !$session->isActive ) {
			$session->open();
		}
		if ( !$session->has('basket') ) {
			return false;
		}
		$basket = $session->get('basket');
		// echo "<pre>";
		// var_dump(isset($basket[$this->id]));
		// echo "</pre>";
		// die();
		return isset($basket[$this->id])?true:false;
	}

	public function afterFind()
	{
		parent::afterFind();
		$this->price = round($this->price);
		$this->pricesale = (is_null($this->pricesale))?null:round($this->pricesale);
	}

	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);
		if ($this->fotos) {
			$this->addFotos();
		}
	}

	public function beforeDelete()
	{
		if (parent::beforeDelete()) {
			$this->unlinkAll('kitchens', true);
			$this->foto_id = null;
			$this->updateAttributes(['foto_id']);
			$productfotos = $this->productfotos;
			if ($productfotos) {
				foreach ($productfotos as $key => $p) {
					$p->delete();
				}
			}
			switch ($this->type) {
				case self::PRODUCT_DISH:
					$dish = $this->dish;
					$dish->delete();
					break;
				case self::PRODUCT_SET:
					$set = $this->set;
					$set->delete();
					break;
			}
			return true;
		} else {
			return false;
		}
	}
}
