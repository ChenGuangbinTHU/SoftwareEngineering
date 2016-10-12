<?php
/**
 * Created by PhpStorm.
 * User: bingochen
 * Date: 2016/10/10
 * Time: 15:06
 */

namespace app\controllers;

use yii\web\Controller;
use app\models\statistic;
use app\models\user;
use app\models\userdevice;
use Yii;




class FirekylinController extends Controller
{
    public $enableCsrfValidation = false;

    public function actionRegister()
    {
        $post_data = Yii::$app->request->post();
        echo($post_data);
        $user = new User();
        $user->id = $post_data['id'];
        $user->name = $post_data['name'];
        $user->password = $post_data['password'];
        if($user->save())
            return json_encode(['message'=>'success']);
        return json_encode(['message'=>'fail']);

    }

    public function actionFinduser()
    {
        $post_data = Yii::$app->request->post();
        $userName = $post_data['name'];
        if(User::findUser($userName))
        {
            $user_id = User::findOne(['name'=>$userName])->id;
            return json_encode(['message'=>'success','user_id'=>$user_id]);
        }
        else
        {
            return json_encode(['message'=>'fail','user_id'=>'0']);
        }
    }

    public function actionUserdevice()
    {
        $post_data = Yii::$app->request->post();
        $user_id = $post_data['user_id'];
        $os_type = $post_data['os_type'];
        $channel = $post_data['channel'];
        $device_id = $post_data['device_id'];
        $user_device = UserDevice::findOne(['user_id'=>$user_id]);
        if($user_device == null)
            $user_device = new UserDevice();
        $user_device->user_id = $user_id;
        $user_device->os_type = $os_type;
        $user_device->channel = $channel;
        $user_device->device_id = $device_id;
        $user_device->save();
    }

    public function actionIndex()
    {
        echo(json_encode(['user_id'=>'666','os_type'=>'apple','channel'=>'light','device_id'=>'2132']));
    }
}