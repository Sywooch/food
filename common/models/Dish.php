<?php

namespace common\models;

use Yii;

class Dish extends \yii\db\ActiveRecord
{

    public function getShortText()
    {
        if ($this->text) {
            if (mb_strlen($this->text) > 200) {
                return mb_substr($this->text, 0, 200);
            } else {
                return $this->text;
            }
        } else {
            return null;
        }
    }

    public static function tableName()
    {
        return 'dish';
    }

    public function rules()
    {
        return [
            ['product_id', 'required'],
            ['product_id', 'integer'],
            ['product_id', 'unique'],
            ['product_id', 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],

            ['dishtype_id', 'required'],
            ['dishtype_id', 'integer'],
            ['dishtype_id', 'exist', 'skipOnError' => true, 'targetClass' => Dishtype::className(), 'targetAttribute' => ['dishtype_id' => 'id']],

            ['diet_id', 'integer'],
            ['diet_id', 'exist', 'skipOnError' => true, 'targetClass' => Diet::className(), 'targetAttribute' => ['diet_id' => 'id']],

            ['weight', 'required'],
            ['weight', 'integer'],

            ['timefrom', 'required'],
            ['timefrom', 'integer'],

            ['timeto', 'required'],
            ['timeto', 'integer'],

            ['text', 'required'],
            ['text', 'string'],

            ['calories', 'integer'],

            ['proteins', 'integer'],

            ['fats', 'integer'],

            ['carbohydrates', 'integer'],

            ['ingredients', 'string'],

            ['video', 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'product_id' => 'Product ID',
            'dishtype_id' => 'Dishtype ID',
            'diet_id' => 'Diet ID',
            'weight' => 'Weight',
            'timefrom' => 'Timefrom',
            'timeto' => 'Timeto',
            'text' => 'Text',
            'calories' => 'Calories',
            'proteins' => 'Proteins',
            'fats' => 'Fats',
            'carbohydrates' => 'Carbohydrates',
            'ingredients' => 'Ingredients',
            'video' => 'Video',
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

    public function getIngr()
    {
        if ( $this->ingredients && ($array = json_decode($this->ingredients)) ) {
            return $array;
        } else {
            return [];
        }
    }

    public function getDiet()
    {
        return $this->hasOne(Diet::className(), ['id' => 'diet_id']);
    }

    public function getDishtype()
    {
        return $this->hasOne(Dishtype::className(), ['id' => 'dishtype_id']);
    }

    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }

    public function getDishKitchens()
    {
        return $this->hasMany(DishKitchen::className(), ['dish_id' => 'product_id']);
    }

    public function getKitchens()
    {
        return $this->hasMany(Kitchen::className(), ['id' => 'kitchen_id'])->viaTable('dish_kitchen', ['dish_id' => 'product_id']);
    }

    public function getSetDishes()
    {
        return $this->hasMany(SetDish::className(), ['dish_id' => 'product_id']);
    }

    public function beforeDelete()
    {
        if (parent::beforeDelete()) {
            $this->unlinkAll('kitchens', true);
            return true;
        } else {
            return false;
        }
    }
}
