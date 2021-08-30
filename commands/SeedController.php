<?php

// commands/SeedController.php
namespace app\commands;

use app\models\User;
use Yii;
use yii\console\Controller;
use yii\console\widgets\Table;

class SeedController extends Controller
{
    public function actionAdmin(int $number = 5)
    {
        $rows = [];
        $faker = \Faker\Factory::create();
        foreach (range(1, $number) as $i){
            $password = 'password';
            $user = new User([
                'fullname' => $faker->firstName,
                'username' => $faker->firstName . $faker->numberBetween(1990, 2013),
                'email' => $faker->email,
                'password' => $password,
                'accessToken' => Yii::$app->security->generateRandomString(),
                'authKey' => Yii::$app->security->generateRandomString(),
                'isAdmin' => 1,
                'status' => 1,
            ]);
            if($user->save()){
                $rows[] = [$user->username, $password];
            }
        }
        echo Table::widget([
    'headers' => ['username', 'password'],
    'rows' => $rows,
]);
    }
}