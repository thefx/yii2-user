<?php

namespace thefx\user;

use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->getUrlManager()->addRules([
            '<_a:(login|logout|register|email-confirm|password-reset-request|password-reset|email-confirm-request)>' => 'user/default/<_a>',
        ], false);

        /*
         * Регистрация модуля в приложении
         * (вместо указания в файле frontend/config/main.php
         */
//        $app->setModule('mytest', 'thefx\user\Module');
    }
}