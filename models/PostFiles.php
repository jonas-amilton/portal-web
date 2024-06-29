<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post_files".
 *
 * @property int $id
 * @property int $post_id
 * @property string $filename
 * @property string|null $extensao
 * @property string $publication_date
 */
class PostFiles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post_files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['post_id', 'filename', 'publication_date'], 'required'],
            [['post_id'], 'integer'],
            [['publication_date'], 'safe'],
            [['filename'], 'string', 'max' => 255],
            [['extensao'], 'string', 'max' => 5],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'post_id' => Yii::t('app', 'Post ID'),
            'filename' => Yii::t('app', 'Nome do arquivo'),
            'extensao' => Yii::t('app', 'Extensão'),
            'publication_date' => Yii::t('app', 'Data de Publicação'),
        ];
    }
}
