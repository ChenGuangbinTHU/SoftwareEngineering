<?php
/**
 * Created by PhpStorm.
 * User: bingochen
 * Date: 2016/10/10
 * Time: 15:06
 */

namespace app\controllers;

use app\models\Message;
use yii\web\Controller;
use app\models\statistic;
use app\models\user;
use app\models\userdevice;
use Yii;
use yii\web\UploadedFile;



class FirekylinController extends Controller
{
    public $enableCsrfValidation = false;
    private $uploadPath = '';

    function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config = []);
        $this->uploadPath = Yii::$app->basePath.'//uploads//';
    }

    public function actionRegister()
    {
        $post_data = Yii::$app->request->post();
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

    public function parseExcel($path)
    {
        $PHPExcel = new \PHPExcel();
        $PHPReader = new \PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($path)) { // 这里是用Reader尝试去读文件，07不行用05，05不行就报错。注意，这里的return是Yii框架的方式。
            $PHPReader = new \PHPExcel_Reader_Excel5();

            if (!$PHPReader->canRead($path))
            {
                $errorMessage = "Can not read file.";
                return $errorMessage;
            }
        }
        $PHPExcel = $PHPReader->load($path);
        $currentSheet = $PHPExcel->getSheet(0);
        $highestRow = $currentSheet->getHighestRow();
        $highestColumn = $currentSheet->getHighestColumn();
        $userIDArray = array();
        $count = 0;
        for($row = 1;$row <= $highestRow;$row++)
        {
            for($column = 'A';$column <= $highestColumn;$column++)
            {
                $value = $currentSheet->getCell($column.$row)->getValue();
                if($value == '')
                    continue;
               array_push($userIDArray,(string)$value);
            }
        }
        return $userIDArray;

    }


    public function fileExists($filePath)
    {
        if(!file_exists($filePath)){
            mkdir($filePath);
        }
        return $filePath;
    }

    function uuid($prefix = '')
    {
        $chars = md5(uniqid(mt_rand(), true));
        $uuid  = substr($chars,0,8) . '-';
        $uuid .= substr($chars,8,4) . '-';
        $uuid .= substr($chars,12,4) . '-';
        $uuid .= substr($chars,16,4) . '-';
        $uuid .= substr($chars,20,12);
        return $prefix . $uuid;
    }

    public function array2String($arr)
    {
        $result = '';
        if(count($arr) > 0)
        {
            foreach($arr as $i)
            {
                $result .= ($i.',');
            }
        }
        return $result;
    }

    public function actionSendMessage()
    {
        $message = new Message();

        $otherInfoArray = array();
        $messageInfoArray = array();
        $userIDArray = null;
        $osTypeArray = array();
        $channelArray = array();
        $paramArray = array();

        $uuid = $this->uuid();
        $time = date('Y-m-d h:i:s',time());

        array_push($otherInfoArray,$uuid,$time);

        $message->uuid = $uuid;
        $message->time = $time;
        $message->params = $this->array2String($paramArray);

        if(Yii::$app->request->isPost)
        {
            $post_data = Yii::$app->request->post();

            $message->title = $post_data['title'];
            $message->content = $post_data['content'];

            array_push($messageInfoArray,$post_data['title'],$post_data['content']);

            if(count($post_data['os_type_choices']) > 0)
            {
                foreach($post_data['os_type_choices'] as $i)
                {
                    array_push($osTypeArray,$i);
                }
            }
            else
            {
                echo "<script>alert('设备类型不能为空');</script>";
                return $this->render('message');
            }

            if(count($post_data['channel_choices']) > 0)
            {
                foreach($post_data['channel_choices'] as $i)
                {
                    array_push($channelArray,$i);
                }
            }
            else
            {
                echo "<script>alert('渠道不能为空');</script>";
                return $this->render('message');
            }

            if ($_FILES["file"]["type"] == "application/vnd.ms-excel" || $_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
            {
                $filepath = "upload/" . $_FILES["file"]["name"];
                $this->fileExists("upload/");
                move_uploaded_file($_FILES["file"]["tmp_name"],
                    $filepath);
                $userIDArray = $this->parseExcel($filepath);
            }
            else
            {
                echo "<script>alert('请上传Excel文件');</script>";
                return $this->render('message');
            }

            $message->users = $this->array2String($userIDArray);
            $message->save();

            return json_encode(['other'=>$otherInfoArray,'message'=>$messageInfoArray,'os_type'=>$osTypeArray,'channel'=>$channelArray,'userID'=>$userIDArray,'params'=>$paramArray]);
        }

        return $this->render('message');


    }

    public function actionIndex()
    {
        //echo(json_encode(['user_id'=>'666','os_type'=>'apple','channel'=>'light','device_id'=>'2132']));
        //$this->parseExcel();
    }
}
