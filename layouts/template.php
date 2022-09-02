<?php

/* @var $this View */
/* @var $content string */

use thefx\user\assets\UserAsset\UserAsset;
use yii\helpers\Html;
use yii\web\View;

UserAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <?php $this->head() ?>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="form-signin">

    <h1 class="h3 mb-3 font-weight-normal"><?= Html::encode($this->title) ?></h1>

    <?= \app\widgets\Alert::widget() ?>

    <?= $content ?>

</div>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
