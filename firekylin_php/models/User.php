<?php
/**
 * Created by PhpStorm.
 * User: bingochen
 * Date: 2016/10/10
 * Time: 20:14
 */

namespace app\models;

class User extends \yii\db\ActiveRecord
{
    public static function findUser($userName)
    {
        if(User::findOne(['name'=>$userName]) == null)
            return false;
        return true;
    }
}