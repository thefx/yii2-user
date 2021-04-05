<?php

/**
 *
 * Уведомление №1: Регистрация 1
 *
 * Тема письма: Подтверждение регистрации
 *
 */

use thefx\user\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user User */

$confirmLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/email-confirm', 'token' => $user->email_confirm_token]);
?>

<p>Для завершения регистрации пройдите по ссылке:</p>

<p><?= Html::a(Html::encode($confirmLink), $confirmLink) ?></p>
