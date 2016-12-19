<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/11/15
 * Time: 17:52
 */
use tests\codeception\_pages\InquiryPage;
$I = new FunctionalTester($scenario);

$I->wantTo('ensure that inquiryhistory page works');
$I->amOnPage('firekylin/inquiryhistory');

//此处应该有inquiryhistory函数的测试
