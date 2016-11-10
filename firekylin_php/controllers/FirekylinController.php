<?php
/**
 * Created by PhpStorm.
 * User: bingochen
 * Date: 2016/10/10
 * Time: 15:06
 */

namespace app\controllers;

use app\models\HistoryForm;
use app\models\LoginSiteForm;
use app\models\Message;
use app\models\OriginUser;
use yii\base\Object;
use yii\web\Controller;
use app\models\Statistic;
use app\models\User;
use app\models\UserDevice;
use Yii;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;



class DeviceOS
{
    public $osType;
    public $deviceID;

    public function __construct($_osType,$_deviceID)
    {
        $this->osType = $_osType;
        $this->deviceID = $_deviceID;
    }
}

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
        if(Yii::$app->request->isPost)
        {
            $post_data = Yii::$app->request->post();
            $user = new User();
            $user->id = $post_data['id'];
            $user->name = $post_data['name'];
            $user->password = $post_data['password'];
            if(User::findOne(['name',$post_data['name']]))
                return json_encode(['message'=>'fail']);
            if($user->save())
                return json_encode(['message'=>'success']);
            return json_encode(['message'=>'fail']);
        }
    }


    public function actionFindUser()
    {
        if(Yii::$app->request->isPost)
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
    }

    public function actionUserDevice()
    {
        if(Yii::$app->request->isPost)
        {
            $post_data = Yii::$app->request->post();
            $user_id = $post_data['user_id'];
            $os_type = $post_data['os_type'];
            $channel = $post_data['channel'];
            $device_id = $post_data['device_id'];
            if($device_id == null)
                return;
            $user_device = UserDevice::findOne(['device_id'=>$device_id]);
            if($user_device != null)
            {
                $user_device->user_id = $user_id;
                $user_device->os_type = $os_type;
                $user_device->channel = $channel;
                $user_device->device_id = $device_id;
                $user_device->save();
                return;
            }


            $user_device = new UserDevice();
            $user_device->user_id = $user_id;
            $user_device->os_type = $os_type;
            $user_device->channel = $channel;
            $user_device->device_id = $device_id;
            $user_device->save();
        }

    }

    public function actionStatistic()
    {
        if(Yii::$app->request->isPost)
        {
            $post_data = Yii::$app->request->post();
            $statistic = Statistic::findOne(['uuid'=>$post_data['uuid']]);
            if($statistic == null)
                $statistic = new Statistic();
            $statistic->uuid = $post_data['uuid'];
            $statistic->user_id = $post_data['user_id'];
            $statistic->os_type = $post_data['os_type'];
            $statistic->channel = $post_data['channel'];
            $statistic->device_id = $post_data['device_id'];
            $statistic->status = $post_data['status'];
            $statistic->save();
        }
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
        if (Yii::$app->user->isGuest) {
            return $this->redirect('index.php?r=firekylin/login-site');
        }
        $message = new Message();
        $otherInfoArray = array();
        $messageInfoArray = array();
        $userIDArray = null;
        $osTypeArray = array();
        $channelArray = array();
        $paramArray = array();
        $userDeviceArray = null;
        $deviceOSArray = array();
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

            if($post_data['channel_choices'] != null)
            {
                array_push($channelArray,$post_data['channel_choices']);
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

            foreach($userIDArray as $userID)
            {
                $userDeviceArray = UserDevice::findAll(['user_id'=>$userID]);
                foreach($userDeviceArray as $i)
                {
                    if(in_array($i->os_type,$osTypeArray))
                        array_push($deviceOSArray,new DeviceOS($i->os_type,$i->device_id));
                }
            }
            $message->users = $this->array2String($userIDArray);
            $message->save();
            $jsonData = json_encode(['uuid'=>$uuid,'other'=>$otherInfoArray,'message'=>$messageInfoArray,'device_os'=>$deviceOSArray,'channel'=>$channelArray,'params'=>$paramArray]);
            //return $jsonData;
            $url = 'http://ides3.free.natapp.cc/';
            $this->send_post($url,'_heng'.$jsonData.'gneh_');
        }
        return $this->render('message');
    }


    public function actionInquiryHistory()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect('index.php?r=firekylin/login-site');
        }
        $model = new HistoryForm();
        if ($model->load(Yii::$app->request->post())) {
            $msgID = $model->id;
            $message = Message::findOne(['uuid' => $msgID]);
            if($message == null)
                return $this->redirect('index.php?r=firekylin/inquiry-history');
            $model->content = $message->content;
            //发送数
            $model->sendNum = 1;
            $usersID = array();
            $temp = 0;
            $usersStr = $message->users;
            for ($i = 0; $i < strlen($usersStr); $i++) {
                if ($usersStr[$i] == ',') {
                    $model->sendNum++;
                    for ($j = $temp; $j < $i; $j++) {
                        $usersID[$model->sendNum-2] .= $usersStr[$j];
                    }
                    $temp = $i + 1;
                }
            }
            for ($k = $temp; $k < strlen($usersStr); $k++) {
                $usersID[$model->sendNum - 1] .= $usersStr[$k];
            }

            //设备个数
            $deviceStr = array();
            $deviceStr = Statistic::findALL(['uuid'=>$msgID]);
            $model->deviceNum  += count($deviceStr);

            //到达数显示数点击数
            $model->reachNum = 0;
            $model->showNum = 0;
            $model->clickNum = 0;

            $mes_status = array();
            $mes_status = Statistic::findAll(['uuid'=>$msgID]);
            for($q=0;$q<count($mes_status);$q++){
                if($mes_status[$q]->status == 'RECEIVED') $model->reachNum++;
                if($mes_status[$q]->status == 'SHOWED') $model->showNum++;
                if($mes_status[$q]->status == 'CLICKED') $model->clickNum++;
            }
            return $this->render('showhistory', ['model' => $model]);
        }
        else{
            return $this->render('inquiryhistory',['model'=>$model]);
        }
    }



    function send_post($url, $params)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params)
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_TIMEOUT,3);
        $res = curl_exec($ch);
        curl_close($ch);
        //var_dump($res);



    }


    public function actionIndex()
    {
        //phpinfo();
        //echo(json_encode(['uuid'=>'adssasda','os_type'=>'Android','user_id'=>'213221','channel'=>'getui','device_id'=>'123456','status'=>'RECEIVE']));
        return $this->redirect('index.php?r=firekylin/login-site');
    }

    public function actionLoginSite()//登陆界面
    {
        if (!Yii::$app->user->isGuest) {
            Yii::$app->user->logout();
        }
        $model = new LoginSiteForm();
        if($model->load(Yii::$app->request->post())){
            if($model->username=='admin'&&$model->password=='admin'){
                Yii::$app->user->login(OriginUser::findByUsername("admin"),3600*24*30);
                return $this->redirect('index.php?r=firekylin/send-message');
            }
            else {
                \Yii::$app->getSession()->setFlash('error', 'Incorrect username or password');
                return $this->goBack('index.php?r=firekylin/login-site');
            }
        }
        else{
            return $this->render('login',['model'=>$model]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function actionInquiryAll()
    {
        $model= new Message();
        $dataProvider = new ActiveDataProvider([
            'query'=>Message::find()->orderBy('id'),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('inquiryall',[
            'model'=>$model,
            'dataProvider'=>$dataProvider,
        ]);
    }



}


//class Admin extends Object implements IdentityInterface
//{
//    public $id;
//    public $username;
//    public $password;
//    public $authKey;
//    public $accessToken;
//
//    private static $users = [
//        '100' => [
//            'id' => '100',
//            'username' => 'admin',
//            'password' => 'admin',
//            'authKey' => 'test100key',
//            'accessToken' => '100-token',
//        ],
//        '101' => [
//            'id' => '101',
//            'username' => 'demo',
//            'password' => 'demo',
//            'authKey' => 'test101key',
//            'accessToken' => '101-token',
//        ],
//    ];
//
//
//    /**
//     * @inheritdoc
//     */
//    public static function findIdentity($id)
//    {
//        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public static function findIdentityByAccessToken($token, $type = null)
//    {
//        foreach (self::$users as $user) {
//            if ($user['accessToken'] === $token) {
//                return new static($user);
//            }
//        }
//
//        return null;
//    }
//
//    /**
//     * Finds user by username
//     *
//     * @param string $username
//     * @return static|null
//     */
//    public static function findByUsername($username)
//    {
//        foreach (self::$users as $user) {
//            if (strcasecmp($user['username'], $username) === 0) {
//                return new static($user);
//            }
//        }
//
//        return null;
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function getId()
//    {
//        return $this->id;
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function getAuthKey()
//    {
//        return $this->authKey;
//    }
//
//    /**
//     * @inheritdoc
//     */
//    public function validateAuthKey($authKey)
//    {
//        return $this->authKey === $authKey;
//    }
//
//    /**
//     * Validates password
//     *
//     * @param string $password password to validate
//     * @return boolean if password provided is valid for current user
//     */
//    public function validatePassword($password)
//    {
//        return $this->password === $password;
//    }
//}
