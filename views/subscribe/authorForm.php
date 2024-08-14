<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\AuthorSubscribe $model */
/** @var \app\models\Author $author */
/** @var bool $is_subscribed */
/** @var mixed $errors */

use app\models\AuthorSubscribe;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Подписка';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-wrapper">
    <div class="page-header">
        <div class="container">
            <div class="row align-items-center mw-100">
                <div class="col">
                    <h2 class="page-title"><?= Html::encode($this->title) ?></h2>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container">
            <div class="card card-md">
                <div class="card-body">

                    <?php if (!empty($errors)) { ?>
                        <div class="alert alert-warning" role="alert">
                            <div class="d-flex">
                                <div>
                                    <!-- Download SVG icon from http://tabler-icons.io/i/alert-triangle -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 9v4"></path><path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path><path d="M12 16h.01"></path></svg>
                                </div>
                                <div>
                                    <h4 class="alert-title">Обнаружены ошибки!</h4>
                                    <div class="text-secondary">
                                        <?= \yii\helpers\VarDumper::dump($errors) ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>

                    <?php if ($is_subscribed) { ?>

                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">

                                <div class="modal-status bg-success"></div>
                                <div class="modal-body text-center py-4">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon text-success icon-lg icon-tabler-mail-forward"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5"></path><path d="M3 6l9 6l9 -6"></path><path d="M15 18h6"></path><path d="M18 15l3 3l-3 3"></path></svg>

                                    <h3>Готово</h3>
                                    <div class="text-secondary">Вы подписались на новые книги автора!</div>
                                </div>

                            </div>
                        </div>

                    <?php } else { ?>

                        <?php $form = ActiveForm::begin([
                            'id' => 'author-subscribe-form',
                        ]); ?>

                        <div class="mb-3">
                            <label class="form-label">Автор</label>
                            <div>
                            <span class="form-control">
                                <?= $author->surname ?>
                                <?= $author->name ?>
                                <?= $author->patronymic ?? '' ?>
                            </span>
                                <input type="hidden" name="AuthorSubscribe[author_id]" value="<?= $author->id ?>">
                            </div>
                        </div>

                        <?= $form->field($model, 'phone')->textInput(['autofocus' => true]) ?>

                        <div class="form-group">
                            <div>
                                <?= Html::submitButton('Подписаться', ['class' => 'btn btn-primary', 'name' => 'author-subscribe-button']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>

                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</div>
