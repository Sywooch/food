<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;
use common\models\Kitchen;
use common\models\Diet;
use common\models\Product;
use common\models\Dish;
use common\models\Dishtype;
use common\models\Set;
use common\models\SetDish;
use Yii;
use yii\web\UploadedFile;
use yii\db\Transaction;
use yii\base\ErrorException;

class DishForm extends Model
{
	public $kitchens = [];
	public $leftproductfoto = [];
	public $diettrue;
	public $fotos;

	public function rules()
	{
		return [
			['kitchens', 'required'],
			['kitchens', 'each', 'rule' => ['exist',
				'skipOnEmpty' => false,
				'skipOnError' => false,
				'targetClass' => Kitchen::className(),
				'targetAttribute' => 'header',
			]],
			
			['diettrue', 'boolean'],
			['diettrue', 'default', 'value' => '0'],
			
			['leftproductfoto', 'safe'],
		];
	}

	public function attributeLabels()
	{
		return [
			'kitchen' => 'Кухня',
		];
	}

	public function create($product, $dish)
	{
		$product->scenario = 'create';
	}

	public function update($product, $dish)
	{
		$product->fotos = UploadedFile::getInstances($this, 'fotos');

		$vthis = $this->validate();
		$vproduct = $product->validate();
		$vfotos = true;
		if (!$this->leftproductfoto && !$product->fotos) {
			$this->addError('fotos','При сохранении необходимо оставить или добавить хотя бы одну фотографию блюда.');
			$vfotos = false;
		}
		if ($dish->ingredients) {
			$dish->ingredients = json_encode($dish->ingredients);
		} else {
			$dish->ingredients = null;
		}
		$vdish = $dish->validate();
		if ( !$vthis || !$vproduct || !$vdish || !$vfotos ) {
			// echo "<pre>";
			// print_r($product->errors);
			// echo "</pre>";
			// echo "<pre>";
			// print_r($dish->errors);
			// echo "</pre>";
			// echo "<pre>";
			// print_r($this->errors);
			// echo "</pre>";
			// die();
			return null;
		}

		$transaction = Yii::$app->db->beginTransaction(
			Transaction::SERIALIZABLE
		);
		try {
			$productfotos = $product->productfotos;
			if ($productfotos) {
				foreach ($productfotos as $key => $pf) {
					if (in_array($pf->id, $this->leftproductfoto)) {
					} else {
						if ($product->foto_id == $pf->id) {
							$product->foto_id = null;
							$product->updateAttributes(['foto_id']);
						}
						$pf->delete();
					}
				}
			}
			if ($product->validate()) {
				$product->save();
			} else {
				throw new ErrorException("Продукт не сохранен после редактирования.");
			}
			if ($dish->validate()) {
				$dish->save();
			} else {
				throw new ErrorException("Блюдо не сохранено после редактирования.");
			}
		} catch (ErrorException $e) {
            $transaction->rollBack();
            throw $e;
		}
		$transaction->commit();
		return $product;
	}
}






