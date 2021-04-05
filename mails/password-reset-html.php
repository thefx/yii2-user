<?php

/**
 *
 * Уведомление №3: Вы забыли пароль
 *
 * Тема письма: Смена пароля
 *
 */

use thefx\user\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user User */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['user/default/password-reset', 'token' => $user->password_reset_token]);
?>

<p>Для смены пароля пройдите по ссылке:</p>

<?= Html::a(Html::encode($resetLink), $resetLink) ?>
