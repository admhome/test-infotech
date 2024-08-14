<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string|null $surname
 * @property string $name
 * @property string|null $patronymic
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['surname', 'name', 'patronymic'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'surname' => 'Фамилия',
            'name' => 'Имя',
            'patronymic' => 'Отчество',
        ];
    }

    public static function getAvailableAuthors()
    {
        $authors = self::find()
            ->select(['id', "TRIM(CONCAT(surname, ' ', name, ' ', COALESCE(patronymic, ''))) AS fullname"])
            ->orderBy('surname')
            ->asArray()
            ->all();

        return ArrayHelper::map($authors, 'id', 'fullname');
    }

    public static function getAuthorsByIds(array $ids)
    {
        $authors = self::find()
            ->select(['id', "TRIM(CONCAT(surname, ' ', name, ' ', COALESCE(patronymic, ''))) AS fullname"])
            ->where(['id' => $ids])
            ->orderBy('surname')
            ->asArray()
            ->all();

        return ArrayHelper::map($authors, 'id', 'fullname');
    }
}
