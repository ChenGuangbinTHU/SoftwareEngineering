<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/11/10
 * Time: 9:53
 */
use yii\helpers\Html;
use yii\grid\GridView;
use  app\models\Message;
$this->title = 'Inquiry All History';
?>

<?=
yii\grid\GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'uuid',
        'title',
        'content',
        'users',
        'time',
        'params',
    ],
]); ?>
