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

<form action="index.php?r=firekylin%2Fsend-message" method="post" accept-charset="utf-8"
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

    <label for="name">请选择要发送的渠道</label>
    <div align="left">
        <label class="radio-inline">
            <input type="radio" id="optionsRadios1" value="jiguang" name="channel_choices"/>极光
        </label>
        <label class="radio-inline">
            <input type="radio" id="optionsRadios2" value="getui" name="channel_choices"/>个推
        </label>
    </div>

    <div class="form-group">
        <label for="file">请上传包含用户ID的Excel文件</label>
        <input type="file" name="file" id="file" />
        <br />
    </div>
    <input type="submit" name="submit" value="Submit" />
</form>


