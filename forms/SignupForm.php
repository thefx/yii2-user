<?php

namespace thefx\user\forms;

use app\shop\EmailHelper;
use thefx\user\models\User;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $name;
    public $lastName;
    public $phone;
    public $username;
    public $email;
    public $password;
    public $passwordRepeat;
    public $verifyCode;

    public function rules()
    {
        return [
            [['name', 'lastName', 'phone'], 'required'],
            [['name', 'lastName', 'phone'], 'string'],

//            ['username', 'filter', 'filter' => 'trim'],
//            ['username', 'required'],
//            ['username', 'match', 'pattern' => '#^[\w_-]+$#i'],
//            ['username', 'unique', 'targetClass' => User::class, 'message' => 'Такой логин уже зарегистрирован в системе.'],
//            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique', 'targetClass' => User::class, 'message' => 'Такой email уже зарегистрирован в системе.'],

            [['password', 'passwordRepeat'], 'required'],
            ['password', 'string', 'min' => 6],

            ['passwordRepeat', 'compare', 'compareAttribute' => 'password'],

//            ['verifyCode', 'captcha', 'captchaAction' => '/user/default/captcha'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'created_at' => 'Создан',
            'updated_at' => 'Обновлён',
            'username' => 'Имя пользователя',
            'name' => 'Имя',
            'lastName' => 'Фамилия',
            'email' => 'Email',
            'phone' => 'Телефон',
            'status' => 'Статус',
            'password' => 'Пароль',
            'passwordRepeat' => 'Повторить пароль',
            'verifyCode' => 'Код с картинки'
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = \app\shop\entities\Users\User::create(
                $this->name,
                $this->lastName,
                $this->phone,
                $this->email,
                $this->password
            );
            if ($user->save()) {
                EmailHelper::userRegister($user);
                EmailHelper::userRegisterNotifyAdmin($user);
                return $user;
            }
        }

        return null;
    }
}
