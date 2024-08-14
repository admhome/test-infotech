<?php

/** @var yii\web\View $this */
/** @var array $available_years */
/** @var int $year */
/** @var array $authors */

$this->title = 'Топ-10 книг по авторам';
?>
<div class="container">
    <?php if (!empty($available_years)) { ?>
        <div class="row">
            <div class="col">
                <ol class="breadcrumb" aria-label="breadcrumbs">
                    <?php foreach ($available_years as $availableYearItem) { ?>
                        <li class="breadcrumb-item">
                            <a href="<?= \yii\helpers\Url::to(['top-report/index', 'year' => $availableYearItem['year']]) ?>">
                                <?= $availableYearItem['year'] ?>
                            </a>
                        </li>
                    <?php } ?>
                </ol>
            </div>
        </div>
    <?php } ?>

    <div class="row">
        <div class="col">
            <?php if (!empty($authors)) { ?>
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped">
                        <tr>
                            <th>Автор</th>
                            <th>Кол-во книг</th>
                        </tr>
                        <?php foreach ($authors as $aKey => $authorItem) { ?>
                            <tr>
                                <td><?= $authorItem['fullname'] ?></td>
                                <td><?= $authorItem['books'] ?></td>
                            </tr>
                        <?php } ?>
                    </table>
                </div>
            <?php } else { ?>
                <div class="alert alert-warning" role="alert">
                    <div class="d-flex">
                        <div>
                            <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg>
                        </div>
                        <div>
                            <h4 class="alert-title">Ошибка</h4>
                            <div class="text-secondary">Авторов не обнаружено </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
