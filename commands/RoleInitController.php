<?php

namespace app\commands;

use Yii;
use yii\console\Controller;
use yii\console\ExitCode;

class RoleInitController extends Controller
{
    /**
     * Configore RBAC entities
     * @return int
     * @throws \yii\base\Exception
     */
    public function actionInit(): int
    {
        $auth = Yii::$app->authManager;

        // Если зпустим повторно
        $auth->removeAll();

        //
        // 1. Гость - только просмотр + подписка на новые книги автора.
        // 2. Юзер - просмотр, добавление, редактирование, удаление.
        //

        $canUserAction = $auth->createPermission('canUserAction');
        $auth->add($canUserAction);

        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $canUserAction);

        $auth->assign($user, 1);

        $this->stdout('[OK] RBAC is done'.PHP_EOL);

        return ExitCode::OK;
    }
}