<?php
namespace app\models;
use Yii;
use yii\base\Model;
class RegisterForm extends Model {
    public $fullname;
    public $username;
    public $email;
    public $password;
    public $password_repeat;


    public function rules(): array
    {
        return [
            [['fullname', 'username', 'password', 'password_repeat', 'email'],'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => '100'],
            [['password', 'password_repeat'], 'string','min' => '8', 'max' => '32'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password'],
            [['username', 'fullname'], 'string', 'min' => '4', 'max'=> '16'],
        ];
    }


    /**
     * @throws \yii\base\Exception
     */
    public function register(): bool
    {
        $user = new User();
        $user->fullname = $this->fullname;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = $this->password;
        $user->accessToken = Yii::$app->security->generateRandomString();
        $user->authKey = Yii::$app->security->generateRandomString();

        return $user->save();
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels(): array
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'subscriptions' => 'Subscriptions',
            'photos' => 'Photos',
        ];
    }

}