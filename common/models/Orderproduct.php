<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "orderproduct".
 *
 * @property integer $order_id
 * @property integer $product_id
 * @property integer $quantity
 * @property string $amount
 *
 * @property Order $order
 * @property Product $product
 */
class Orderproduct extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orderproduct';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id', 'quantity', 'amount'], 'required'],
            [['order_id', 'product_id', 'quantity'], 'integer'],
            [['amount'], 'number'],
            [['order_id', 'product_id'], 'unique', 'targetAttribute' => ['order_id', 'product_id'], 'message' => 'The combination of Order ID and Product ID has already been taken.'],
            [['order_id'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_id' => 'id']],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Product::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_id' => 'Order ID',
            'product_id' => 'Product ID',
            'quantity' => 'Quantity',
            'amount' => 'Amount',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
}
