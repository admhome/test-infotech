<?php

namespace app\models;

use Yii;
use app\models\BookAuthor;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property int $book_id
 * @property int $author_id
 * @property array $author_ids
 */
class BookWithAuthors extends Book
{
    public $author_ids = [];

//    public function rules()
//    {
//        return ArrayHelper::merge(parent::rules(), [
//            ['author_ids', 'each', 'rule' => [
//                'exists', 'targetClass' => Author::className(), 'targetAttribute' => 'id'
//            ]]
//        ]);
//    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'author_ids' => 'Авторы',
        ]);
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return \yii\db\ActiveQuery
     * @throws InvalidConfigException
     */
    public function getBookAuthor(): \yii\db\ActiveQuery
    {
        return $this
            ->hasMany(Author::className(), ['id' => 'author_id'])
            ->viaTable('bookAuthor', ['book_id' => 'id']);
    }

    public function loadAuthors()
    {
        $this->author_ids = [];

        if (!empty($this->id)) {
            $authors = BookAuthor::find()
                ->select(['author_id'])
                ->where(['book_id' => $this->id])
                ->asArray()
                ->all();

            if (!empty($authors)) {
                foreach ($authors as $aKey => $authorItem) {
                    $this->author_ids[] = $authorItem['author_id'];
                }
            }
        }
    }

    public function saveAuthors()
    {
        BookAuthor::deleteAll(['book_id' => $this->id]);

        if (!empty($this->author_ids) && is_array($this->author_ids)) {
            foreach ($this->author_ids as $authorId) {
                $ba = new BookAuthor();
                $ba->book_id = $this->id;
                $ba->author_id = $authorId;
                $ba->save();
            }
        }
    }
}