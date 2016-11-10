<?php
/**
 * Created by PhpStorm.
 * User: bingochen
 * Date: 2016/11/2
 * Time: 21:53
 */

use PHPUnit\Framework\TestCase;

class ArrayTest extends PHPUnit_Framework_TestCase
{
    public function testNewArrayIsEmpty()
    {
        // 创建数组fixture。
        $fixture = array();

        // 断言数组fixture的尺寸是0。
        $this->assertEquals(0, sizeof($fixture));
    }
}