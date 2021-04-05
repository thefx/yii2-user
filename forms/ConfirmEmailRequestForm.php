<?php
namespace thefx\user\forms;

use app\shop\EmailHelper;
use app\shop\entities\Users\User;
use yii\base\Model;
/**
 * Confirm Email Request
 */
class ConfirmEmailRequestForm extends Model
{
    public $email;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
        ];
    }

    public function sendEmail()
    {
        if ($this->validate()) {
            $user = User::findOne(['email' => $this->email]);
            return EmailHelper::userRegister($user);
        }

        return false;
    }
}
