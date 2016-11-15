<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents login page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class LoginPage extends BasePage
{
    public $route = 'firekylin/login';

    /**
     * @param string $username
     * @param string $password
     */
    public function login($username, $password)
    {
        $this->actor->fillField('input[name="LoginSiteForm[username]"]', $username);
        $this->actor->fillField('input[name="LoginSiteForm[password]"]', $password);
        $this->actor->click('login-button');
    }
}
