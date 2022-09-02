<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model LoginForm */
/* @var $allowRegister bool */

use thefx\user\forms\LoginForm;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCss('
    .radio label, .checkbox label {
        padding-left: 0;
    }
');
?>

<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

<?= $form->field($model, 'email', [
    'errorOptions' => ['encode' => false, 'class' => 'invalid-feedback'],
    'inputOptions' => ['placeholder' => 'Email'],
])->textInput(['autofocus' => true])->label(false) ?>

<?= $form->field($model, 'password', [
    'inputOptions' => ['placeholder' => 'Пароль'],
])->passwordInput()->label(false) ?>

<?= $form->field($model, 'rememberMe')->checkbox() ?>

<div class="form-group">
    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary btn-block', 'name' => 'login-button']) ?>
</div>

<div>
    <a href="/password-reset-request">Забыли пароль?</a>
</div>

<?php if ($allowRegister) : ?>
    <div>
        <a href="/register">Регистрация</a>
    </div>
<?php endif; ?>


<?php ActiveForm::end(); ?>
