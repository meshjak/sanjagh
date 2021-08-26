<?php

use app\tests\fixtures\UserFixture;

class RegisterFormCest
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
        $I->amOnRoute('auth/register/register');

    }

    public function openRegisterPage(\FunctionalTester $I)
    {
        $I->see('عضویت در سایت', 'h4');

    }

    // demonstrates `amLoggedInAs` method
    public function internalLoginById(\FunctionalTester $I)
    {
        $I->amLoggedInAs(1);
        $I->amOnPage('/');
        $I->see('خروج');
    }

    public function RegisterSuccessfully(\FunctionalTester $I)
    {
        $I->submitForm('#register-form', [
            'RegisterForm[fullname]' => 'testUser',
            'RegisterForm[username]' => 'testUser',
            'RegisterForm[email]' => 'testUser@gmail.com',
            'RegisterForm[password]' => 'password',
            'RegisterForm[password_repeat]' => 'password',
        ]);
        $I->dontSee('عضویت در سایت', 'h4');
        $I->dontSeeElement('form#register-form');
    }
}