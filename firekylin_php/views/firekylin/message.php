<?php
/**
 * Created by PhpStorm.
 * User: bingochen
 * Date: 2016/10/17
 * Time: 10:55
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>



<!--<form role="form" action="index.php?r=firekylin%2Fsend-message" method="post">-->
<!--    <div class="form-group">-->
<!--        <label for="name">名称</label>-->
<!--        <input type="text" class="form-control" id="name" placeholder="请输入名称">-->
<!--    </div>-->
<!--    <div class="form-group">-->
<!--        <label for="inputfile">文件输入</label>-->
<!--        <input type="file" id="inputfile">-->
<!--        <p class="help-block">这里是块级帮助文本的实例。</p>-->
<!--    </div>-->
<!--    <div class="checkbox">-->
<!--        <label>-->
<!--            <input type="checkbox">请打勾-->
<!--        </label>-->
<!--    </div>-->
<!--    <button type="submit" class="btn btn-default">提交</button>-->
<!--</form>-->

<form action="index.php?r=firekylin%2Fsend-message" method="post" accept-charset="gbk"
      enctype="multipart/form-data">

    <div class="form-group">
        <label for="name">推送标题</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="请输入推送标题">
    </div>

    <div class="form-group">
        <label for="name">推送内容</label>
        <textarea class="form-control" rows="3" id="content" name="content" placeholder="请输入推送内容"></textarea>
    </div>


    <label for="name">请选择要发送的设备类型</label>
    <div>
        <label class="checkbox-inline">
            <input type="checkbox" id="inlineCheckbox1" value="iOS" name="os_type_choices[]"/>iOS
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" id="inlineCheckbox2" value="Android" name="os_type_choices[]"/>Android
        </label>
    </div>

    <label for="name">请选择要发送的设备类型</label>
    <div>
        <label class="checkbox-inline">
            <input type="checkbox" id="inlineCheckbox3" value="getui" name="channel_choisces[]">个推
        </label>
        <label class="checkbox-inline">
            <input type="checkbox" id="inlineCheckbox4" value="jiguang" name="channel_choices[]">极光
        </label>
    </div>

    <div class="form-group">
        <label for="file">请上传包含用户ID的Excel文件</label>
        <input type="file" name="file" id="file" />
        <br />
    </div>
    <input type="submit" name="submit" value="Submit" />
</form>


