<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?=Yii::$app->params["title"];?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<?=$content;?>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
