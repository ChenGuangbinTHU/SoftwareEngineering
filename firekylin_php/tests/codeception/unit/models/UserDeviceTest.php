<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/11/15
 * Time: 15:40
 */
namespace tests\codeception\unit\models;
use app\models\UserDevice;
use yii\codeception\TestCase;


class UserDeviceTest extends  TestCase{
    public function  testCreateMyUserDevice(){
        $m = new UserDevice();
        $m->id = "72";
        $m->user_id = "72";
        $this->assertTrue($m->save());
    }

    public function testUpdateMyUserDevice() {
        $m = new UserDevice();
        $m->id = "98";
        $m->user_id = "98";
        $this->assertTrue($m->save());
        $this->assertEquals("98", $m->id);
    }
    public function testDeleteMyUserDevice() {
        $m = UserDevice::findOne(['id' => '98']);
        $this->assertNotNull($m);
        UserDevice::deleteAll(['id' => $m->id]);
        $m = UserDevice::findOne(['id' => '98']);
        $this->assertNull($m);
    }
}
?>




