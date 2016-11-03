<?php
namespace models;
use app\models\Message;
use app\models\UserDevice;
use Yii;
use app\models\User;
use yii\codeception\TestCase;

class ExampleTest extends TestCase
{
    private $_user;
    private $_mes;
    private $_user_device;
    /**
     * @var \UnitTester
     */
    protected $tester;

    protected function _before()
    {
        $this->_user = new User();
        $this->_mes = new Message();
        $this->_user_device = new UserDevice();
    }

    protected function _after()
    {

    }

    // tests
    public function testUser()
    {
        $this->_user->id = '2';
        $this->_user->name = '523454';
        $this->_user->password ='54323532';
        $this->_user->save();
        $this->tester->seeInDatabase('user',[
            'id' => $this->_user->id,
            'name' =>$this->_user->name,
            'password'=>$this->_user->password,
        ]);
    }

    public function testMessage(){
        $this->_mes->id = '3';
        $this->_mes->uuid = '11';
        $this->_mes->title = 'hello3';
        $this->_mes->content = 'content 3';
        $this->_mes->users = '11';

        $this->_mes->save();
        $this->tester->seeInDatabase('message',[
            'id'=>$this->_mes->id,
            'uuid'=>$this->_mes->uuid,
            'title'=>$this->_mes->title,
            'content'=>$this->_mes->content,
            'users'=>$this->_mes->users,
        ]);
    }

    public function testUserDevice(){
        $this->_user_device->id = '1';
        $this->_user_device->user_id = '1';
        $this->_user_device->os_type = 'android';
        $this->_user_device->channel = '2';
        $this->_user_device->device_id = '11';
        $this->_user_device->save();
        $this->tester->seeInDatabase('user_device',[
            'id'=>$this->_user_device->id,
            'user_id'=>$this->_user_device->user_id,
            'os_type'=>$this->_user_device->os_type,
            'channel'=>$this->_user_device->channel,
            'device_id'=>$this->_user_device->device_id,
        ]);
    }
}