<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/11/15
 * Time: 15:34
 */
namespace tests\codeception\unit\models;
use app\models\statistic;
use yii\codeception\TestCase;


class StatisticTest extends  TestCase{
    public function  testCreateMyStatistic(){
        $m = new statistic();
        $m->id = "2";
        $m->uuid = "2";
        $this->assertTrue($m->save());
    }

    public function testUpdateMyStatistic() {
        $m = new statistic();
        $m->id = "7";
        $m->uuid = "7";
        $this->assertTrue($m->save());
        $this->assertEquals("7", $m->id);
    }
    public function testDeleteMyStatistic() {
        $m = statistic::findOne(['id' => '7']);
        $this->assertNotNull($m);
        statistic::deleteAll(['id' => $m->id]);
        $m = statistic::findOne(['id' => '7']);
        $this->assertNull($m);
    }
}
?>




