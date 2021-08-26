<?php

namespace tests\unit\models;

use app\models\RegisterForm;
use app\tests\fixtures\UserFixture;

class RegisterFormTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    private $model;

    public function _before()
    {
        $this->tester->haveFixtures([
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
        ]);
    }

    protected function _after()
    {
//        \Yii::$app->user->logout();
    }

    public function testRegisterUser()
    {
        $this->model = new RegisterForm([
            'fullname' => 'testUser',
            'username' => 'testUser',
            'password' => 'password',
            'password_repeat' => 'password',
        ]);

        expect($this->model->register());
//        expect_that(\Yii::$app->user->isGuest);
    }
//
//    public function testLoginWrongPassword()
//    {
//        $this->model = new LoginForm([
//            'username' => 'demo',
//            'password' => 'wrong_password',
//        ]);
//
//        expect_not($this->model->login());
//        expect_that(\Yii::$app->user->isGuest);
//        expect($this->model->errors)->hasKey('password');
//    }
//
//    public function testLoginCorrect()
//    {
//        $user = $this->tester->grabFixture('user',1);
//        $this->model = new LoginForm([
//            'username' => $user->username,
//            'password' =>  'password',
//        ]);
//
//        expect_that($this->model->login());
//        expect_not(\Yii::$app->user->isGuest);
//        expect($this->model->errors)->hasntKey('password');
//    }
}
