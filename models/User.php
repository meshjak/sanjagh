<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
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
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'user';
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
            [['username'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'fullname' => 'Fullname',
            'username' => 'Username',
            'email' => 'Email',
            'isAdmin' => 'Is Admin',
            'status' => 'Status',
            'password' => 'Password',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'created_at' => 'Created At',
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
        return self::findOne(['access_token' => $token]);
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
    public function getStatus(): int
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
}
