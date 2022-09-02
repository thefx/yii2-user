<?php

namespace thefx\user;

/**
 * GUI manager for RBAC.
 *
 * Use [[\yii\base\Module::$controllerMap]] to change property of controller.
 *
 * ```php
 * 'controllerMap' => [
 *     'default' => [
 *         'class' => 'thefx\user\controllers\DefaultController',
 *         'allowRegister' => true,
 *     ],
 * ],
 * ```php
 */
class Module extends \yii\base\Module
{
    public $layout = '@thefx/user/layouts/template.php';
    public $register = false;
}
