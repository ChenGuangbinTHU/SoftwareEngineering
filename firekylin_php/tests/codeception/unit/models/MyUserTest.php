<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/11/10
 * Time: 13:51
 */
namespace tests\codeception\unit\models;
use app\models\User;
use yii\codeception\TestCase;
class ExampleTest extends TestCase {
    public function testCreateMyUser() {
        $m = new User();
        $m->name = "myuser";
        $m->password = "myser@yiibai.com";
        $this->assertTrue($m->save());
    }
    public function testUpdateMyUser() {
        $m = new User();
        $m->name = "myuser2";
        $m->password = "myser2@yiibai.com";
        $this->assertTrue($m->save());
        $this->assertEquals("myuser2", $m->name);
    }
    public function testDeleteMyUser() {
        $m = User::findOne(['name' => 'myuser2']);
        $this->assertNotNull($m);
        User::deleteAll(['name' => $m->name]);
        $m = User::findOne(['name' => 'myuser2']);
        $this->assertNull($m);
    }
}
?>