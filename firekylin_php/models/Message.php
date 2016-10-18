<?php
/**
 * Created by PhpStorm.
 * User: bingochen
 * Date: 2016/10/17
 * Time: 10:52
 */

namespace app\models;

class Message extends \yii\base\Model
{
    public $uuid;
    public $users;
    public $os_type;
    public $channel;
    public $title;
    public $content;
    public $time;
    public $param;
    public $file;

    public function rules()
    {
        return [
            [['file'],'file'],
        ];
    }
}