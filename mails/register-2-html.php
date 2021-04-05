<?php

/**
 *
 * Уведомление №2: Регистрация 2
 *
 * Тема письма: Ваши регистрационные данные
 *
 */

use thefx\user\models\User;

/* @var $this yii\web\View */
/* @var $user User */

?>

<p>Вы успешно зарегистрированы.</p>

<p>Ваш логин <?= $user->email ?></p>
