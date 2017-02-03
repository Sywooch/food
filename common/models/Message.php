<?php

namespace common\models;

use Yii;
use \DateTime;

class Message extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'message';
    }

    public function rules()
    {
        return [
            [['author_id', 'recipient_id', 'text'], 'required'],
            [['author_id', 'recipient_id', 'read'], 'integer'],
            [['read'], 'integer', 'max' => 1, 'min' => 0],
            [['read'], 'default', 'value' => 0],
            [['created_at'], 'default', 'value' => date('Y-m-d h:i:s')],
            [['created_at'], 'safe'],
            [['text'], 'string'],
            [['author_id', 'recipient_id', 'created_at'], 'unique', 'targetAttribute' => ['author_id', 'recipient_id', 'created_at'], 'message' => 'The combination of Author, Recipient and Created At has already been taken.'],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['author_id' => 'id']],
            [['recipient_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['recipient_id' => 'id']],
        ];
    }

    public function attributeLabels()
    {
        return [
            'author_id' => 'Ид. автора',
            'recipient_id' => 'Ид. получателя',
            'created_at' => 'Создано',
            'read' => 'Прочтено получателем',
            'text' => 'Сообщение',
        ];
    }

    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    public function getRecipient()
    {
        return $this->hasOne(User::className(), ['id' => 'recipient_id']);
    }

    public function created_atToStr()
    {
        if (!$this->created_at) {
            return null;
        }
        if ( !($ts = strtotime($this->created_at)) ) {
            return null;
        }
        $Yn = date("Y");
        $mn = date("m");
        $dn = date("d");
        $Hn = date("H");
        $in = date("i");
        $sn = date("s");

        $Y = date("Y", $ts);
        $m = date("m", $ts);
        $d = date("d", $ts);
        $H = date("H", $ts);
        $i = date("i", $ts);
        $s = date("s", $ts);

        $a = [];
        $a[] = ($Y === $Yn)?1:0;
        $a[] = ($m === $mn)?1:0;
        $a[] = ($d === $dn)?1:0;
        $a[] = ($H === $Hn)?1:0;
        $a[] = ($i === $in)?1:0;
        $a[] = ($s === $sn)?1:0;

        $mdatetime = new DateTime("$Y-$m-$d $H:$i:$s");
        $datetime = new DateTime("$Y-$m-$d");
        $now = new DateTime("$Yn-$mn-$dn");
        $interval = $datetime->diff($now);
        $i = (int)$interval->format('%a');
        if ($i>1) {
            if ($a[0]) {
                return $mdatetime->format('d-m  H:i');
            } else {
                return $mdatetime->format('d-m-Y  H:i');
            }
        } elseif ($i==1) {
            return 'вчера в ' . $mdatetime->format('H:i:s');
        } else {
            return $mdatetime->format('H:i:s');
        }

    }
}
