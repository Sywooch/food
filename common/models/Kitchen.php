<?php

namespace common\models;

use Yii;
use common\components\Text;
use common\components\ctrait\Sid;

/**
 * This is the model class for table "kitchen".
 *
 * @property integer $id
 * @property string $sid
 * @property string $header
 */
class Kitchen extends \yii\db\ActiveRecord
{
    use Sid;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'kitchen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['header'], 'required'],
            [['sid', 'header'], 'string', 'max' => 160],
            [['sid'], 'unique'],
            [['header'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'Ид. кухни',
            'sid' => 'Строковый ид.',
            'header' => 'Наименование',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $this->sid = self::sid($this->sid,$this->header);
            if ($this->sid === '') {
                $this->addError('sid', 'Строковый идентификатор не смог создасться из заголовка, измените заголовок.');
                return false;
            }
            return true;
        } else {
            return false;
        }
    }

    public function getDishKitchens()
    {
        return $this->hasMany(DishKitchen::className(), ['kitchen_id' => 'id']);
    }

    public function getDishes()
    {
        return $this->hasMany(Dish::className(), ['product_id' => 'dish_id'])->viaTable('dish_kitchen', ['kitchen_id' => 'id']);
    }

    public function getKitchenUsers()
    {
        return $this->hasMany(KitchenUser::className(), ['kitchen_id' => 'id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::className(), ['id' => 'user_id'])->viaTable('kitchen_user', ['kitchen_id' => 'id']);
    }
}
