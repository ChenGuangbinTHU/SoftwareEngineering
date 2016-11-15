<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/11/15
 * Time: 17:29
 */

use tests\codeception\_pages\InquiryAllPage;
$I = new FunctionalTester($scenario);

$I->wantTo('ensure that inquiryall page works');
$I->amOnPage('firekylin/inquiryall');


