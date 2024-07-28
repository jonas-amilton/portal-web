<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $content
 * @property string $publication_date
 * @property array $postFiles
 * @property object $user
 * 
 * @property Users $users
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'title'], 'required'],
            [['user_id'], 'integer'],
            [['content'], 'string'],
            [['publication_date'], 'safe'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'title' => Yii::t('app', 'Titulo'),
            'content' => Yii::t('app', 'Publicação'),
            'publication_date' => Yii::t('app', 'Publication Date'),
        ];
    }

    /**
     * Override the save method to set default values
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert) {
                $this->publication_date = date('Y-m-d H:i:s');
            }
            return true;
        }
        return false;
    }

    /**
     * Define the relationship with the PostFiles model
     */
    public function getPostFiles()
    {
        return $this->hasMany(PostFiles::class, ['post_id' => 'id']);
    }

    /**
     * Gets the user who created the post.
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'user_id']);
    }
}