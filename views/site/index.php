<?php

/** @var yii\web\View $this */
/** @var app\models\BookWithAuthors[] $books_with_authors */

$this->title = 'Книги';
?>
<div class="site-index">

    <!-- книги + подписка -->
    <?php
    if (!empty($books_with_authors)) {
        ?>
        <div class="container">
            <div class="row row-cards">
            <?php foreach ($books_with_authors as $books_with_authors_item) { ?>

                <div class="col col-12">
                    <div class="card">
                        <div class="row row-0">
                            <div class="col-2">
                                <!-- Photo -->
                                <img src="<?= $books_with_authors_item['photo'] ?? '' ?>"
                                     alt="<?= $books_with_authors_item['name'] ?>"
                                     class="img"
                                     style="max-width: 100%;"
                                >
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h3 class="card-title"><?= $books_with_authors_item['name'] ?></h3>
                                    <?= (!empty($books_with_authors_item['year'])) ? '<p><strong>Год выпуска:</strong> '.$books_with_authors_item['year'].'</p>' : '' ?>
                                    <?= (!empty($books_with_authors_item['isbn'])) ? '<p><strong>ISBN:</strong> '.$books_with_authors_item['isbn'].'</p>' : '' ?>
                                    <p class="text-secondary"><?= $books_with_authors_item['description'] ?></p>
                                    <?php
                                    if (!empty($books_with_authors_item['bookAuthor'])) {
                                        ?>
                                        <p><strong>Авторы:</strong></p>
                                        <ul>
                                            <?php
                                            foreach ($books_with_authors_item['bookAuthor'] as $aId => $aData) {
                                                ?>
                                                <li>
                                                    <?= $aData['surname'] ?> <?= $aData['name'] ?> <?= $aData['patronymic'] ?? '' ?>
                                                    <a href="<?= \yii\helpers\Url::to(['subscribe/author', 'id' => $aData['id']]) ?>" target="_blank" title="Подписаться на автора ">
                                                        <svg xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-rss"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 19m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M4 4a16 16 0 0 1 16 16" /><path d="M4 11a9 9 0 0 1 9 9" /></svg>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
            </div>
        </div>
        <?php
    }
    ?>

</div>
