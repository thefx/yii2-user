<?php

namespace thefx\user\forms;

use thefx\user\models\User;
use Yii;
use yii\base\Model;

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
    public $rules;

    public function rules()
    {
        return [
            [['name', 'lastName'/*, 'phone'*/], 'required'],
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
            ['rules', 'match', 'pattern' => '/^1$/', 'message' => 'Согласитесь с условиями']

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
            'verifyCode' => 'Код с картинки',
            'rules' => 'Я согласен на обработку персональных данных',
        ];
    }

    /**
     * Signs user up.
     *
     * @return User the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {

            $model = new User();
            $model->username = uniqid('', true);
            $model->name = $this->name;
            $model->last_name = $this->lastName;
            $model->email = $this->email;
            $model->phone = $this->phone;
            $model->status = User::STATUS_WAIT;
            $model->setPassword($this->password);
            $model->generateAuthKey();
            $model->generateEmailConfirmToken();

            if ($model->save()) {
                Yii::$app->mailer->compose(['html' => '@thefx/user/mails/email-confirm-html'], ['user' => $model])
                    ->setFrom([Yii::$app->params['emailNoReply'] => Yii::$app->params['nameNoReply']])
                    ->setTo($model->email)
                    ->setSubject('Завершить регистрацию')
                    ->send();
                return $model;
            }
        }

        return null;
    }
}
