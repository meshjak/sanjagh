<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $fullname
 * @property string $username
 * @property string $email
 * @property int $isAdmin
 * @property int $status
 * @property string $password
 * @property string $authKey
 * @property string $accessToken
 * @property string|null $created_at
 */
class User extends ActiveRecord implements IdentityInterface
{
    const SCENARIO_CREATE = 'create';
    public $password_repeat;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'updatedAtAttribute' => false,
                'createdAtAttribute' => 'created_at',
                'value' => function($event) {return $event->sender->created_at ?? new Expression('NOW()');}

            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['fullname', 'username', 'email', 'password', 'authKey', 'accessToken'], 'required'],
            [['isAdmin', 'status'], 'integer'],
            [['created_at'], 'safe'],
            [['fullname', 'username'], 'string', 'max' => 50],
            [['email', 'password'], 'string', 'max' => 100],
            [['authKey', 'accessToken'], 'string', 'max' => 255],
            [['username', 'email'], 'unique'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['username','fullname', 'email', 'status', 'isAdmin', 'password', 'password_repeat'];//Scenario Values Only Accepted
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'شناسه',
            'fullname' => 'نام و نام خانوادگی',
            'username' => 'نام کاربری',
            'email' => 'ایمیل',
            'isAdmin' => 'مدیریت',
            'status' => 'وضعیت',
            'password' => 'رمزعبور',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'password_repeat' => 'تکرار رمزعبور',
            'created_at' => 'تاریخ ایجاد کاربر',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['accessToken' => $token]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return ActiveRecord|User|null
     */
    public static function findByUsername(string $username)
    {
        return self::findOne(['username' => $username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * get fullname
     */
    public function getFullname(): string
    {
        return $this->fullname;
    }

    /**
     * get fullname
     */
    public function isAdmin(): string
    {
        return !!(int)$this->isAdmin();
    }

    /**
     * get username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * get email
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * get status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): ?string
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): ?bool
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert): bool
    {
        if(isset($this->password))
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        $this->accessToken = Yii::$app->security->generateRandomString();
        $this->authKey = Yii::$app->security->generateRandomString();
        return parent::beforeSave($insert);
    }

    public function isCreate() : bool {
        return $this->scenario === self::SCENARIO_CREATE;
    }
}
