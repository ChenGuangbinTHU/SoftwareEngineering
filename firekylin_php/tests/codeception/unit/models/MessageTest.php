<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/11/10
 * Time: 13:21
 */
namespace tests\codeception\unit\models;
use app\models\Message;
use yii\codeception\TestCase;


class MessageTest extends  TestCase{
    public function  testCreateMyMessage(){
        $m = new Message();
        $m->id = "4";
        $m->uuid = "4";
        $this->assertTrue($m->save());
    }

    public function testUpdateMyMessage() {
        $m = new Message();
        $m->id = "6";
        $m->uuid = "6";
        $this->assertTrue($m->save());
        $this->assertEquals("6", $m->id);
    }
    public function testDeleteMyMessage() {
        $m = Message::findOne(['id' => '6']);
        $this->assertNotNull($m);
        Message::deleteAll(['id' => $m->id]);
        $m = Message::findOne(['id' => '6']);
        $this->assertNull($m);
    }
}
?>




