<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "publication_publicationtag".
 *
 * @property integer $publication_id
 * @property integer $publicationtag_id
 *
 * @property Publication $publication
 * @property Publicationtag $publicationtag
 */
class PublicationPublicationtag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publication_publicationtag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['publication_id', 'publicationtag_id'], 'required'],
            [['publication_id', 'publicationtag_id'], 'integer'],
            [['publication_id', 'publicationtag_id'], 'unique', 'targetAttribute' => ['publication_id', 'publicationtag_id'], 'message' => 'The combination of Publication ID and Publicationtag ID has already been taken.'],
            [['publication_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publication::className(), 'targetAttribute' => ['publication_id' => 'id']],
            [['publicationtag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Publicationtag::className(), 'targetAttribute' => ['publicationtag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'publication_id' => 'Publication ID',
            'publicationtag_id' => 'Publicationtag ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublication()
    {
        return $this->hasOne(Publication::className(), ['id' => 'publication_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublicationtag()
    {
        return $this->hasOne(Publicationtag::className(), ['id' => 'publicationtag_id']);
    }
}
