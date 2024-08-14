<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\BookWithAuthors $model */
/** @var app\models\Author $authors */

$this->title = 'Новая книга';
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'authors' => $authors,
    ]) ?>

</div>
