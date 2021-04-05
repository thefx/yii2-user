<?php
/* @var $this yii\web\View */
/* @var $form ActiveForm */
/* @var $model PasswordResetForm */

use thefx\user\forms\PasswordResetForm;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Восстановить пароль';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="mb-3 mt-4">Введите Ваш новый пароль:</div>

<?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

<?= $form->field($model, 'password')->passwordInput(['autofocus' => true]) ?>

<div class="form-group">
    <?= Html::submitButton('Сохранить пароль', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?>
