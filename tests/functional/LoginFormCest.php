<?php

use app\tests\fixtures\UserFixture;

class LoginFormCest
{
    /**
     * @param FunctionalTester $I
     */
    public function _before(\FunctionalTester $I)
    {
        $I->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ]);
        $I->amOnRoute('auth/login/login');

    }

    public function openLoginPage(\FunctionalTester $I)
    {
        $I->see('ورود به سایت', 'h4');

    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginById(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage('/');
        $I->see('خروج');
    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginByInstance(\FunctionalTester $I)
    {
        $I->amLoggedInAs($I->grabFixture('user', 1));
        $I->amOnPage('/');
        $I->see('خروج');
    }

    public function loginWithEmptyCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', []);
        $I->expectTo('see validations errors');
        $I->see('Username cannot be blank.');
        $I->see('Password cannot be blank.');
    }

    public function loginWithWrongCredentials(\FunctionalTester $I)
    {
        $I->submitForm('#login-form', [
            'LoginForm[username]' => 'admin',
            'LoginForm[password]' => 'wrong',
        ]);
        $I->expectTo('see validations errors');
        $I->see('Incorrect username or password.');
    }

    public function loginSuccessfully(\FunctionalTester $I)
    {
        $user = $I->grabFixture('user', 1);
        $I->submitForm('#login-form', [
            'LoginForm[username]' => $user['username'],
            'LoginForm[password]' => 'password',
        ]);
        $I->see('خروج');
        $I->dontSeeElement('form#login-form');              
    }
}