<?php

namespace thefx\user\forms;

use thefx\user\models\User;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Model;

class EmailConfirmForm extends Model
{
    /**
     * @var User
     */
    private $_user;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config
     */
    public function __construct(string $token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Отсутствует код подтверждения.');
        }
        $this->_user = User::findByEmailConfirmToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Неверный токен.');
        }
        parent::__construct($config);
    }

    /**
     * Confirm email.
     *
     * @return boolean if email was confirmed.
     */
    public function confirmEmail(): bool
    {
        $user = $this->_user;
        $user->status = User::STATUS_ACTIVE;
        $user->removeEmailConfirmToken();

        return $user->save();
    }

    public function sendEmail(): bool
    {
        return Yii::$app->mailer->compose(['html' => '@thefx/user/mails/register-2-html'], ['user' => $this->_user])
            ->setFrom([Yii::$app->params['emailNoReply'] => Yii::$app->params['nameNoReply']])
            ->setTo($this->_user->email)
            ->setSubject('Ваши регистрационные данные')
            ->send();
    }
}
