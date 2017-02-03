<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $cook_id
 * @property string $username
 * @property string $status
 * @property string $created_at
 * @property string $amount
 * @property string $delivery
 * @property integer $metro_id
 * @property string $address
 * @property string $addressdescription
 * @property string $pay
 * @property string $promocode
 *
 * @property User $cook
 * @property Metrostation $metro
 * @property User $user
 * @property Orderproduct[] $orderproducts
 * @property Product[] $products
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 'new';
    const STATUS_COOK = 'cook';
    const STATUS_DELIVER = 'deliver';
    const STATUS_CANCEL = 'cancel';
    const STATUS_DELETE = 'delete';
    const STATUS_PERFORM = 'perform';

    public static $statusName = [
        self::STATUS_NEW => 'Новый',
        self::STATUS_COOK => 'Готовится',
        self::STATUS_DELIVER => 'Доставляется',
        self::STATUS_CANCEL => 'Отменен',
        self::STATUS_DELETE => 'Удален',
        self::STATUS_PERFORM => 'Выполнен',
    ];

    const PAY_CASH = 'cash';
    const PAY_YANDEX = 'yandex';
    const PAY_VISA = 'visa';
    const PAY_WEBMONEY = 'webmoney';

    public static $payName = [
        self::PAY_CASH => 'Наличными',
        self::PAY_YANDEX => 'Яндекс.Деньги',
        self::PAY_VISA => 'Visa',
        self::PAY_WEBMONEY => 'WebMoney',
    ];

    const DELIVERY_PICKUP = 'pickup';
    const DELIVERY_COURIER = 'courier';
    const DELIVERY_METRO = 'metro';

    public static $deliveryName = [
        self::DELIVERY_PICKUP => 'Самовывоз',
        self::DELIVERY_COURIER => 'Курьер',
        self::DELIVERY_METRO => 'Доставка до метро',
    ];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_id', 'required'],
            ['user_id', 'integer'],
            ['user_id', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],

            ['cook_id', 'required'],
            ['cook_id', 'integer'],
            ['cook_id', 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['cook_id' => 'id']],

            ['username', 'required'],
            ['username', 'string', 'max' => 255],

            ['status', 'required'],
            ['status', 'string'],

            ['amount', 'required'],
            ['amount', 'number'],

            ['delivery', 'required'],
            ['delivery', 'string'],

            ['costdelivery', 'required'],
            ['costdelivery', 'number'],

            ['pay', 'required'],
            ['pay', 'string'],

            ['metro_id', 'integer'],
            ['metro_id', 'exist', 'skipOnError' => true, 'targetClass' => Metrostation::className(), 'targetAttribute' => ['metro_id' => 'id']],

            ['created_at', 'safe'],

            ['address',  'string', 'max' => 255],

            ['addressdescription', 'string', 'max' => 255],

            ['promocode', 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'cook_id' => 'Cook ID',
            'username' => 'Username',
            'status' => 'Status',
            'created_at' => 'Created At',
            'amount' => 'Amount',
            'delivery' => 'Способ доставки',
            'metro_id' => 'Metro ID',
            'address' => 'Address',
            'addressdescription' => 'Addressdescription',
            'pay' => 'Способ оплаты',
            'promocode' => 'Promocode',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCook()
    {
        return $this->hasOne(User::className(), ['id' => 'cook_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMetro()
    {
        return $this->hasOne(Metrostation::className(), ['id' => 'metro_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderproducts()
    {
        return $this->hasMany(Orderproduct::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProducts()
    {
        return $this->hasMany(Product::className(), ['id' => 'product_id'])->viaTable('orderproduct', ['order_id' => 'id']);
    }
}
