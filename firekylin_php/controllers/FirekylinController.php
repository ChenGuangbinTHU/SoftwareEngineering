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
        $user->save();
        echo('success');
    }

    public function actionFinduser()
    {
        $post_data = Yii::$app->request->post();
        $userName = $post_data['name'];


        if(User::findUser($userName))
        {
            echo('success');
        }
        else
        {
            echo('fail');
        }
    }

//    public function actionUserdevice()
//    {
//        $post_data = Yii::$app->request->post();
//
//    }

    public function actionIndex()
    {
        echo(json_encode(['name'=>'wangdong','password'=>'wangdong']));
    }
}