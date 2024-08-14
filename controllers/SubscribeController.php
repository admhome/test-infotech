<?php

namespace app\controllers;

use app\models\Author;
use app\models\AuthorSubscribe;
use Yii;
use yii\web\Controller;

class SubscribeController extends Controller
{
    public function actionAuthor($id)
    {
        $model = null;
        $errors = null;
        $isSubscribed = false;
        $id = abs(intval($id));
        $author = Author::findOne([
            'id' => $id,
        ]);

        if (!empty(Yii::$app->request->post()) && !empty(Yii::$app->request->post('AuthorSubscribe'))) {
            $phone = Yii::$app->request->post('AuthorSubscribe')['phone'] ?? null;

            if (!empty($phone)) {
                $model = AuthorSubscribe::findOne([
                    'author_id' => $id,
                    'phone' => $phone,
                ]);
            }
        }

        if (empty($model)) {
            $model = new AuthorSubscribe();
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->save();
            $isSubscribed = true;
        } else {
            $errors = $model->errors;
        }

        return $this->render('authorForm', [
            'model' => $model,
            'author' => $author,
            'is_subscribed' => $isSubscribed,
            'errors' => $errors,
        ]);
    }
}