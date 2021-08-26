<?php

namespace tests\unit\models;

use app\models\User;
use app\tests\fixtures\ArticleFixture;
use app\tests\fixtures\UserFixture;
use Yii;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;

    public function _before()
    {
        $this->tester->haveFixtures([
            'article' => [
                'class' => ArticleFixture::className(),
                'dataFile' => codecept_data_dir() . 'article.php'
            ],
            'user' => [
                'class' => UserFixture::className(),
                'dataFile' => codecept_data_dir() . 'user.php',
            ],
        ]);
    }
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username);
        expect_not(User::findIdentity(999));
    }

    public function testFindUserByAccessToken()
    {
        $user = $this->tester->grabFixture('user', 1);
        expect_that($user = User::findIdentityByAccessToken($user->accessToken));
        expect_not(User::findIdentityByAccessToken('non-existing'));        
    }

    public function testFindUserByUsername()
    {
        $user = $this->tester->grabFixture('user', 1);
        expect_that($user = User::findByUsername($user->username));
        expect_not(User::findByUsername('not-admin'));
    }


    /** @test */
    public function validateEmpty()
    {
        $model = new User();
        expect('model should not validate', $model->validate())->false();
        expect('fullname has error', $model->errors)->hasKey('fullname');
        expect('username has error', $model->errors)->hasKey('username');
        expect('email has error', $model->errors)->hasKey('email');
        expect('password has error', $model->errors)->hasKey('password');
    }

    /** @test */
    public function validateCorrect()
    {
        $model = new User([
            'fullname' => 'alik1561',
            'username' => 'alik1561',
            'email' => 'alik1561@email.com',
            'password' => Yii::$app->security->generateRandomString(),
            'accessToken' => Yii::$app->security->generateRandomString(),
            'authKey' => Yii::$app->security->generateRandomString(),
        ]);
        expect('model should validate', $model->validate())->true();
    }

}
