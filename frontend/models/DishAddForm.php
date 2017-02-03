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

class DishAddForm extends Model
{
	public $header;
	public $kitchen = [];
	public $dishtype_id;
	public $diettrue;
	public $diet_id;
	public $weight;
	public $timefrom;
	public $timeto;
	public $price;
	public $pricesale;
	public $text;
	public $calories;
	public $proteins;
	public $fats;
	public $carbohydrates;
	public $fotos;
	public $ingredients = [];
	public $video;

	public function rules()
	{
		return [
			['header', 'required'],
			['header', 'string', 'min' => 1, 'tooShort' => 'Не менее 5 символов', 'max' => 160],
			
			['kitchen', 'required'],
			['kitchen', 'each', 'rule' => ['exist',
				'skipOnEmpty' => false,
				'skipOnError' => false,
				'targetClass' => Kitchen::className(),
				'targetAttribute' => 'header',
			]],
			
			['dishtype_id', 'required'],
			['dishtype_id', 'exist', 
				'skipOnEmpty' => true,
				'skipOnError' => false,
				'targetClass' => Dishtype::className(), 
				'targetAttribute' => 'id',
			],

			['diettrue', 'boolean'],
			['diettrue', 'default', 'value' => '0'],
			
			['diet_id', 'integer'],
			['diet_id', 'exist',
				'skipOnEmpty' => true,
				'targetClass' => Diet::className(),
				'targetAttribute' => 'id',
			],
			
			['weight', 'required'],
			['weight', 'integer'],
			
			['timefrom', 'required'],
			['timefrom', 'integer'],
			
			['timeto', 'required'],
			['timeto', 'integer'],
			
			['price', 'required'],
			['price', 'double'],
			
			['pricesale', 'double'],
			['pricesale', 'default', 'value' => null],
			
			['text', 'required'],
			['text', 'string'],
			
			['calories', 'integer'],
			['calories', 'default', 'value' => null],
			
			['proteins', 'integer'],
			['proteins', 'default', 'value' => null],
			
			['fats', 'integer'],
			['fats', 'default', 'value' => null],
			
			['carbohydrates', 'integer'],
			['carbohydrates', 'default', 'value' => null],
			
			['fotos', 'required'], 
			['fotos', 'each', 'rule' => ['file', 
				'skipOnEmpty' => false, 
				'extensions' => 'png, jpg, jpeg',
				'maxSize' => 9*1024*1024, 
				'mimeTypes' => 'image/jpeg, image/png',
			]],
			
			['ingredients', function($attribute, $params){
			}],
			
			['video', 'string'],
			['video', 'default', 'value' => null],
		];
	}

	public function attributeLabels()
	{
		return [
			'header' => 'Наименование',
			'kitchen' => 'Кухня',
			'dishtype_id' => 'Категория',
			'diet_id' => 'Диета',
			'weight' => 'Вес',
			'timefrom' => 'Время приготовления от',
			'timeto' => 'Время приготовления до',
			'price' => 'Цена',
			'pricesale' => 'Цена (акция)',
			'text' => 'Описание',
			'calories' => 'Энергетическая ценность на процию',
			'proteins' => 'Белки',
			'fats' => 'Жиры',
			'carbohydrates' => 'Углеводы',
			'fotos' => 'Фотографии',
			'ingredients' => 'Ингридиенты',
			'video' => 'Видео',
		];
	}

	public function getMeasures()
	{
		return [
			1 => 'грамм',
			2 => 'миллилитров',
			3 => 'штук',
			4 => 'щепоток',
			5 => 'чайных ложек',
			6 => 'столовых ложек',
			7 => 'стаканов',
		];
	}

	public function valid()
	{
		$this->fotos = UploadedFile::getInstances($this, 'fotos');

		if (!$this->validate()) {
			// echo "<pre>";
			// print_r($_POST);
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

			$user = User::findOne(Yii::$app->user->identity->id);

			$product = new Product();
			$product->user_id = $user->id;
			$product->header = $this->header;
			$product->price = $this->price;
			$product->pricesale = $this->pricesale;
			$product->type = Product::PRODUCT_DISH;
			$product->fotos = $this->fotos;
			if ($product->validate()) {
				$product->save();
			} else {
				if (isset($product->errors)) {
					foreach ($product->errors as $errors) {
						foreach ($errors as $errorText) {
							$this->addError('model', $errorText);
						}
					}
				}
				throw new ErrorException("Не удалось добавить продукт.");
			}

			$dish = new Dish();
	        $dish->product_id = $product->id;
	        $dish->dishtype_id = $this->dishtype_id;
	        $dish->diet_id = $this->diet_id;
	        $dish->weight = $this->weight;
	        $dish->timefrom = $this->timefrom;
	        $dish->timeto = $this->timeto;
	        $dish->text = $this->text;
	        $dish->calories = $this->calories;
	        $dish->proteins = $this->proteins;
	        $dish->fats = $this->fats;
	        $dish->carbohydrates = $this->carbohydrates;
	        $ingredients = [];
	        if ($dish->ingredients) {
	        	foreach ($dish->ingredients['name'] as $key => $name) {
	        		if ($name && $dish->ingredients['quantity'][$key] && $dish->ingredients['measure'][$key]) {
	        			$ingredients['name'][] = $name;
	        			$ingredients['quantity'][] = $dish->ingredients['quantity'][$key];
	        			$ingredients['measure'][] = $dish->ingredients['measure'][$key];
	        		}
	        	}
	        }
	        if ($ingredients) {
		        $dish->ingredients = json_encode($ingredients);
	        } else {
	        	$dish->ingredients = null;
	        }
	        $dish->video = $this->video;
			if ($dish->validate()) {
				$dish->save();
				foreach ($this->kitchen as $key => $value) {
					$kitchen = Kitchen::find()->where(['header' => $value])->one();
					$dish->link('kitchens', $kitchen);
				}
			} else {
				if (isset($dish->errors)) {
					foreach ($dish->errors as $errors) {
						foreach ($errors as $errorText) {
							$this->addError('model', $errorText);
						}
					}
				}
				throw new ErrorException("Не удалось добавить блюдо.");
			}


        } catch (ErrorException $e) {
			$transaction->rollBack();
			throw $e;
        }

		$transaction->commit();
		return $product;
	}
}






