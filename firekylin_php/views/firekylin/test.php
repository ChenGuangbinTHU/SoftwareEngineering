<?php

use app\components\SideBar;
use yii\helpers\Html;
?>
<?= Html::jsFile("@web/js/sidebar.js"); ?>
<?= SideBar::widget() ?>