<?php

namespace app\commands;

use app\models\User;
use yii\console\Controller;
use yii\console\ExitCode;

class UserController extends Controller
{
    protected $password = 'user+12';

    public function actionCreateUser(): int
    {
        $user = User::find()
            ->where([
                'username' => 'user'
            ])
            ->one();

        if (empty($user)) {
            $this->stdout('Create new user'.PHP_EOL);

            $user = new User();

            $user->username = 'user';
            $user->email = 'user@user.use';
            $user->status = User::STATUS_ACTIVE;
            $user->setPassword($this->password);
            $user->generateAuthKey();

            if ($user->save()) {
                $this->stdout('[OK] User was saved, his ID: '.$user->getId().PHP_EOL);
            } else {
                $this->stdout('[ERR] Can\'t save this uder!'.PHP_EOL);
            }
        } else {
            $this->stdout('User already in database, his ID: '.$user->getId().PHP_EOL);
        }

        return ExitCode::OK;
    }

    /**
     * Change password for user
     * @return int Exit code
     */
    public function actionSetDefaultPassword(): int
    {
        $user = User::find()
            ->where([
                'username' => 'user'
            ])
            ->one();

        $user->setPassword($this->password);
        $user->generateAuthKey();

        if ($user->save()) {
            $this->stdout('[OK] User is updates' . PHP_EOL);
        } else {
            $this->stdout('[ERR] User is not saved!' . PHP_EOL);
        }

        return ExitCode::OK;
    }
}