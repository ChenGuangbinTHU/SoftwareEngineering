<?php
/**
 * Created by PhpStorm.
 * User: 60476
 * Date: 2016/11/15
 * Time: 17:52
 */
use tests\codeception\_pages\ShowPage;
$I = new FunctionalTester($scenario);

$I->wantTo('ensure that showhistory page works');
$I->amOnPage('firekylin/showhistory');

