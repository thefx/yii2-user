<?php

namespace thefx\user\controllers;

use InvalidArgumentException;
use thefx\user\forms\ConfirmEmailRequestForm;
use thefx\user\forms\EmailConfirmForm;
use thefx\user\forms\LoginForm;
use thefx\user\forms\PasswordResetForm;
use thefx\user\forms\PasswordResetRequestForm;
use thefx\user\forms\SignupForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use Yii;
use yii\web\Response;

class DefaultController extends Controller
{
    /**
     * @var bool
     */
    public $allowRegister = true;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'register'],
                'rules' => [
                    [
                        'actions' => ['register'],
                        'allow' => $this->allowRegister,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goBack();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $model,
            'allowRegister' => $this->allowRegister,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionRegister()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $user = $model->signup()) {
            Yii::$app->getSession()->setFlash('info', 'Для завершения регистрации, Вам необходимо зайти на почту и пройти по ссылке.');
            return $this->redirect('/login');
        }

        return $this->render('register', [
            'model' => $model,
        ]);
    }

    /**
     * @param $token
     * @return Response
     */
    public function actionEmailConfirm($token)
    {
        try {
            $model = new EmailConfirmForm($token);
        } catch (\yii\base\InvalidArgumentException $e) {
            return $this->renderContent($e->getMessage());
        }

        if ($model->confirmEmail()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Ваш Email успешно подтверждён.');
            $model->sendEmail();
        } else {
            Yii::$app->getSession()->setFlash('error', 'Ошибка подтверждения Email.');
        }

        return $this->redirect('/login');
    }

    public function actionPasswordResetRequest()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Спасибо! На ваш Email было отправлено письмо со ссылкой на восстановление пароля.');
                return $this->redirect(['login']);
            }
            Yii::$app->getSession()->setFlash('error', 'Извините. У нас возникли проблемы с отправкой.');
        }

        return $this->render('password-reset-request', [
            'model' => $model,
        ]);
    }

    public function actionEmailConfirmRequest($email)
    {
        $model = new ConfirmEmailRequestForm();
        if ($model->load(Yii::$app->request->get(), '') && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Для завершения регистрации, Вам необходимо зайти на&nbsp;почту и пройти по ссылке.');
                return $this->redirect(['login']);
            }
            Yii::$app->getSession()->setFlash('error', 'Извините. У нас возникли проблемы с отправкой.');
        }
        return $this->goHome();
    }

    public function actionPasswordReset($token)
    {
        try {
            $model = new PasswordResetForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Спасибо! Пароль успешно изменён.');

            return $this->redirect('/login');
//            return $this->goHome();
        }

        return $this->render('password-reset', [
            'model' => $model,
        ]);
    }
}
