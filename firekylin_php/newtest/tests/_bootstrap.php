
<?php

// This is global bootstrap for autoloading

require('C:\Users\bingochen\Desktop\Junior\software\project\firekylin\firekylin_php\vendor\autoload.php');
require('C:\Users\bingochen\Desktop\Junior\software\project\firekylin\firekylin_php\vendor\yiisoft\yii2\Yii.php');

$config = require('C:\Users\bingochen\Desktop\Junior\software\project\firekylin\firekylin_php\config\console.php');
//
$application = new yii\console\Application( $config );