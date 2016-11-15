<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/10/18
 * Time: 21:51
 */
use yii\helpers\Html;
use yii\bootstrap;
$this->title = 'Show History';
?>

<!DOCTYPE html>
<html>
<head>
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="/scripts/jquery.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>

<table class="table table-hover">
    <caption>历史查询</caption>

    <thead>
    <tr>
        <th>ID</th>
        <th>消息内容</th>
        <th>发送人数</th>
        <th>设备个数</th>
        <th>到达数</th>
        <th>显示数</th>
        <th>点击数</th>
    </tr>
    </thead>

    <tbody>
    <tr>
        <td><?=Html::encode($model->id)?></td>
        <td><?=Html::encode($model->content)?></td>
        <td><?=Html::encode($model->sendNum)?></td>
        <td><?=Html::encode($model->deviceNum)?></td>
        <td><?=Html::encode($model->reachNum)?></td>
        <td><?=Html::encode($model->showNum)?></td>
        <td><?=Html::encode($model->clickNum)?></td>
    </tr>
    </tbody>
</table>

</body>
</html>
