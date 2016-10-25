<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/10/18
 * Time: 21:51
 */
use yii\helpers\Html;
?>
<p style="color: #ff0d21">查询消息发送状态历史:</p>

<ul>
    <li style="font-size: 50px"><label>ID</label>: <?= Html::encode($model->id) ?></li>
    <li style="font-size: 50px"><label>消息内容</label>:<?= Html::encode($model->content) ?></li>
    <li style="font-size: 50px"><label>发送人数 </label>:<?= Html::encode($model->sendNum) ?></li>
    <li style="font-size: 50px"><label>设备个数</label>:<?= Html::encode($model->deviceNum) ?></li>
    <li style="font-size: 50px"><label>到达数</label>:<?= Html::encode($model->reachNum) ?></li>
    <li style="font-size: 50px"><label>显示数</label>:<?= Html::encode($model->showNum) ?></li>
    <li style="font-size: 50px"><label>点击数</label>:<?= Html::encode($model->clickNum) ?></li>
</ul>