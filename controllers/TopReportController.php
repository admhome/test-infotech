<?php

namespace app\controllers;

use app\models\BookAuthor;
use Yii;
use yii\helpers\VarDumper;
use yii\web\Controller;
use app\models\Book;
use app\models\Author;

class TopReportController extends Controller
{
    public function actionIndex(int $year = 0)
    {
        // Отчет - ТОП 10 авторов выпуствиших больше книг за какой-то год.
        $availableYears = Book::find()
            ->select(['year'])
            ->distinct()
            ->orderBy(['year' => 'ASC'])
            ->asArray()
            ->all();

        /*
            SELECT
                COUNT(book.year) AS `books`
                 , author.surname
            FROM book
            LEFT JOIN bookAuthor bA on book.id = bA.book_id
            LEFT JOIN author on author.id = bA.author_id
            WHERE book.year = 2024
            GROUP BY author.surname
            ORDER BY books DESC
            LIMIT 10
         */
        $authors = Book::find()
            ->select([
                'COUNT(book.year) AS books',
                "TRIM(CONCAT(author.surname, ' ', author.name, ' ', COALESCE(author.patronymic, ''))) AS fullname"
            ])
            ->join('LEFT JOIN', BookAuthor::tableName(), 'bookAuthor.book_id = book.id')
            ->join('LEFT JOIN', Author::tableName(), 'bookAuthor.author_id = author.id')
            ->where(['book.year' => $year])
            ->groupBy('fullname')
            ->orderBy(['books' => 'DESC'])
            ->limit(10)
            ->asArray()
            ->all() ?? [];

        //
        // ->orderBy(['books' => 'DESC']) почему-то не сработал
        //
        if (!empty($authors)) {
            array_multisort(array_map(function($item){
                return $item['books'];
            }, $authors), SORT_DESC, $authors);
        }

        return $this->render('index', [
            'available_years' => $availableYears ?? [],
            'year' => $year,
            'authors' => $authors,
        ]);
    }
}