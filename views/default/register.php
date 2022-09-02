<?php

use thefx\user\forms\SignupForm;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model SignupForm */

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

<?= $form->field($model, 'name', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('name')]])->textInput(['autofocus' => true])->label(false) ?>

<?= $form->field($model, 'lastName', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('lastName')]])->label(false) ?>

<?= $form->field($model, 'email', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('email')]])->label(false) ?>

<?//= $form->field($model, 'phone', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('phone'), 'type' => 'tel']])->label(false) ?>

<?= $form->field($model, 'password', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('password')]])->passwordInput()->label(false) ?>

<?= $form->field($model, 'passwordRepeat', ['inputOptions' => ['placeholder' => $model->getAttributeLabel('passwordRepeat')]])->passwordInput()->label(false) ?>

<?= $form->field($model, 'rules')->checkbox()->label("Я согласен на обработку персональных данных") ?>

<div class="form-group">
    <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-primary btn-block', 'name' => 'signup-button']) ?>
</div>

<?php ActiveForm::end(); ?>
